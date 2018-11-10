<?php

use Tungltdev\JWT\JWT;
if (!function_exists('jwtdecode'))
{
    /**
     * @param string $jwt
     * @param array $allowed_algs
     * @param string|null $key
     * @return mixed|\Tungltdev\JWT\JWT
     */
    function jwtdecode($jwt, $allowed_algs = array(), $key=null)
    {
        return JWT::decode($jwt, $allowed_algs, $key);
    }
}
if (!function_exists('jwtencode'))
{
    /**
     * @param array $payload
     * @param string $alg
     * @param string|null $key
     * @param string|null $keyId
     * @param string|null $head
     * @return mixed|\Tungltdev\JWT\JWT
     */
    function jwtencode($payload, $alg = 'HS256', $key=null, $keyId = null, $head = null)
    {
        return JWT::encode($payload, $alg, $key, $keyId, $head);
    }
}
if (!function_exists('jwtleeway'))
{
    /**
     * @param integer $leeway
     * @return mixed|\Tungltdev\JWT\JWT
     */
    function jwtleeway($leeway)
    {
        JWT::$leeway = $leeway;
    }
}