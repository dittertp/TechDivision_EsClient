<?php
/**
 * User: zach
 * Date: 5/9/13
 * Time: 5:10 PM
 */

namespace EsClient\Namespaces;

use Elasticsearch\Common\Exceptions\UnexpectedValueException;
use Puzzle\Client;

/**
 * Class AbstractNamespace
 *
 * @category Elasticsearch
 * @package  Elasticsearch\Namespaces\AbstractNamespace
 * @author   Zachary Tong <zachary.tong@elasticsearch.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elasticsearch.org
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

    protected function getTransport()
    {
        return $this->transport;
    }

}