# Classe WhatsApp PHP api-wa.me 

##### SITE 
 
<a href="https://api-wa.me">api-wa.me</a>


## Instalando via composer 

```
composer require cachesistemas/classephpapiwame
```

#####  WHATSAPP   

```php
 
use Cachesistemas\ClassePhpApiWame\WhatsApp;

include_once 'vendor/autoload.php';

$whasapp     = new WhatsApp(["server" => "Servidor da API", "key" => "Sua Instância Key"]);

```

### EXEMPLOS


#####  SIMULAR PRESENÇA 

```php
echo $whasapp->simularPresenca("5566996852025",   "composing"); //  unavailable  |  available |  composing  |  recording  |  paused

```
#### RETORNO
```json
{"status":true,"whatsapp":"556696852025@s.whatsapp.net"} 
```


##### ENVIAR MENSAGEM DE TEXTO   

```php
 echo $whasapp->enviarMensagemTexto("5566996852025",  "Oie");
```
#### RETORNO
```json

{"error":false,"message":"Mensagem enviada","messageData":{"key":{"remoteJid":"556696852025@s.whatsapp.net","fromMe":true,"id":"BAE58DC39F03C286"},"message":{"extendedTextMessage":{"text":"Oie"}},"messageTimestamp":"1653332312","status":"PENDING"}}
 
```

