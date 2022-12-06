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

        $this->parth  = "/manager/create?key={$key}&admin_key={$admin_key}";
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
        $this->parth  = "/instance/qrcode_base64?key={$this->key}";
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


    public function updateProfilePicture($to, $url)
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

    public function sendAudio($to, $url, $ptt = true)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/audio?key={$this->key}&ptt={$ptt}";
        $this->method = "POST";
        $this->body   =  json_encode([
            "messageData" => [
                "to" => $to,
                "url" => $url
            ]
        ]);
        return $this->request();
    }


    public function sendMedia($to, $url, $type, $caption, $mimeType = '', $ptt = false)
    {

        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/media?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode([
            "data" => [
                "to" =>  $to,
                "url" =>  $url,
                "type" => $type,
                "caption" => $caption,
            ]
        ]);
        return $this->request();
    }


    public function sendButton($body)
    {

        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/button?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode($body);
        return $this->request();
    }

    public function sendTemplateButtons($body)
    {

        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/message/templateButtons?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode($body);
        return $this->request();
    }


    public function sendList($body)
    {
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



    // Group 

    public function listGroup()
    {
        $this->parth  = "/group/list?key={$this->key}";
        $this->method = "GET";
        return $this->request();
    }

    public function inforGroup($group_id)
    {
        $this->parth  = "/group/infor?key={$this->key}&group_id={$group_id}";
        $this->method = "GET";
        return $this->request();
    }

    public function  groupInviteCode($group_id)
    {
        $this->parth  = "/group/groupInviteCode?key={$this->key}&group_id={$group_id}";
        $this->method = "GET";
        return $this->request();
    }


    public function createGroup($name, $participants)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/group/create?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode([
            "group_data" => [
                "group_name" => $name,
                "participants" => $participants
            ]
        ]);
        return $this->request();
    }

    public function addParticipantsGroup($group_id, $participants)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/group/addParticipants?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode([
            "group_data" => [
                "group_id" => $group_id,
                "participants" => $participants
            ]
        ]);
        return $this->request();
    }

    public function promoteParticipantsGroup($group_id, $participants)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/group/promoteParticipants?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode([
            "group_data" => [
                "group_id" => $group_id,
                "participants" => $participants
            ]
        ]);
        return $this->request();
    }

    public function demoteParticipantsGroup($group_id, $participants)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/group/demoteParticipants?key={$this->key}";
        $this->method = "POST";
        $this->body   = json_encode([
            "group_data" => [
                "group_id" => $group_id,
                "participants" => $participants
            ]
        ]);
        return $this->request();
    }

    public function setWhoCanSendMessageGroup($group_id,   $allow)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/group/setWhoCanSendMessage?key={$this->key}&group_id={$group_id}&allowOnlyAdmins=" . $allow;
        $this->method = "POST";
        return $this->request();
    }

    public function setWhoCanChangeSettingsGroup($group_id,   $allow)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/group/setWhoCanChangeSettings?key={$this->key}&group_id={$group_id}&allowOnlyAdmins=" . $allow;
        $this->method = "POST";
        return $this->request();
    }


    public function removeParticipantsGroup($group_id, $participants)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/group/removeParticipants?key={$this->key}";
        $this->method = "DELETE";
        $this->body   = json_encode([
            "group_data" => [
                "group_id" => $group_id,
                "participants" => $participants
            ]
        ]);
        return $this->request();
    }

    public function leaveGroup($group_id)
    {
        array_push($this->header, 'Content-Type: application/json');
        $this->parth  = "/group/leaveGroup?key={$this->key}&group_id={$group_id}";
        $this->method = "DELETE";
        return $this->request();
    }
}
