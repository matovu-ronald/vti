<?php

namespace App\Utilities;

use AfricasTalking\SDK\AfricasTalking;

class SendSMS
{
    private $username;
    private $apiKey;

    public function __construct($username, $apiKey)
    {
        $this->username = $username;
        $this->apiKey = $apiKey;
    }

    /**
     * Send sms.
     *
     * @param $recepients
     * @param $sentMessage
     * @return array
     */
    public function sendSms($recipients, $message, $from)
    {
        $AT = new AfricasTalking($this->username, $this->apiKey);

        // Get one of the services
        $sms = $AT->sms();

        try {
            // Thats it, hit send and we'll take care of the rest
            $result = $sms->send([
                'to'      => $recipients,
                'message' => $message,
                'from'    => $from,
            ]);

            print_r($result);
        } catch (Exception $e) {
            echo 'Error: '.$e->getMessage();
        }

        return $result;
    }
}
