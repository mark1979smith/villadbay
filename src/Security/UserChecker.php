<?php

namespace App\Security;


use App\Component\Redis;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\AuthenticationExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserChecker
 *
 * @package App\Security
 */
class UserChecker implements UserCheckerInterface
{
    protected $redisService;

    use SecureKey;

    public function __construct(Redis $redis)
    {
        $this->redisService = $redis;
    }

    /**
     * Checks the user account before authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPreAuth(UserInterface $user)
    {
        // TODO: Implement checkPreAuth() method.
    }

    /**
     * Checks the user account after authentication.
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     *
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof SocialUser) {
            return;
        }

        if (null === $user->getToken()) {
            throw new AuthenticationExpiredException('Token Empty');
        }

        $redisToken = self::encryptToKey(Request::createFromGlobals());

        $redis = $this->redisService;
        $cacheKeyExists = $redis->hasItem($redisToken);
        if (!$cacheKeyExists) {
            throw new AuthenticationExpiredException('User disappeared');
        }


    }
}
