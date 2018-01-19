<?php

namespace MembershipClient\Api;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Keychain;
use Lcobucci\JWT\Signer\Rsa\Sha256;

class JwtToken
{
    private $privateKey;
    private $consumerId;

    public function __construct(
        string $privateKey,
        int $consumerId
    ) {
        $this->privateKey = $privateKey;
        $this->consumerId = $consumerId;
    }

    public function generate(
        int $expireHours = 1
    ) {
        $keychain = new Keychain();
        $token = $this->getBaseToken($expireHours)
            ->set('uid', $this->consumerId)
            ->sign(new Sha256(), $keychain->getPrivateKey($this->privateKey))
            ->getToken();
        return (string) $token;
    }

    private function getBaseToken(int $expireHours)
    {
        return (new Builder())
            ->setIssuedAt(time())
            ->setExpiration(time() + ($expireHours * 3600));
    }
}
