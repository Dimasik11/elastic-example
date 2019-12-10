<?php
namespace models;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

/**
 * Class ElasticComponent
 * @property $client
 */
class ElasticComponent
{
    const TYPE_NAME = 'search-name';
    const INDEX_NAME = 'example-index';

    /** @var \Elasticsearch\Client */
    private $client;

    public function __construct()
    {
        $builder = ClientBuilder::create();
        $builder->setHosts([getenv('ELASTIC_HOST')]);

        $this->client = $builder->build();
    }


    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }


    /**
     * Создание индекса
     */
    public function createIndex()
    {
        $params = $this->getBodyParams();

        $this->getClient()->indices()->create($params);

        echo 'success create index';
    }

    /**
     * Удаление индекса
     */
    public function deleteIndex()
    {

        $this->getClient()->indices()->delete(['index' => self::INDEX_NAME]);

        echo 'success delete index';
    }


    /**
     * Загрузка фамилий
     */
    public function loadData()
    {
        $data = file_get_contents(__DIR__ . '/../files/lastnames.txt');
        $lastNames = explode(',', $data);
        foreach ($lastNames as $key => $value) {
            $params['body'][] = [
                'index' => [
                    '_index' => self::INDEX_NAME,
                    '_type' => self::TYPE_NAME,
                    '_id' => $key,
                ]
            ];

            $params['body'][] = [
                'id' => $key,
                'last_name' => $value,
            ];

            $this->getClient()->bulk($params);
        }
        echo 'success load data';
    }

    /**
     * Построить тело запроса
     *
     * @return array
     */
    private function getBodyParams()
    {
        return [
            'index' => self::INDEX_NAME,
            'body' => [
                'settings' => $this->getSettings(),
                'mappings' => $this->getMappings(),
            ]
        ];
    }

    /**
     * @return array
     */
    private function getSettings()
    {
        return [
            'analysis' => [
                'analyzer' => [
                    'edge_ngram_analyzer' => [
                        'tokenizer' => 'standard',
                        'filter' => [
                            'lowercase',
                            'edge_ngram_filter'
                        ]
                    ]
                ],
                'filter' => [
                    'edge_ngram_filter' => [
                        'type' => 'edge_ngram',
                        'min_gram' => 1,
                        'max_gram' => 20,
                        'token_chars' => [
                            'punctuation',
                            'digit'
                        ]
                    ]
                ]
            ]
        ];
    }


    /**
     * @return array
     */
    private function getMappings()
    {
        return [
            self::TYPE_NAME => [
                'properties' => [
                    'last_name' => [
                        'type' => 'text',
                        'analyzer' => 'edge_ngram_analyzer',
                        'search_analyzer' => 'standard'
                    ],
                    'first_name' => [
                        'type' => 'text',
                        'analyzer' => 'edge_ngram_analyzer',
                        'search_analyzer' => 'standard'
                    ],
                ],
            ],
        ];
    }
}
