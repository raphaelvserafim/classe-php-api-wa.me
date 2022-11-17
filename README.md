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

#### Get QrCode Base64
```php
echo $whasapp->getQrCodeBase64();
```

#### Infor Instance
```php
echo $whasapp->inforInstance();
```

#### Update Webhook
```php
$body = ["allowWebhook" => false,"webhookMessage" => "","webhookGroup" => "","webhookConnection" => "","webhookQrCode" => ""];
        
echo $whasapp->updateWebhook($body);
```

#### Logout
```php
echo $whasapp->logout();
```
 
## Actions

### Get List Contacts
```php
echo $whasapp->listContacts();
```

### Get Profile  Pic
```php
echo $whasapp->profilePic('556696852025');
```

### Update Profile Name
```php
echo $whasapp->updateProfileName('Raphael Serafim');
```
 
### Update Profile And Group  Picture
```php
$url =''; // url image 
$id  ='556696852025'; // if it's a group, use full id ex: 123456789@g.us 
echo $whasapp->updateProfilePicture($id, $url);
```

### Read Receipt
```php
$MsgId ='';  
$to  ='556696852025'; // if it's a group, use full id ex: 123456789@g.us 
echo $whasapp->readReceipt($to, $MsgId);
```

### Download Media  
```php
  $body = [
    "messageKeys" => [
        "mediaKey" => "", 
        "directPath" => "", 
        "url" => "", 
        "messageType" => "" 
    ] 
  ];
echo $whasapp->downloadMediaMessage($body);
```

## Send Message
  #### if it's a group, use full id ex: 123456789@g.us 

### send Presence
 ```php
 $to     = '556696852025'; 
 $status = 'composing';   // unavailable | available | composing | recording | paused
echo $whasapp->sendPresence($to, $status);
```