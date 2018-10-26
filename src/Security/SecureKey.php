<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 26/10/2018
 * Time: 15:03
 */

namespace App\Security;


use Symfony\Component\HttpFoundation\AcceptHeader;
use Symfony\Component\HttpFoundation\Request;

trait SecureKey
{
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
