<?php

namespace App\Security;


use App\Utils\Redis;
use Symfony\Component\HttpFoundation\AcceptHeader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class TokenAuthenticator
 *
 * @package App\Security
 */
class TokenAuthenticator extends AbstractGuardAuthenticator
{
    protected $redisService;

    public function __construct(Redis $redis)
    {
        $this->redisService = $redis;
    }

    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning false will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request)
    {
        return $request->hasSession() && $request->cookies->has('token');
    }

    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     */
    public function getCredentials(Request $request)
    {
        return array(
            'token' => self::encryptToKey($request),
        );
    }

    public function getUser($credentials, UserProviderInterface $userProvider): SocialUser
    {
        $apiToken = $credentials['token'];
        if (null === $apiToken) {
            throw new UsernameNotFoundException('Token Empty');
        }

        if (self::encryptToKey(Request::createFromGlobals()) != $apiToken) {
            throw new UsernameNotFoundException('Request State Changed');
        }

        $redis = $this->redisService;
        $cacheKeyExists = $redis->hasItem($apiToken);
        if (!$cacheKeyExists) {
            throw new UsernameNotFoundException('User disappeared');
        }

        return $redis->getItem($apiToken)->get();
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // check credentials - e.g. make sure the password is valid
        // no credential check is needed in this case
        // return true to cause authentication success
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = array(
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        );

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse('/login');
    }

    public function supportsRememberMe()
    {
        return false;
    }

    /**
     * To prevent cookie hijacking, we create a token
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return string
     */
    public static function encryptToKey(Request $request): string
    {
        $array = AcceptHeader::fromString($request->headers->get('Accept'))
            ->all();

        $array['User-Agent'] = $request->headers->get('User-Agent');
        $array['Accept-Language'] = $request->headers->get('Accept-Language');
        $array['Accept-Encoding'] = $request->headers->get('Accept-Encoding');
        $array['IP'] = $request->getClientIp();

        $token = sha1(serialize($array));

        return $token;
    }

}
