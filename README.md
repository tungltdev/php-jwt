Installation
------------

Use composer to manage your dependencies and download LARAVEL-JWT:

```bash

composer require tungltdev/laravel-jwt

Tungltdev\JWT\JwtAuthTokenProvider::class  add to config/app.php

php artisan vendor:publish --provider="Tungltdev\JWT\JwtAuthTokenProvider"
hoặc
php artisan vendor:publish --provider="Tungltdev\JWT\JwtAuthTokenProvider" --force

```
config key in file config/jwt.php

Example
-------
```php
<?php

$payload  = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$jwt = jwtencode($payload); 
$decoded = jwtdecode($jwt, array('HS256'));

print_r($decoded);

/*
 NOTE: This will now be an object instead of an associative array. To get
 an associative array, you will need to cast it as such:
*/

$decoded_array = (array) $decoded;

/**
 * You can add a leeway to account for when there is a clock skew times between
 * the signing and verifying servers. It is recommended that this leeway should
 * not be bigger than a few minutes.
 *
 * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
 */
jwtencode(60); // $leeway in seconds
$decoded = jwtdecode($jwt, array('HS256'));

?>
```
```
supported_algs
------------------------
    'HS256' => array('hash_hmac', 'SHA256'),
    'HS512' => array('hash_hmac', 'SHA512'),
    'HS384' => array('hash_hmac', 'SHA384'),
    'RS256' => array('openssl', 'SHA256'),
    'RS384' => array('openssl', 'SHA384'),
    'RS512' => array('openssl', 'SHA512'),
```

Support for reserved claim names
JSON Web Token defines some reserved claim names and defines how they should be used. JWT supports these reserved claim names:

    'exp' (Expiration Time) Claim
    'nbf' (Not Before Time) Claim
    'iss' (Issuer) Claim
    'iat' (Issued At) Claim

Expiration Time Claim
The exp (expiration time) claim identifies the expiration time on or after which the JWT MUST NOT be accepted for processing. The processing of the exp claim requires that the current date/time MUST be before the expiration date/time listed in the exp claim. Implementers MAY provide for some small leeway, usually no more than a few minutes, to account for clock skew. Its value MUST be a number containing a NumericDate value. Use of this claim is OPTIONAL.
    
Not Before Time Claim
The nbf (not before) claim identifies the time before which the JWT MUST NOT be accepted for processing. The processing of the nbf claim requires that the current date/time MUST be after or equal to the not-before date/time listed in the nbf claim. Implementers MAY provide for some small leeway, usually no more than a few minutes, to account for clock skew. Its value MUST be a number containing a NumericDate value. Use of this claim is OPTIONAL

Issuer Claim
The iss (issuer) claim identifies the principal that issued the JWT. The processing of this claim is generally application specific. The iss value is a case-sensitive string containing a StringOrURI value. Use of this claim is OPTIONAL.

Issued At Claim
The iat (issued at) claim identifies the time at which the JWT was issued. This claim can be used to determine the age of the JWT. Its value MUST be a number containing a NumericDate value. Use of this claim is OPTIONAL.

Example with RS256 (openssl)
----------------------------
```php
<?php

$privateKey = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQC8kGa1pSjbSYZVebtTRBLxBz5H4i2p/llLCrEeQhta5kaQu/Rn
vuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t0tyazyZ8JXw+KgXTxldMPEL9
5+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4ehde/zUxo6UvS7UrBQIDAQAB
AoGAb/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
ZkcvY3SK2iRIL4c9yY6hlIhs+K9wXTtGWwJBAO9Dskl48mO7woPR9uD22jDpNSwe
k90OMepTjzSvlhjbfuPN1IdhqvSJTDychRwn1kIJ7LQZgQ8fVz9OCFZ/6qMCQGOb
qaGwHmUK6xzpUbbacnYrIM6nLSkXgOAwv7XXCojvY614ILTK3iXiLBOxPu5Eu13k
eUz9sHyD6vkgZzjtxXECQAkp4Xerf5TGfQXGXhxIX52yH+N2LtujCdkQZjXAsGdm
B2zNzvrlgRmgBrklMTrMYgm1NPcW+bRLGcwgW2PTvNM=
-----END RSA PRIVATE KEY-----
EOD;

$publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC8kGa1pSjbSYZVebtTRBLxBz5H
4i2p/llLCrEeQhta5kaQu/RnvuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t
0tyazyZ8JXw+KgXTxldMPEL95+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4
ehde/zUxo6UvS7UrBQIDAQAB
-----END PUBLIC KEY-----
EOD;


$payload = array(
    "iss" => "example.org",
    "aud" => "example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

$jwt = jwtencode($payload, 'RS256', $privateKey);
echo "Encode:\n" . print_r($jwt, true) . "\n";

$decoded = jwtdecode($jwt, array('RS256'), $publicKey);

/*
 NOTE: This will now be an object instead of an associative array. To get
 an associative array, you will need to cast it as such:
*/

$decoded_array = (array) $decoded;
echo "Decode:\n" . print_r($decoded_array, true) . "\n";
?>
```
