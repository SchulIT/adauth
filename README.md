# AD Auth Server PHP library

Mithilfe dieser Bibliothek kann komfortabel eine Verbindung zum [AD Auth Server](https://github.com/SchulIT/adauth-server)
aufgebaut werden.

## Installation

```
$ composer require schulit/adauth
```

## Benutzung

```php
use AdAuth;
use AdAuth\Credentials;
use AdAuth\Stream\TlsStream;
use JMS\Serializer\Serializer;

$serializer = new Serializer();
$tlsStream = new TlsStream('Pfad zum Zertifikat der verwendeten CA (oder null falls nicht vorhanden)', 'FQDN aus dem Zertifikat des Servers', 'Fingerprint des Zertifikats'); 

$adauth = new AdAuth('öffentliche IP des AD Auth Servers', $tlsStream, $serializer, 55117 /* öffentliche Portnummer */);

$response = $adauth->authenticate(new Credentials('username', 'password'));
$response = $adauth->ping();
```

## Symfony Integration

[Zum Bundle](https://github.com/schulit/adauth-bundle)

## Lizenz

[MIT](LICENSE)