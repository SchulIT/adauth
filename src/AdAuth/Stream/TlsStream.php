<?php

namespace AdAuth\Stream;

use AdAuth\SocketConnectException;

class TlsStream implements StreamInterface {

    private static $CaFile = '../ca.crt';

    /**
     * @inheritDoc
     */
    public function getStream($host, $port) {
        $options = [
            'ssl' => [
                'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
                'disable_compression' => true,
                'peer_name' => 'dc01.hgg02.lokal',
                'verify_peer' => true,
                'allow_self_signed' => true,
                'cafile' => realpath(__DIR__) . '/' . static::$CaFile,
                'peer_fingerprint' => '2fbfb664b75c8c081412b70e333b7cc16324e0be',
                'ciphers' => 'ECDHE-RSA-AES256-GCM-SHA384:ECDHE-RSA-AES128-GCM-SHA256:DHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES128-GCM-SHA256:ECDHE-RSA-AES256-SHA384:ECDHE-RSA-AES128-SHA256:ECDHE-RSA-AES256-SHA:ECDHE-RSA-AES128-SHA:DHE-RSA-AES256-SHA256:DHE-RSA-AES128-SHA256:DHE-RSA-AES256-SHA:DHE-RSA-AES128-SHA:ECDHE-RSA-DES-CBC3-SHA:EDH-RSA-DES-CBC3-SHA:AES256-GCM-SHA384:AES128-GCM-SHA256:AES256-SHA256:AES128-SHA256:AES256-SHA:AES128-SHA:DES-CBC3-SHA:HIGH:!aNULL:!eNULL:!EXPORT:!DES:!MD5:!PSK:!RC4',
            ]
        ];

        $context = stream_context_create($options);
        $stream = @stream_socket_client('tls://' . $host . ':' . $port, $errno, $errstr, 1, STREAM_CLIENT_CONNECT, $context);

        if(!is_resource($stream)) {
            throw new SocketConnectException('Fehler beim Verbinden: ' . $errstr . ' (code: ' . $errno . ')');
        }

        return $stream;
    }
}