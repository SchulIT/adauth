<?php

namespace AdAuth\Stream;

use AdAuth\SocketConnectException;

class TlsStream implements StreamInterface {

    private $caFile;
    private $peerName;
    private $peerFingerprint;

    public function __construct(string $caFile = null, string $peerName = null, string $peerFingerprint = null) {
        $this->peerName = $peerName;
        $this->peerFingerprint = $peerFingerprint;

        if($caFile !== null) {
            if (!file_exists($caFile)) {
                throw new \InvalidArgumentException(sprintf('CA certificate file "%s" does not exist', $caFile));
            }

            if (!is_readable($caFile)) {
                throw new \InvalidArgumentException(sprintf('CA certificate file "%s" is not readable', $caFile));
            }
        }

        $this->caFile = $caFile;
    }

    /**
     * @inheritDoc
     */
    public function getStream($host, $port) {
        $options = [
            'ssl' => [
                'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
                'disable_compression' => true,
                'peer_name' => $this->peerName,
                'verify_peer' => $this->peerName !== null && $this->caFile !== null,
                'allow_self_signed' => true,
                'cafile' => $this->caFile,
                'peer_fingerprint' => $this->peerFingerprint,
                'ciphers' => 'ECDHE-RSA-AES256-GCM-SHA384:ECDHE-RSA-AES128-GCM-SHA256:DHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES128-GCM-SHA256:ECDHE-RSA-AES256-SHA384:ECDHE-RSA-AES128-SHA256:ECDHE-RSA-AES256-SHA:ECDHE-RSA-AES128-SHA:DHE-RSA-AES256-SHA256:DHE-RSA-AES128-SHA256:DHE-RSA-AES256-SHA:DHE-RSA-AES128-SHA:ECDHE-RSA-DES-CBC3-SHA:EDH-RSA-DES-CBC3-SHA:AES256-GCM-SHA384:AES128-GCM-SHA256:AES256-SHA256:AES128-SHA256:AES256-SHA:AES128-SHA:DES-CBC3-SHA:HIGH:!aNULL:!eNULL:!EXPORT:!DES:!MD5:!PSK:!RC4',
            ]
        ];

        $context = stream_context_create($options);
        $stream = @stream_socket_client('tls://' . $host . ':' . $port, $errno, $errstr, 5, STREAM_CLIENT_CONNECT, $context);

        if(!is_resource($stream)) {
            throw new SocketConnectException('Error connecting using TLS: ' . $errstr . ' (code: ' . $errno . ')');
        }

        return $stream;
    }
}