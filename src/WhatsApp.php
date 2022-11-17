<?php

namespace Cachesistemas\ClassePhpApiWame;


class WhatsApp
{
    private $key;
    private $server;
    private $header = array();
    private $parth;
    private $method;
    private $body;

    public function __construct(array $dados)
    {
        $this->server   =   $dados["server"];

        if (isset($dados["key"])) {
            $this->key      =   $dados["key"];
        }
    }


    private function request()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->server . $this->parth);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $this->body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }


    // ManagerInstance // 
    public function ListAllInstance($admin_key)
    {
        $this->parth  = "/instance/list?admin_key={$admin_key}";
        $this->method = "GET";
        return $this->request();
    }


    public function Create($admin_key,  $key,   $body)
    {

        /* EXEMPLO 
        $body = [
        "allowWebhook" => true, 
        "webhookMessage" => "", 
        "webhookGroup" => "", 
        "webhookConnection" => "", 
        "webhookQrCode" => "" 
        ]; 
        */

        $this->parth  = "/instance/create?key={$key}&admin_key={$admin_key}";
        $this->method = "POST";
        $this->body   = json_encode($body);

        return $this->request();
    }

    public function Delete($admin_key,   $key)
    {
        $this->parth  = "/instance/delete?key={$key}&admin_key={$admin_key}";
        $this->method = "DELETE";
        return $this->request();
    }




    //Instance

    public function getQrCodeHTML()
    {
        $this->parth  = "/instance/qrcode?key={$this->key}";
        $this->method = "GET";
        return $this->request();
    }

    public function getQrCodeBase64()
    {
        $this->parth  = "/instance/qrcode_base64={$this->key}";
        $this->method = "GET";
        return $this->request();
    }


    public function inforInstance()
    {
        $this->parth  = "/instance/info?key={$this->key}";
        $this->method = "GET";
        return $this->request();
    }


    public function updateWebhook($body)
    {
        /* EXEMPLO 
        $body = [
        "allowWebhook" => true, 
        "webhookMessage" => "", 
        "webhookGroup" => "", 
        "webhookConnection" => "", 
        "webhookQrCode" => "" 
        ]; 
        */

        array_push($this->header, 'Content-Type: application/json');
        $this->parth    = "/instance/updateWebhook?key={$this->key}";
        $this->method   = "POST";
        $this->body     = json_encode($body);
        return $this->request();
    }


    public function logout()
    {
        $this->parth  = "/instance/logout?key={$this->key}";
        $this->method = "DELETE";
        return $this->request();
    }


    // Actions 

    public function listContacts()
    {
        $this->parth  = "/action/contacts?key={$this->key}";
        $this->method = "GET";
        return $this->request();
    }

    public function profilePic($to)
    {
        $this->parth  = "/actions/getPicture?key={$this->key}&to={$to}";
        $this->method = "GET";
        return $this->request();
    }


    public function updateProfileName($name)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/actions/updateProfileName?key={$this->key}";
        $this->method = "POST";
        $this->body = json_encode(["name" => $name]);
        return $this->request();
    }


    public function updateProfilePicture($to, $url) // AND GROUP
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/actions/updateProfilePicture?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode(["to" => $to, "url" => $url]);
        return $this->request();
    }


    public function readReceipt($to, $MsgId)
    {
        $body = ["to" => $to, "idMsg" => $MsgId];
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/actions/readReceipt?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode($body);
        return $this->request();
    }


    public function downloadMediaMessage($body)
    {
        /* EXEMPLO BODY 
       $body = [
            "messageKeys" => [
                "mediaKey" => "string", 
                "directPath" => "string", 
                "url" => "string", 
                "messageType" => "string" 
            ] 
         ] 
         */
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/actions/downloadMediaMessage?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode($body);
        return $this->request();
    }



    //SendMessage 

    public function sendPresence($to, $status)
    {

        array_push($this->header, 'Content-Type: application/json');
        $this->parth  =  "/message/setstatus?key={$this->key}";
        $this->method =  "POST";
        $this->body   =  json_encode([
            "data" => [
                "to" =>  $to,
                "status" => $status
            ]
        ]);
        return $this->request();
    }



    public function sendText($to, $text)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/text?key={$this->key}";
        $this->method = "POST";
        $this->body   =  json_encode([
            "messageData" => [
                "to" => $to,
                "text" => $text
            ]
        ]);
        return $this->request();
    }


    public function sendMedia($to, $url, $type, $caption, $mimeType, $ptt = false)
    {

        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/media?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode([
            "data" => [
                "to" =>  $to,
                "url" =>  $url,
                "type" => $type,
                "ptt" => $ptt,
                "caption" => $caption,
                "mimeType" => $mimeType
            ]
        ]);
        return $this->request();
    }


    public function sendButton($body)
    {
        /* EXEMPLO BODY 
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
        */
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/button?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode($body);
        return $this->request();
    }

    public function sendTemplateButtons($body)
    {
        /* EXEMPLO BODY  replyButton | urlButton | callButton
        $body = [
            "to" => "556696852025",
            "data" => [
                "text" => "Finalizar a compra",
                "buttons" => [
                    [
                        "type" => "urlButton",
                        "title" => "Pagar",
                        "payload" => "https://api-wa.me"
                    ]
                ],
                "footerText" => "Visite o site para finalizar"
            ]
        ];
        */

        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/templateButtons?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode($body);
        return $this->request();
    }


    public function sendList($body)
    {
        /* EXEMPLO BODY 
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
        */

        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/list?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode($body);
        return $this->request();
    }



    public function sendContact($to, $name, $number)
    {

        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/contact?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode([
            "to" => $to,
            "vcard" => [
                "fullName" => $name,
                "displayName" => $name,
                "organization" =>  "",
                "phoneNumber" => $number
            ]
        ]);
        return $this->request();
    }

    public function sendLocation($to, $lat, $lon, $address)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/location?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode([
            "data" => [
                "to" => $to,
                "location" => [
                    "latitude" => $lat,
                    "longitude" => $lon,
                    "address" => $address
                ]
            ]
        ]);
        return $this->request();
    }


    public function sendReaction($to, $text, $MsgId)
    {

        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/reaction?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode([
            "data" => [
                "to" => $to,
                "text" => $text,
                "MsgId" => $MsgId
            ]
        ]);
        return $this->request();
    }
}
