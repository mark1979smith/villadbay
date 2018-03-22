<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 25/01/2018
 * Time: 11:51
 */

namespace App\Utils;

use Symfony\Component\Cache\Adapter\RedisAdapter;

class Redis
{
    /** @var  string the host name/ip/alias */
    private $redisHost;
    /** @var  int the port number */
    private $redisPort;

    public function __construct($redisHost, $redisPort)
    {
        $this->redisHost = $redisHost;
        $this->redisPort = $redisPort;
    }

    public function get()
    {
        $redisConnection = RedisAdapter::createConnection(
            'redis://' . $this->redisHost . ':' . $this->redisPort . '/cache/',
            [
                'persistent'     => 0,
                'persistent_id'  => null,
                'timeout'        => 30,
                'read_timeout'   => 0,
                'retry_interval' => 0,
            ]
        );
        $cache = new RedisAdapter(
            $redisConnection, // the object that stores a valid connection to your Redis system
            // the string prefixed to the keys of the items stored in this cache
            'app-',
            // the default lifetime (in seconds) for cache items that do not define their
            // own lifetime, with a value 0 causing items to be stored indefinitely (i.e.
            // until RedisAdapter::clear() is invoked or the server(s) are purged)
            0
        );

        return $cache;
    }
}
