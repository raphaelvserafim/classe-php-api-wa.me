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

        $this->server =  $dados["server"];
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

    public function getQrCodeHTML($key)
    {
        $this->parth  = "/instance/qrcode?key={$key}";
        $this->method = "GET";
        return $this->request();
    }

    public function getQrCodeBase64($key)
    {
        $this->parth  = "/instance/qrcode_base64={$key}";
        $this->method = "GET";
        return $this->request();
    }


    public function inforInstance($key)
    {
        $this->parth  = "/instance/info?key={$key}";
        $this->method = "GET";
        return $this->request();
    }


    public function updateWebhook($key, $body)
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
        $this->parth    = "/instance/updateWebhook?key={$key}";
        $this->method   = "POST";
        $this->body     = json_encode($body);
        return $this->request();
    }


    public function logout($key)
    {

        $this->parth  = "/instance/logout?key={$key}";
        $this->method = "DELETE";
        return $this->request();
    }

    // Actions 

    public function listContacts($key)
    {
        $this->parth  = "/action/contacts?key={$key}";
        $this->method = "GET";
        return $this->request();
    }

    public function profilePic($key, $to)
    {

        $this->parth  = "/actions/getPicture?key={$key}&to={$to}";
        $this->method = "GET";
        return $this->request();
    }


    public function updateProfileName($key, $name)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/actions/updateProfileName?key={$key}";
        $this->method = "POST";
        $this->body = json_encode(["name" => $name]);
        return $this->request();
    }


    public function updateProfilePicture($key, $body) // AND GROUP
    {
        // ["to" => "string", "url" => "string"] EXEMPLO 
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/actions/updateProfilePicture?key={$key}";
        $this->method = "POST";
        $this->body   = json_encode($body);
        return $this->request();
    }

    public function readReceipt($key, $body)
    {
        // ["to" => "string", "idMsg" => "string"] EXEMPLO 
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/actions/readReceipt?key={$key}";
        $this->method = "POST";
        $this->body   = json_encode($body);
        return $this->request();
    }


    public function downloadMediaMessage($key, $body)
    {
        /* EXEMPLO BODY 
        [
            "messageKeys" => [
                "mediaKey" => "string", 
                "directPath" => "string", 
                "url" => "string", 
                "messageType" => "string" 
            ] 
         ] 
         */
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/actions/downloadMediaMessage?key={$key}";
        $this->method = "POST";
        $this->body   = json_encode($body);
        return $this->request();
    }



    //SendMessage 

    public function sendPresence($key, $body)
    {
        /* EXEMPLO BODY
                 unavailable | available | composing | recording | paused
                [
                    "data" => [
                        "to" => "556696852025", 
                        "status" => "composing" 
                    ] 
                ]
            */
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  =  "/message/setstatus?key={$key}";
        $this->method =  "POST";
        $this->body   =  json_encode($body);
        return $this->request();
    }



    public function sendText($key, $body)
    {
        /*
         [
            "messageData" => [
                  "to" => "556696852025", 
                  "text" => "estou testando a API" 
               ] 
         ]
         */
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/text?key={$key}";
        $this->method = "POST";
        $this->body   =  json_encode($body);
        return $this->request();
    }




    public function enviarMensagemLink($numero,    $texto,   $url)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = '/rest/send/' . $this->key . '/link';
        $this->method = 'POST';
        $this->body   = json_encode(array('messageData' => array('to' => $numero,  'text' => $texto, 'url' => $url)));
        return $this->request();
    }

    public function enviarMensagemMidia($numero,    $url,   $type,   $caption,   $mimeType,   $nameFile)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = '/rest/send/' . $this->key . '/midia';
        $this->method = 'POST';
        $this->body   = json_encode(array('messageData' => array('to' => $numero, 'url' => $url, 'type'    => $type,  'caption' => $caption,  'mimeType' => $mimeType, 'nameFile' => $nameFile)));
        return $this->request();
    }


    public function enviarMensagemBotoes($numero,   $texto,   $rodape,   $botoes)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = '/rest/send/' . $this->key . '/botoes';
        $this->method = 'POST';
        $this->body   = json_encode(array('messageData' => array('to' => $numero, 'text' => $texto, 'buttons' => $botoes,  'footerText' => $rodape)));
        return $this->request();
    }


    public function enviarMensagemLista($numero,   $nomeLista,   $nomeBtn,    $texto,   $rodape,   $sections)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = '/rest/send/' . $this->key . '/botoesLista';
        $this->method = 'POST';
        $this->body   = json_encode(
            array(
                'messageData' =>  array(
                    'to' => $numero,
                    'buttonText' => $nomeBtn,
                    'text' =>  $texto,
                    'title' => $nomeLista,
                    'description' => $rodape,
                    'sections' => $sections,
                    'listType' => 0,
                )
            )
        );
        return $this->request();
    }


    public function enviarLocalizacao($numero,    $latitude,   $longitude)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = '/rest/send/' . $this->key . '/localizacao';
        $this->method = 'POST';
        $this->body   = json_encode(array('messageData' => array('numero_whatsapp' => $numero, 'coordenadas' => array('latitude' => $latitude, 'longitude' => $longitude))));
        return $this->request();
    }

    public function enviarContato($numero,    $nome,   $phoneNumber)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = '/rest/send/' . $this->key . '/contato';
        $this->method = 'POST';
        $this->body   = json_encode(array('messageData' => array('to' => $numero, 'vcard' => array('fullName' => $nome, 'displayName' => $nome, 'organization' => '', 'phoneNumber' => $phoneNumber))));

        return $this->request();
    }




    public function grupos()
    {
        $this->parth  = '/rest/group/' . $this->key . '/list';
        $this->method = 'GET';
        return $this->request();
    }


    public function gruposADM()
    {
        $this->parth  = '/rest/group/' . $this->key . '/adminGroups';
        $this->method = 'GET';
        return $this->request();
    }

    public function criarGrupo($nome, $participantes)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = '/rest/group/' . $this->key . '/create';
        $this->method = 'POST';
        $this->body   = json_encode(array('group_data' => array('group_name' => $nome, 'participants' => $participantes)));

        return $this->request();
    }
}
