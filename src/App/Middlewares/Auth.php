<?php

    namespace Src\App\Middlewares;

    use \Firebase\JWT\JWT;
    use \Firebase\JWT\JWK;

    class Auth
    {

        public static function logged_in(): bool
        {
            return TRUE;

        }

        public static function authenticate($methodName): bool
        {
            // extract the token from the headers
            if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
                return FALSE;
            }

            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
            preg_match('/Bearer\s(\S+)/', $authHeader, $matches);

            if (!isset($matches[1])) {
                return FALSE;
            }

            $token = $matches[1];

            // validate the token
            if ($methodName == 'charge') {
                return self::authenticateRemotely($token);
            } else {
                return self::authenticateLocally($token, $tokenParts);
            }
        }

        public static function authenticateRemotely($token): bool
        {
            $metadataUrl = getenv('OKTA_ISSUER') . '/.well-known/oauth-authorization-server';
            $metadata = self::http($metadataUrl);
            $introspectionUrl = $metadata['introspection_endpoint'];

            $params = [
                'token' => $token,
                'client_id' => getenv('OKTA_SERVICE_APP_ID'),
                'client_secret' => getenv('OKTA_SERVICE_APP_SECRET'),
            ];

            $result = self::http($introspectionUrl, $params);

            if (!$result['active']) {
                return FALSE;
            }

            return TRUE;
        }

        public static function authenticateLocally($token, $tokenParts): bool
        {
            $tokenParts = explode('.', $token);
            $decodedToken['header'] = json_decode(self::base64UrlDecode($tokenParts[0]), TRUE);
            $decodedToken['payload'] = json_decode(self::base64UrlDecode($tokenParts[1]), TRUE);
            $decodedToken['signatureProvided'] = self::base64UrlDecode($tokenParts[2]);

            // Get the JSON Web Keys from the server that signed the token
            // (ideally they should be cached to avoid
            // calls to Okta on each API request)...
            $metadataUrl = getenv('OKTA_ISSUER') . '/.well-known/oauth-authorization-server';
            $metadata = self::http($metadataUrl);
            $jwksUri = $metadata['jwks_uri'];
            $keys = self::http($jwksUri);

            // Find the public key matching the kid from the input token
            $publicKey = FALSE;
            foreach ($keys['keys'] as $key) {
                if ($key['kid'] == $decodedToken['header']['kid']) {
                    $publicKey = JWK::parseKey($key);
                    break;
                }
            }
            if (!$publicKey) {
                echo "Couldn't find public key\n";

                return FALSE;
            }

            // Check the signing algorithm
            if ($decodedToken['header']['alg'] != 'RS256') {
                echo "Bad algorithm\n";

                return FALSE;
            }

            $result = JWT::decode($token, $publicKey, array('RS256'));

            if (!$result) {
                echo "Error decoding JWT\n";

                return FALSE;
            }

            // Basic JWT validation passed, now check the claims

            // Verify the Issuer matches Okta's issuer
            if ($decodedToken['payload']['iss'] != getenv('OKTA_ISSUER')) {
                echo "Issuer did not match\n";

                return FALSE;
            }

            // Verify the audience matches the expected audience for this API
            if ($decodedToken['payload']['aud'] != getenv('OKTA_AUDIENCE')) {
                echo "Audience did not match\n";

                return FALSE;
            }

            // Verify this token was issued to the expected client_id
            if ($decodedToken['payload']['cid'] != getenv('OKTA_CLIENT_ID')) {
                echo "Client ID did not match\n";

                return FALSE;
            }

            return TRUE;
        }

        public static function http($url, $params = NULL): string
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            if ($params) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            }

            return json_decode(curl_exec($ch), TRUE);
        }

        public static function base64UrlDecode($input): string
        {
            $remainder = strlen($input) % 4;
            if ($remainder) {
                $padlen = 4 - $remainder;
                $input .= str_repeat('=', $padlen);
            }

            return base64_decode(strtr($input, '-_', '+/'));
        }

        public static function encodeLength($length): string
        {
            if ($length <= 0x7F) {
                return chr($length);
            }
            $temp = ltrim(pack('N', $length), chr(0));

            return pack('Ca*', 0x80 | strlen($temp), $temp);
        }

        public static function base64UrlEncode($text): string
        {
            return str_replace([
                '+',
                '/',
                '=',
            ], [
                '-',
                '_',
                '',
            ], base64_encode($text)
            );
        }

    }
