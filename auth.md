The membership api uses JSON Web Tokens signed with RSA public/private keypair
to authenticate requests.

## What is JSON Web Token?

"JSON Web Token (JWT) is an open standard (RFC 7519) that defines a compact
and self-contained way for securely transmitting information between parties
as a JSON object. This information can be verified and trusted because it is
digitally signed. JWTs can be signed using a secret (with the HMAC algorithm)
or a public/private key pair using RSA."
(https://jwt.io/introduction/)


## How to send requests

In order to send requests to the membership API you will need to generate
an RSA keypair, you can do so using the following commands

```
ssh-keygen -t rsa -b 4096 -f jwtRS256.key
openssl rsa -in jwtRS256.key -pubout -outform PEM -out jwtRS256.key.pub
```

Once the keypair has been generated you will need to send us your public key
so we can verify your signed requests.
We will then send you a consumer ID that you will need to encode into your JWT.

### Building a Token

Please read https://jwt.io/introduction/ for an excellent explanation of
token structure and how they are built.

The following claims are required when interacting with the membership API.

- 'uid' The consumer ID issued by DCG.
- 'exp' Expiration datetime for the token.

#### PHP example

We currently use https://packagist.org/packages/lcobucci/jwt to build and decode tokens.

Here is an example of building and signing a token that will expire in 1 hour

```
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Keychain;
use Lcobucci\JWT\Signer\Rsa\Sha256;

    public function generate() {
        $keychain = new Keychain();
        $token = (new Builder())
            ->setExpiration(time() + (1 * 3600))
            ->set('uid', YOUR_CONSUMER_ID)
            ->sign(new Sha256(), $keychain->getPrivateKey("file://path/to/private/key"))
            ->getToken();
        return (string) $token;
    }
```
