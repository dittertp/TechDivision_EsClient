<?php

/**
 * EsClient\EndpointFactory
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

/**
 * class EndpointFactory
 *
 * @category  EsClient
 * @package   TechDivision_EsClient
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class EndpointFactory
{
    /**
     * @var string
     */
    const ELASTICSEARCH_NAMESPACE = "\\Elasticsearch\\Endpoints";

    /**
     * Creates a new instance of given class name
     *
     * @param string $className      the class name
     * @param mixed  $transportClass the transport class
     *
     * @return mixed
     */
    public static function get($className, $transportClass)
    {
        $class = self::ELASTICSEARCH_NAMESPACE . "\\" . $className;
        if (class_exists($class)) {
            return new $class($transportClass);
        }
    }
}
