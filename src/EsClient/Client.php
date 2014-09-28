<?php

namespace EsClient;

class Client
{
    protected $transport;

    public function injectTransport($transport)
    {
        $this->transport = $transport;
    }

    public function index($params)
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        /** @var \Elasticsearch\Endpoints\Index $endpoint */
        $endpoint = EndpointFactory::get('Index', $this->getTransport());
        $endpoint->setID($id)
            ->setIndex($index)
            ->setType($type)
            ->setBody($body);
        $endpoint->setParams($params);
        $response = $endpoint->performRequest();
        return $response['data'];
    }

    public function get($params)
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');

        /** @var \Elasticsearch\Endpoints\Get $endpoint */
        $endpoint = EndpointFactory::get('Get', $this->getTransport());
        $endpoint->setID($id)
            ->setIndex($index)
            ->setType($type);
        $endpoint->setParams($params);
        $response = $endpoint->performRequest();
        return $response['data'];
    }

    public function delete($params)
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');

        /** @var \Elasticsearch\Endpoints\Delete $endpoint */
        $endpoint = EndpointFactory::get('Delete', $this->getTransport());
        $endpoint->setID($id)
            ->setIndex($index)
            ->setType($type);
        $endpoint->setParams($params);
        $response = $endpoint->performRequest();
        return $response['data'];
    }

    public function create($params)
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        /** @var \Elasticsearch\Endpoints\Index $endpoint */
        $endpoint = EndpointFactory::get('Index', $this->getTransport());
        $endpoint->setID($id)
            ->setIndex($index)
            ->setType($type)
            ->setBody($body)
            ->createIfAbsent();
        $endpoint->setParams($params);
        $response = $endpoint->performRequest();
        return $response['data'];
    }

    protected function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param array $params
     * @param string $arg
     *
     * @return null|mixed
     */
    public function extractArgument(&$params, $arg)
    {
        if (is_object($params) === true) {
            $params = (array)$params;
        }

        if (isset($params[$arg]) === true) {
            $val = $params[$arg];
            unset($params[$arg]);
            return $val;
        } else {
            return null;
        }
    }

}