<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 17/10/2018
 * Time: 08:23
 */

namespace App\Controller;

use App\Security\SocialUser;
use App\Security\TokenAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 *
 * @package App\Controller
 */
class UserController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('user/login.html.twig');
    }

    /**
     * @Route("/login-with-google", name="login-with-google")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function loginWithGoogle(): RedirectResponse
    {
        $googleClient = $this->container->get('app.google_api');
        return $this->redirect($googleClient->createAuthUrl());
    }

    /**
     * @Route("/login_check", name="login-auth", methods={"GET"})
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function authenticate(Request $request): Response
    {
        $googleClient = $this->container->get('app.google_api');
        $googleClient->fetchAccessTokenWithAuthCode($request->get('code'));

        $accessToken = $googleClient->getAccessToken();
        $googleClient->setAccessToken($accessToken);

        $response = new Response();

        if (!$googleClient->isAccessTokenExpired()) {
            $plus = new \Google_Service_Oauth2($googleClient);
            $user = new SocialUser();
            /** @var \Google_Service_Oauth2_Userinfoplus $userInfo */
            $userInfo = $plus->userinfo->get();
            $user->setId($userInfo->getId());
            $user->setEmail($userInfo->getEmail());
            $user->setAvatar($userInfo->getPicture());
            $user->setFirstName($userInfo->getGivenName());
            $user->setSurname($userInfo->getFamilyName());
            $user->setToken(random_int(0, 9999));

            $superAdminHd = ['marksmith.email'];
            $adminHd = ['villadbay.com'];

            if (in_array($userInfo->getHd(), $superAdminHd)) {
                $user->setRoles(['ROLE_SUPERADMIN']);
            } elseif (in_array($userInfo->getHd(), $adminHd)) {
                $user->setRoles(['ROLE_ADMIN']);
            } else {
                $user->setRoles(['ROLE_USER']);
            }

            $token = TokenAuthenticator::encryptToKey($request);
            $response->headers->setCookie(new Cookie('token', $token));
            $response->send();

            /** @var \App\Component\Redis $redis */
            $redis = $this->container->get('app.redis');
            $cacheItem = $redis->getItem($token);
            $cacheItem->set($user);
            $redis->save($cacheItem);

            return $this->redirect('/');
        }

        return $response;
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     * @throws \Exception
     */
    public function logout()
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}

