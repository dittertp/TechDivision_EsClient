<?php

/**
 * EsClient\Namespaces\AbstractNamespace
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

namespace EsClient\Namespaces;

use Elasticsearch\Common\Exceptions\UnexpectedValueException;
use Puzzle\Client;

/**
 * class AbstractNamespace
 *
 * @category  EsClient
 * @package   TechDivision_EsClient
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

abstract class AbstractNamespace
{
    /** @var Puzzle\Client  */
    protected $transport;

    /**
     * Abstract constructor
     *
     * @param Puzzle\Client $transport Transport object
     */
    public function __construct($transport)
    {
        $this->transport = $transport;
    }

    /**
     * extracts given argument from array
     *
     * @param array  &$params parameters
     * @param string $arg     argument key
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
     * Returns transport class instance
     *
     * @return Puzzle\Client
     */
    protected function getTransport()
    {
        return $this->transport;
    }
}
