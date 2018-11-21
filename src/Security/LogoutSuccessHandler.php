<?php
namespace App\Security;


use App\Component\Redis;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

/**
 * Class LogoutSuccessHandler
 *
 * @package App\Security
 */
class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
    /** @var Redis */
    protected $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Creates a Response object to send upon a successful logout.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return Response never null
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function onLogoutSuccess(Request $request): RedirectResponse
    {
        if ($request->cookies->has('token')) {
            $token = $request->cookies->get('token');
            if ($this->redis->hasItem($token)) {
                $this->redis->deleteItem($token);
            }
            $response = new Response();

            $response->headers->clearCookie('token');
            $response->send();
        }

        return new RedirectResponse('/');
    }
}
