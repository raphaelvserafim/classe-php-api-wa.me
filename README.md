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


##### ENVIAR MENSAGEM DE LINK    

```php
echo $whasapp->enviarMensagemLink("5566996852025", "Olha essa API WhatsApp",   "https://api-wa.me");
```
#### RETORNO
```json
{"error":false,"message":"Mensagem enviada","messageData":{"key":{"remoteJid":"556696852025@s.whatsapp.net","fromMe":true,"id":"BAE58D3281820560"},"message":{"extendedTextMessage":{"text":"Olha essa API WhatsApp\nhttps://api-wa.me","matchedText":"api-wa.me","canonicalUrl":"https://api-wa.me/","description":"API WhatsApp teste grátis por 07 dias","title":"API WhatsApp | 07 dias Grátis","previewType":"NONE","jpegThumbnail":"/9j/2wBDABALDA4MChAODQ4SERATGCgaGBYWGDEjJR0oOjM9PDkzODdASFxOQERXRTc4UG1RV19iZ2hnPk1xeXBkeFxlZ2P/2wBDARESEhgVGC8aGi9jQjhCY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2P/wAARCAB+AMADASIAAhEBAxEB/8QAGwAAAgIDAQAAAAAAAAAAAAAAAAYEBQIDBwH/xABEEAACAQMBBQQGBggDCQEAAAABAgMABBEFBhIhMUETFFFhByJxgZHBMjVSc3SxFSNCU4KSobI2otEkMzRDVHLC4fDx/8QAGQEBAAMBAQAAAAAAAAAAAAAAAAECAwUE/8QAJBEBAQACAgIBAwUAAAAAAAAAAAECEQMxEiEEEyJBFDIzUWH/2gAMAwEAAhEDEQA/AOf0UUUBRRRQFFFFAVlHG80ixxIzuxwFUZJPsrGuieju2h/RM1z2S9uZinaY47uBwz76Co0rYS8uQJNQkFqh47g9Zz8hVFrtlHp2s3NpCWMcTALvHJxgH512OuV7bpubT3Jx9II3+UUEPWwANOwMf7FH86rKtNc5ad+Cj+dW+gbOQ3VvFJOhlkmGVXewFFRbppx8d5LqFSrKNEOzdw5Vd8XcYDY4gbj8M02JsDC92XlmeKDH+7TiSfInpUTanQrfRNCKWskjpNcocSYJGFbqPbUqZTV0ptnNB/Tr3MYn7FokDKd3IJJ5GtOr7P6ho7ZuYcxZwJU4off099Mvo1j46hJ92v8AdTw6LIhR1DKwwQRkEUQ4dRTJtvpNppeoxdzQxpMhYpngDnpS3QFFFFAUUUUBRRRQFFFFAUUUUBRRRQFdJ9Hf1BL+Ib+1a5tXSfR39QS/iG/tWgaqQNtr4WethTYWc2/Crb8sZLcyPEeFP9c79I6Y1S1fxhx8GP8ArQTxpt5qdnY3NtYaW0bQRgiVWyvE5wM8hTLDp9ta2QRkiHZpxcJuqMeWeA99cy1iR4jpxjdkPco+KnHjULvN9cgxdvcSgjim+zZ91Fscrj1TBf7ZTPIFtLeIRL1feBJ9zVi2tPcaFPcTWVnIwuY1w6MQfVfjxbn/AKmlkggkEYI6VZRf4YuPxkX9j0Msrld077B3AurG6lFrb2/60LiFSoOB1yT4000rejxN3QZG+1Ox/oBTTRVz70kfWFn90fzpNpy9JH1hZ/dH86TaAooooCiiigKKKKAooooCiiigKKKy3HxndOPHFBjXSfR39QS/iG/tWubV0fYCWOHZyeSV1RFuGJZjgD1VoGyqTaLUdK04wNqdoJzJvBD2SvjGM8+XOpv6Z03/AK6D+alTb24t7+1tO6TJOyO2QhyQCP8A1TQ3PtVsy+7v6cW3VCrm2Q4HgOPKtlvths9asWt7OSEsMExwKpPwNIHdp/3T/Cju0/7p/hTQfJNqtmZZGkk08u7HJZrZCSfbmvBtVsyIzGNOO4SGK92TBPjjNIndp/3T/Cju0/7pvhTQ6/otzZ3mmx3FhD2MDk7q7gTrg8B7Kn0ubMahY2ez9nBNdRRyKp3lZsEEsT86uYNSsrmURwXUUjnkqtxNAkekj6ws/uj+dJtOXpI+sLP7o/nSbQFFFFAUUUUBRRRQFFFFAUUUUEy1t+Ujj2CpleLyGK9rSTQ0y20cjBiMHrjrV/o88EOy13YtIvbm4Eiqf2lyvL4VWRW0srKAjAH9ojhVtaaZEmj3t4xLSxTLEngB6pz7eNVy0WXW2ts4wPjXgzjiM1tjMYLdojMMHGGxg+NTo4rQ4Vo494KCSbvAP9P6Vx8fc088Vv8ADR/DU/sLdXjBMLZLE7tyMY6DOOHzryBLbdjWVEZnBO93ndA8jw4Gp8TSD/DWLAkDGV4+VTbu3jTMkckATh6izb7flUWo941HTWVY72CRnly4VO0f64suH/M+RqLUvSPrmy+8+RrTiytzi2N9tXpAh7bUrPPBRCcn+Klg2kRGMEeeaeNf0qTUteQCXdQW4Y5HLDYwPbxNK99Zy2Fy1vOBvgA5U5BB8K6k109GrravjtEjfeyW8Aa9uow8RPVRkGt9R7wMYcqxAHMeNT+EK+iiiqAooooCiimTZDZptauDPcgrZRHDY4GQ/ZHzNAutG6orsjBXzukjgcc8VjTd6RYFg1OzjiRUhW2CoqjAGGPAVWbH6a2o7QW43cxQN2shI4YHIe84oI1tIJIR4jgatNNjilWRHUFgQRnwqNtTpx0TXpUhG7DL+sjHTB6e45FaLea8iYSRxKDjqeHwq3cWxurumKWRIo2kkYKqjJJrLS5u8bH383LfvQQPAepSnqM97LjvLep0C/RFM+gf4Fu/xY/8KprS3Jn5dNdbIpXQFFbCuQGHDjx868jieUsI1LFQWOOgFWMFi+6wEVx2ciqc9ijEnnwyeArlY429PHJUhJp3eVTJMwVsDE0Q6f191R5t6MuoMihYCADLGeGfLn+dbSd50VIiQ5Zf+EjByPDjUZIbmWCNreBnHZlGJiXHPp4+3nW1t/1Z5NeXNsyxRTOqBBgEo39RUJ3aR2dzlmOSfGs2t5knEDRkSkgBTz41IudLubaHtX3GUc905xWN8skeOWU3EKpekfXNl958jUSpekfXNl958jVuD+SIx7Xd9dpBtLbwSMF7xbkLnqwbOPhmlnaqRX1gqv7Eaqfbz+dZ+kMOdUsezJDdmcEdPW51RtK87tJI5kdjxY82NdXGe9vX5/b4itN2cW7efCt1YyKGjYHqKuoqaKbthNDXUe+z3KZtzEYB5s3Mj2D86Wb+0ksL6e0m+nC5U+eOtZiPRRRQb7C0kv72G1hGZJXCjy867Tp1lDp1jDaW64jiXA8/EnzPOuS6NcPYSJd22FnXIDEZxnhyNN+z+tatqF86NMZFSPe3RGME5GMnoOfGp0Kna+e/1vUYIE0m4hEbFImdCGkzj3AcKa9F0y12W0VmnkUSNhppeeW6AeOOlX/XhSHtZqXfNQ7vG2Ybc7vDkW6n5Uk2F+/ja+v3uLi6mucn1TIADj2DgB5Cs6KK0k0PGUMCCAQehqTbXklrp8ljGEFvI4kIxxzw5H3Co9FLNoT0dZFyP/ysq1aTElxqEVvJK0Synd3lAPHpzpnOy0eOF7Nn/sWubn8SzL7b6Z3jv4LtFR5bPXrdGluLEpEnFnyOA8edQpb25AHZgMc8c1X9Jn/cR9Orq2mNvcRzAZ3DnHjTQzJe2LmM7yyIQKQ4pry5kWG2TtZm4Kgxxpl2ai1a3eaPUbRoYiAyNkEZ8OB/+xWuHDnhuXp6ODeN8b1VTy58636fMlvqVtNKcJG5Zj5BTV22g213cSst66vneaNQp3c1SbQWEOnPFClxJLIwLMGAG6OnKo4vj5TOXbH6dxyQ9Y1BtWuxPJGqBFKoo6DOePnUIIoAAAGPKvaK6GmjExqawaHe9UPug8CcZwPGttFB0OwtLc7PJbaPc9jGU3UmVQWB6kg9edc22o0WfRr9FnujdGZd/tSCCeOOOSaZdkdS7rf91kb9TcHAz0fp8eXwq/17Zq3125tpLmaREhDAqgGWzjqeXKs7NDkNFdettkdDtlAFgkh8ZSWz8aWtsrrSNNzYWOm2femHrv2Q/VA/P8qgK1iWWIgjHHqKc9hGjSa9klkRPVRRvMB1JpKtL0Iu5NkqOR54qR363+1/lq/rQvNY1rU/0pdRpqEqxpKyoI23RjPDlVKSxOS7ZPnXgdZPWT6J5V7Uj3ef7Rr3tH8jWNFBmJj1X4GshKnUke0VqoqRJilKSLJGfWQhgR4iukw39tLBHL28S76hsFwMZFcsx7vZWS5Z1DHgTjOKizY6Lrc8M2jXccU0Tu0ZAVXBJ4ilCLT4VjxIu+x5nP5VjJJa6ZDlyAT/ADNUGTW0fIV9weSnNZ+702kxw/d2n6CEt9pLcM4CI7DeY4HI03a9cq2kT91u41lUBvUkGSM8RXODeW5/bP8ALXnerb7Z/lq/piv9A1EafqaySsRFJ6kh8vH3Gouo3jX9/Nct+23qjwHQfCoqkMARyPGvatoeMwUZNazMei/E15I2TjoKxoPe0c+Ao3n+0a8oqB6GcEEOwIOQQeVXeia1qR1a1jkv5WieQBxK2RjrzqjrwusfrOfVHOgftotrItIKw20Bup2XeyD6i+0jmfKuX3Us1xcST3BYySsWYnqTVib+AKd0knwAqtmmaaQu59g8KpZINdFFFQJ1i+YynVTUqqcEg5Bwa3pdyLzww86tKLGioqXqngVIPlUhHDjIqwyorFmCjJqO96q8ArE0EqsJJkiG8593U1Ce8kb6OFHlWgksckknzqvkM55nuJTI5JJ5ZOcCtdFFVBRRRQW1nOrQqCeIGDW5pBjhzqkBKnIJB8q3peSL9LDDzq8yFhRUZLxGOCrA1vVgwyKkZUVi7hBk5qO96o4BCT58KbEqol8+ECDmTk1pe7lbkQo8q0EknJOTVbQUUUVUf//Z"}},"messageTimestamp":"1653333376","status":"PENDING"}} 
```

