# Active Directory Authentication Server PHP library

Mithilfe dieser Bibliothek kann komfortabel eine Verbindung zum [Active Directory Authentication Server](https://github.com/SchulIT/adauth-server)
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

$tlsStream = new TlsStream('Pfad zum Zertifikat der verwendeten CA (oder null falls nicht vorhanden)', 'FQDN aus dem Zertifikat des Servers', 'Fingerprint des Zertifikats'); 

$adauth = new AdAuth('öffentliche IP des AD Auth Servers', $tlsStream, 55117 /* öffentliche Portnummer */);

$response = $adauth->authenticate(new Credentials('username', 'password'));
$response = $adauth->
$response = $adauth->ping();
```

## Symfony Integration

[Zum Bundle](https://github.com/schulit/adauth-bundle)

## Kompatiblität

Diese Version ist kompatibel mit Version 2.0.0 des [Servers](https://github.com/schulit/adauth-server).

## Lizenz

[MIT](LICENSE)