<?php

/**
 * EsClient\Client
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category  EsClient
 * @package   TechDivision_EsClient
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

namespace EsClient;

use EsClient\Namespaces\IndicesNamespace;

/**
 * class Client
 *
 * @category  EsClient
 * @package   TechDivision_EsClient
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class Client
{
    /**
     * @var mixed
     */
    protected $transport;

    /**
     * @var Namespaces\IndicesNamespace
     */
    protected $indicesNamespace;

    /**
     * create a class instance
     *
     * @param mixed $transport the transport class instance
     */
    public function __construct($transport)
    {
        $this->transport = $transport;
        $this->indicesNamespace = new IndicesNamespace($transport);
    }

    /**
     * es index call
     *
     * @param array $params parameters
     *
     * @return mixed
     */
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

    /**
     * es get call
     *
     * @param array $params parameters
     *
     * @return mixed
     */
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

    /**
     * es delete call
     *
     * @param array $params parameters
     *
     * @return mixed
     */
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

    /**
     * es create call
     *
     * @param array $params parameters
     *
     * @return mixed
     */
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

    /**
     * Returns transport class instance
     *
     * @return mixed
     */
    protected function getTransport()
    {
        return $this->transport;
    }

    /**
     * extracts given argument from given array
     *
     * @param array  &$params parameters
     * @param string $arg     argument
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

    /**
     * Returns IndicesNamespace class
     *
     * @return IndicesNamespace
     */
    public function indices()
    {
        return $this->indicesNamespace;
    }
}
