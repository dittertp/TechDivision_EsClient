<?php


namespace EsClient;


class EndpointFactory {

    const ELASTICSEARCH_NAMESPACE = "Elasticsearch\Endpoints";

    public static function get($className, $transportClass)
    {
        $class = self::ELASTICSEARCH_NAMESPACE . "\\" . $className;
        if (class_exists($class)) {
            return new $className($transportClass);
        }
    }
} 