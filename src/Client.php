<?php

namespace PHPMongoKit\ODM\Adapter\Yii2;

class Client
{
    private $dsn;

    private $defaultDatabaseName;

    private $mapping;

    private $mongoClient;

    private $databasePool = array();

    private $options = array('connect' => true);

    public function setDsn($dsn)
    {
        $this->dsn = $dsn;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    public function setDefaultDatabase($databaseName)
    {
        $this->defaultDatabaseName = $databaseName;
    }

    public function setMap(array $mapping)
    {
        $this->mapping = $mapping;
    }

    public function getClient()
    {
        if ($this->mongoClient) {
            return $this->mongoClient;
        }

        $this->mongoClient = new \Sokil\Mongo\Client($this->dsn, $this->options);

        return $this->mongoClient;
    }

    public function getDatabase($databaseName = null)
    {
        if(isset($this->databasePool[$databaseName])) {
            return $this->databasePool[$databaseName];
        }

        if(!$databaseName) {
            $databaseName = $this->defaultDatabaseName;
        }

        $database =  $this->getClient()->getDatabase($databaseName);

        // map
        while(is_string($this->mapping[$databaseName])) {
            $databaseName = $this->mapping[$databaseName];
        }

        $database->map($this->mapping[$databaseName]);

        $this->databasePool[$databaseName] = $database;

        return $database;
    }

    public function getCollection($collectionName, $databaseName = null)
    {
        return $this->getDatabase($databaseName)->getCollection($collectionName);
    }
}