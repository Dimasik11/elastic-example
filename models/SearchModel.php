<?php

namespace models;

/**
 * Class SearchModel
 *
 * @property $term
 * @property ElasticComponent $elastic
 */
class SearchModel
{
    /** @var string */
    public $term;
    /** @var ElasticComponent */
    private $elastic;

    /** @inheritdoc */
    public function __construct($term)
    {
        $this->term = $term;
        $this->elastic = new ElasticComponent();
    }

    /**
     * @return array
     */
    public function search()
    {
        $params = $this->getParams();

        $res = $this->elastic->getClient()->search($params);
        $models = $this->validateData($res);
        return array_column($models, 'last_name');

    }

    private function getParams()
    {
        return [
            'index' => ElasticComponent::INDEX_NAME,
            'type' => ElasticComponent::TYPE_NAME,
            'size' => 100,
            'body' => $this->getBody(),
        ];
    }

    private function getBody()
    {

        $body = [
            'query' => [
                'bool' => [],
            ],
        ];

        if ($this->term) {
            $body['query']['bool']['must'] = [
                'match' => [
                    'last_name' => [
                        'query' => $this->term,
                        'operator' => 'and',
                        'fuzziness' => 10,
                    ]
                ]
            ];
        } else {
            $body['query']['bool']['must'][] =
                [
                    'match_all' => (object)[]
                ];
        }

        return $body;
    }

    private function validateData($data)
    {
        $res = [];
        if ($data) {
            $validData = $data['hits']['hits'];

            foreach ($validData as $item) {
                $res[] = $item['_source'];
            }
        }
        return $res;
    }
}