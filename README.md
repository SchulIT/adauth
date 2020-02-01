# AD Auth Server PHP library

Mithilfe dieser Bibliothek kann komfortabel eine Verbindung zum [AD Auth Server](https://github.com/SchulIT/adauth-server)
aufgebaut werden.

## Installation

```
$ composer require schoolit/adauth
```

## Benutzung

```php
use AdAuth;
use AdAuth\Credentials;
use AdAuth\Stream\TlsStream;
use AdAuth\Stream\UnencryptedStream;
use JMS\Serializer\Serializer;

$serializer = new Serializer();
$unencryptedStream = new UnencryptedStream();  // HIGHLY DISCOURAGED!
$tlsStream = new TlsStream('Pfad zum Zertifikat der verwendeten CA (oder null falls nicht vorhanden)', 'FQDN aus dem Zertifikat des Servers', 'Fingerprint des Zertifikats'); 

$adauth = new AdAuth('öffentliche IP des AD Auth Servers', $tlsStream /* oder $unencryptedStream */, $serializer, 55117 /* öffentliche Portnummer */);

$response = $adauth->authenticate(new Credentials('username', 'password'));
$response = $adauth->ping();
```

## Symfony Integration

[Zum Bundle](https://github.com/schulit/adauth-bundle)

## Console

Es gibt ein CLI-Interface für die Bibliothek:

```
$ php bin/adauth.php
```