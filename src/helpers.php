<?php

use Tungltdev\JWT\JWT;
if (!function_exists('jwtdecode'))
{
    /**
     * @param string $jwt
     * @param array $allowed_algs
     * @return mixed|\Tungltdev\JWT\JWT
     */
    function jwtdecode($jwt, $allowed_algs = array())
    {
        return JWT::decode($jwt, $allowed_algs);
    }
}
if (!function_exists('jwtencode'))
{
    /**
     * @param array $payload
     * @param string $alg
     * @param string|null $keyId
     * @param string|null $head
     * @return mixed|\Tungltdev\JWT\JWT
     */
    function jwtencode($payload, $alg = 'HS256', $keyId = null, $head = null)
    {
        return JWT::encode($payload, $alg, $keyId, $head);
    }
}
if (!function_exists('jwtleeway'))
{
    /**
     * @param array $payload
     * @param string $alg
     * @param string|null $keyId
     * @param string|null $head
     * @return mixed|\Tungltdev\JWT\JWT
     */
    function jwtleeway($leeway)
    {
        JWT::$leeway = $leeway;
    }
}