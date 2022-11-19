# WhatsApp API - PHP

##### Gerar Instância Key:
 
Acessar: <a href="https://api-wa.me">api-wa.me</a>

<a href="https://server.api-wa.me/docs/">Swagger</a>

#####  Group:
<a href="https://chat.whatsapp.com/EGaVNCyiRX21A5OWdlhOQw"> 
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

### send Presence
 ```php
 $to     = '556696852025'; // if it's a group, use full id ex: 123456789@g.us  
 $status = 'composing';   // unavailable | available | composing | recording | paused
echo $whasapp->sendPresence($to, $status);
```

### send Text
 ```php
 $to     = '556696852025'; // if it's a group, use full id ex: 123456789@g.us  
 $text   = 'Hi';   
echo $whasapp->sendText($to, $text);
```

###  send Media 
<a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types" target="_blank">MimeType list</a>  

 ```php 
$to         = '556696852025'; // if it's a group, use full id ex: 123456789@g.us  
$url        = '';
$type       = 'image'; //  image |  video | audio | document
$caption    = 'Hi';  
$mimeType   = 'image/jpge';    
$ptt        = false; // if it's audio 
echo $whasapp->sendMedia($to, $url, $type, $caption, $mimeType, $ptt);
```
 
 ### Send Button
 ```php
    $body = [
        "to" => "556696852025",
        "data" => [
            "text" => "Recebeu ?",
            "buttons" => [
                [
                    "title" => "Sim",
                    "id" => "1"
                ],
                [
                    "title" => "Não",
                    "id" => "2"
                ]
            ],
            "footerText" => "Escolha uma opção"
        ]
    ];
echo $whasapp->sendButton($body);
```

 ### Send Template Buttons
 ```php
    $body = [
        "to" => "556696852025",
        "data" => [
            "text" => "Finalizar a compra",
            "buttons" => [
                [
                    "type" => "urlButton", // replyButton | urlButton | callButton 
                    "title" => "Pagar",
                    "payload" => "https://api-wa.me"
                ]
            ],
            "footerText" => "Visite o site para finalizar"
        ]
    ];
echo $whasapp->sendTemplateButtons($body);
```
 

 ### Send List 
 ```php
    $body = [
        "messageData" => [
            "to" => "556696852025",
            "buttonText" => "Menu",
            "text" => "Esse nosso menu",
            "title" => "Menu",
            "description" => "veja nosso menu",
            "sections" => [
                [
                    "title" => "Menu 01",
                    "rows" => [
                        [
                            "title" => "Opção 01",
                            "description" => "essa é uma opção",
                            "rowId" => "1"
                        ],
                        [
                            "title" => "Opção 02",
                            "description" => "essa é outra opção",
                            "rowId" => "2"
                        ]
                    ]
                ]
            ],
            "listType" => 0
        ]
    ];
echo $whasapp->sendList($body);
```


### send Contact
 ```php
 $to     = '556696852025'; // if it's a group, use full id ex: 123456789@g.us  
 $name   = 'CACHE SISTEMAS';   
 $number = '+556696883327';
echo $whasapp->sendContact($to, $name, $number);
```

### send Location
 ```php
 $to     = '556696852025'; // if it's a group, use full id ex: 123456789@g.us  
 $lat    = 35.000;   
 $lon    = 20.000;
 $address = 'Rua do fulando';
echo $whasapp->sendLocation($to, $lat, $lon, $address);
```

### send Reaction
 ```php
 $to     = '556696852025'; // if it's a group, use full id ex: 123456789@g.us  
 $text   =  '😘';   
 $msgId  =  '';
echo $whasapp->sendReaction($to, $text, $msgId);
```
