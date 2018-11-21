<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 04/05/2018
 * Time: 09:52
 */

namespace App\DataCollector;


use App\Component\AwsS3Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class AwsS3Collector extends DataCollector implements DataCollectorInterface
{

    protected $service;

    public function __construct(AwsS3Client $service)
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
        return 'app.aws_s3_collector';
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
