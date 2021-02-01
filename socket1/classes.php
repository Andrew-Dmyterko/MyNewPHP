<?php
class Connect
{
    public function sendHeaders($headersTxt, $newSocket){
        $headers = [];
        $arrHeaders = explode("\r\n", $headersTxt);

        foreach($arrHeaders as $value){
            $arrValue = explode(": ", trim($value));
            if(isset($arrValue[0],$arrValue[1])){
                $headers[$arrValue[0]] = $arrValue[1];
            }
        }

        $key = $headers['Sec-WebSocket-Key'];
        $sKey = base64_encode(pack('H*', sha1($key.'258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));

        $responseHeaders = "HTTP/1.1 101 Switching Protocols\r\n".
            "Upgrade: websocket\r\n".
            "Connection: Upgrade\r\n".
            "Sec-WebSocket-Accept: $sKey\r\n\r\n";

        socket_write($newSocket, $responseHeaders);
    }

    public function createMessageConnect($client_ip){
        $message = "Client ip: ".$client_ip.", connect!";
        $messageArray = [
            'message' => $message,
            'type' => 'createMessageConnect'
        ];
        $ask = $this->seal(json_encode($messageArray));
        return $ask;
    }

    public function createMessageDisconnect($client_ip){
        $message = "Client ip: ".$client_ip.", disconnected!";
        $messageArray = [
            'message' => $message,
            'type' => 'createMessageDisconnect'
        ];
        $ask = $this->seal(json_encode($messageArray));
        return $ask;
    }

    public function sendMessage($message, $clientSocketArray){

        $messageLenght = strlen($message);

        foreach($clientSocketArray as $clientSocket){
            @socket_write($clientSocket, $message, $messageLenght);
        }

        return true;
    }

    public function seal($data){

        $b1 = 0x81;
        $lenght = strlen($data);
        $header = '';

        if($lenght <= 125){
            $header = pack('CC', $b1, $lenght);
        }elseif($lenght > 125 && $lenght < 65536){
            $header = pack('CCn', $b1, 126, $lenght);
        }else{
            $header = pack('CCNN', $b1, 127, $lenght);
        }

        return $header.$data;
    }

    public function unseal($data){

        $lenght = ord($data[1]) & 127;

        if($lenght == 126){
            $mask = substr($data, 4, 4);
            $txt = substr($data, 8);
        }elseif($lenght == 127){
            $mask = substr($data, 10, 4);
            $txt = substr($data, 14);
        }else{
            $mask = substr($data, 2, 4);
            $txt = substr($data, 6);
        }

        $socketStr = '';

        for($i=0; $i<strlen($txt); ++$i){
            $socketStr .= $txt[$i] ^ $mask[$i%4];
        }

        return $socketStr;
    }

    public function createChatMessage($user, $message, $pKey){
        $messageNew = "User : $user, message: $message, key: $pKey";
        $messageArray = [
            'message' => $messageNew,
            'type' => 'createChatMessage'
        ];

        $ask = $this->seal(json_encode($messageArray));

        return $ask;
    }

}