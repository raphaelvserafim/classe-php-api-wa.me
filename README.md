# WhatsApp API PHP api-wa.me  

##### Gerar Instância Key:
 
Acessar: <a href="https://api-wa.me">api-wa.me</a>

<a href="https://server.api-wa.me/docs/">Swagger</a>

#####  Contact:
<a href="https://wa.me/5566996852025"> 
<img src="https://img.shields.io/badge/WhatsApp-25D366?style=for-the-badge&logo=whatsapp&logoColor=white" /> 
</a>


## Installing via composer

```
composer require cachesistemas/classephpapiwame
```

### EXAMPLES




#####  WHATSAPP   

```php
 
use Cachesistemas\ClassePhpApiWame\WhatsApp;

include_once 'vendor/autoload.php';

$whasapp     = new WhatsApp(["server" => "API server", "key" => "Your Key Instance"]);

```

#### Get QrCode HTML

```php
echo $whasapp->getQrCodeHTML();
```

 