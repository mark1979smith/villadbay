<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 04/05/2018
 * Time: 12:45
 */

namespace App\DataCollector;


use App\Utils\Redis;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class RedisCollector extends DataCollector implements DataCollectorInterface
{
    /** @var \App\Utils\Redis */
    protected $service;

    public function __construct(Redis $service)
    {
        $this->service = $service;
    }

    /**
     * Collects data for the given Request and Response.
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data = $this->service->getProfiles();
    }

    /**
     * Returns the name of the collector.
     *
     * @return string The collector name
     */
    public function getName()
    {
        return 'app.redis_collector';
    }

    /**
     * Resets this data collector to its initial state.
     */
    public function reset()
    {
        $this->data = array();
    }

    public function getData()
    {
        return $this->data;
    }
}
