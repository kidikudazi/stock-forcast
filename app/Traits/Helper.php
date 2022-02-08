<?php 
namespace App\Traits;

trait Helper{
	/**
    * Sms Api
    */
    private $sms_api = 'https://smartsmssolutions.com/api/json.php?';
    private $sms_token = 'mMlf3KlPjYGcbpbyLKFCb2IKPvnAkoiOa56sO31jwhIHSlAYvzNvRLCHbEJj3pBcrzLLgEWXVfI0r7QwI6m12SGWgwFQQ1wMQh6K';

    /**
    * send sms  broadcast notification
    */
	private function sendNotification($receiver, $message){
		// collate data
		$params = [
			"token"=> $this->sms_token,
            "to" => $receiver,
            "message" => $message."(PRODUCT FORCAST)",
            "routing" => 3,
            "type" => '0',
            "sender" => "PRODUCT"
        ];

		try{
			$params = http_build_query($params);
	        $initiate = curl_init();
	        curl_setopt($initiate, CURLOPT_URL, $this->sms_api);
	        curl_setopt($initiate, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($initiate, CURLOPT_POST, 1);
	        curl_setopt($initiate, CURLOPT_POSTFIELDS, $params);
	        $output = curl_exec($initiate);
	        curl_close($initiate);
	        $send_message = json_decode($output);
        
            if ($send_message->code == "1000") {

                return true;
            } else {
               return false;
            }

        }catch(\Exception $ex){
        	return false;
        }
	}
}



?>