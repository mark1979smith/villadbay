<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 25/01/2018
 * Time: 11:51
 */

namespace App\Utils;

use Psr\Cache\CacheItemInterface;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;

class Redis
{
    /** @var  string the host name/ip/alias */
    private $redisHost;
    /** @var  int the port number */
    private $redisPort;

    protected $profiles = array();

    public function __construct($redisHost, $redisPort)
    {
        $this->redisHost = $redisHost;
        $this->redisPort = $redisPort;
    }

    /**
     * @return \Symfony\Component\Cache\Adapter\TagAwareAdapter
     */
    private function get()
    {
        $this->profiles[] = ['_method' => __METHOD__];
        
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
        $cache = new TagAwareAdapter(
            new RedisAdapter(
                $redisConnection, // the object that stores a valid connection to your Redis system
                // the string prefixed to the keys of the items stored in this cache
                'app-',
                // the default lifetime (in seconds) for cache items that do not define their
                // own lifetime, with a value 0 causing items to be stored indefinitely (i.e.
                // until RedisAdapter::clear() is invoked or the server(s) are purged)
                0
            ),
            new RedisAdapter(
                $redisConnection, // the object that stores a valid connection to your Redis system
                // the string prefixed to the keys of the items stored in this cache
                'tags-',
                // the default lifetime (in seconds) for cache items that do not define their
                // own lifetime, with a value 0 causing items to be stored indefinitely (i.e.
                // until RedisAdapter::clear() is invoked or the server(s) are purged)
                0
            )
        );

        return $cache;
    }

    /**
     * @param string $cacheKey
     *
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function hasItem(string $cacheKey)
    {
        $this->profiles[] = ['_method' => __METHOD__, 'Key' => $cacheKey];

        return $this->get()->hasItem($cacheKey);
    }

    /**
     * @param string $cacheKey
     *
     * @return mixed|\Symfony\Component\Cache\CacheItem
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getItem(string $cacheKey)
    {
        $this->profiles[] = ['_method' => __METHOD__, 'Key' => $cacheKey];

        return $this->get()->getItem($cacheKey);
    }

    /**
     * @return array
     */
    public function getProfiles(): array
    {
        return $this->profiles;
    }


    /**
     * @param string $tag
     *
     * @return bool|mixed
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function invalidateTag(string $tag)
    {
        return $this->invalidateTags([$tag]);
    }

    /**
     * @param array $tags
     *
     * @return bool|mixed
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function invalidateTags(array $tags)
    {
        $this->profiles[] = array_merge(['_method' => __METHOD__ . ' invalidateTags'], $tags);
        return $this->get()->invalidateTags($tags);
    }

    /**
     * @param \Psr\Cache\CacheItemInterface $cacheItem
     *
     * @return bool
     */
    public function save(CacheItemInterface $cacheItem)
    {
        $this->profiles[] = ['_method' => __METHOD__];
        return $this->get()->save($cacheItem);
    }
}
