<?php

namespace App\Security;

use App\Utils\Redis;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /** @var Redis */
    protected $redisService;

    public function __construct(Redis $redis)
    {
        $this->redisService = $redis;
    }

    /**
     * Symfony calls this method if you use features like switch_user
     * or remember_me.
     *
     * If you're not using these features, you do not need to implement
     * this method.
     *
     * @return UserInterface
     */
    public function loadUserByUsername($username)
    {
        // Load a User object from your data source or throw UsernameNotFoundException.
        // The $username argument may not actually be a username:
        // it is whatever value is being returned by the getUsername()
        // method in your User class.
        throw new \Exception('TODO: fill in loadUserByUsername() inside '.__FILE__);
    }

    /**
     * Refreshes the user after being reloaded from the session.
     *
     * When a user is logged in, at the beginning of each request, the
     * User object is loaded from the session and then this method is
     * called. Your job is to make sure the user's data is still fresh by,
     * for example, re-querying for fresh User data.
     *
     * If your firewall is "stateless: true" (for a pure API), this
     * method is not called.
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     *
     * @return void
     * @throws \Exception
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof SocialUser) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }

        if (!$user->getToken()) {
            throw new UsernameNotFoundException('User does not have token');
        }

        $request = Request::createFromGlobals();
        if ($request->cookies->has('token')) {
            $token = $request->cookies->get('token');
            if ($this->redisService->hasItem($token)) {
                return $this->redisService->getItem($token)->get();
            }
        }
    }

    /**
     * Tells Symfony to use this provider for this User class.
     */
    public function supportsClass($class)
    {
        return SocialUser::class === $class;
    }
}
