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
    public function sendSms($recipients, $message)
    {
        $AT = new AfricasTalking($this->username, $this->apiKey);

        // Get one of the services
        $sms = $AT->sms();

        try {
            // Thats it, hit send and we'll take care of the rest
            $result = $sms->send([
                'to' => '+' . $recipients,
                'message' => $message,
            ]);

            print_r($result);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        //\Log::info(print_r($result, true));
        return $result;
    }

    /*public function sendSMSNotification($userName, $api)
    {
        // Set your app credentials
        $username = $userName;
        $apiKey = $api;

        // Initialize the SDK
        $AT = new AfricasTalking($username, $apiKey);

        // Get the SMS service
        $sms = $AT->sms();

        // Set the numbers you want to send to in international format
        $recipients = "+256756999607";

        // Set your message
        $message = "I'm a lumberjack and its ok, I sleep all night and I work all day";

        // Set your shortCode or senderId
        $from = "myShortCode or mySenderId";

        try {
            // Thats it, hit send and we'll take care of the rest
            $result = $sms->send([
                'to' => $recipients,
                'message' => $message,
                'from' => $from
            ]);

            print_r($result);
            \Log::info(print_r($result, true));
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }*/
}
