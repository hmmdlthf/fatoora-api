<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtToken.php';

class JwtService
{
    private $jwt;

    public function __construct(array $array)
    {
        $this->jwt = new JwtToken($array);
    }

    public function config($expireLength, $username)
    {
        $currentTime = new DateTimeImmutable();
        $this->jwt->setIssuedAt($currentTime->getTimestamp());
        $this->jwt->setExpire($currentTime->modify("+". $expireLength ." minutes")->getTimestamp());
        $this->jwt->setServerName($_SERVER['HTTP_HOST']);
        $this->jwt->setUsername($username);
    }

    public function createTokenArray()
    {
        $this->jwt->setArray([
                'iat'  => $this->jwt->getIssuedAt(),    // Issued at: time when the token was generated
                'jti'  => $this->jwt->getTokenId(),     // Json Token Id: an unique identifier for the token
                'iss'  => $this->jwt->getServerName(),  // Issuer
                'nbf'  => $this->jwt->getIssuedAt(),    // Not before
                'exp'  => $this->jwt->getExpire(),      // Expire
                'data' => [                             // Data related to the signer user
                    'userName' => $this->jwt->getUsername(),            // User names
                    'roles' => $this->jwt->getRoles(),
                ]
            ]);
    }

    public function encodeArrayToJwt()
    {
        $jwt = JWT::encode(
            $this->jwt->getArray(),     //Data to be encoded in the JWT
            $this->jwt->getSecretKey(), // The signing key
            $this->jwt->getAlgo()       // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );
        $this->jwt->setJwt($jwt);
    }

    public function createCookie(string $path)
    {
        setcookie('jwt', $this->jwt->getJwt(), path:$path);
    }

    public function createJwt(string $path)
    {
        $this->createTokenArray();
        $this->encodeArrayToJwt();
        $this->createCookie($path);
    }

    public function decodeJwtToArray($jwt)
    {
        $this->jwt->setJwt($jwt);
        JWT::$leeway += 60;
        $data = JWT::decode((string)$this->jwt->getJwt(), new Key($this->jwt->getSecretKey(), $this->jwt->getAlgo()));
        $this->jwt->setArray([
            'iat'  => $data->iat,    // Issued at: time when the token was generated
            'jti'  => $data->jti,    // Json Token Id: an unique identifier for the token
            'iss'  => $data->iss,    // Issuer
            'nbf'  => $data->nbf,    // Not before
            'exp'  => $data->exp,    // Expire
            'data' => $data->data
        ]);
    }

    public function verifyJwt()
    {
        $now = new DateTimeImmutable();
        if ($this->jwt->getArray()['iss'] !== $this->jwt->getServerName() || // check if the server name is the sever name we gave when created the jwt - opposite true
            $this->jwt->getArray()['nbf'] > $now->getTimestamp() || // check if the 'nbf'(nob before) is > than the current time - opposite true
            $this->jwt->getArray()['exp'] < $now->getTimestamp() || // check if the 'exp'(expire) is < than current time - opposite true
            $this->jwt->getArray()['data']->roles !== $this->jwt->getRoles()
            ) 
        {
            return false;
        } else {
            return true;
        }

    }

    public function getUsername()
    {
        return $this->jwt->getArray()['data']->userName;
    }
}