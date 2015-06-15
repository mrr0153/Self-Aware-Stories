<?php

require 'AWSSDKforPHP/aws.phar';

use Aws\Ses\SesClient;

$client = SesClient::factory(array(
    'key'    => 'AKIAJ4ULQMA6T3Y5NX5A',
    'secret' => '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',
    'region' => 'us-east-1'
));

//Now that you have the client ready, you can build the message
$msg = array();
$msg['Source'] = "pandubabu2010@gmail.com";
//ToAddresses must be an array
$msg['Destination']['ToAddresses'][] = "support@selfawarestories.in";

$msg['Message']['Subject']['Data'] = "Test subject";
$msg['Message']['Subject']['Charset'] = "UTF-8";

$msg['Message']['Body']['Text']['Data'] ="Text data of email";
$msg['Message']['Body']['Text']['Charset'] = "UTF-8";
$msg['Message']['Body']['Html']['Data'] ="HTML Data of email<br />";
$msg['Message']['Body']['Html']['Charset'] = "UTF-8";

try{
     $result = $client->sendEmail($msg);

     //save the MessageId which can be used to track the request
     $msg_id = $result->get('MessageId');
     
	 echo("MessageId: $msg_id"); echo "<br><br>";

     //view sample output
     print_r($result);echo "<br><br>";
	 
} catch (Exception $e) {
     //An error happened and the email did not get sent
     echo($e->getMessage());echo "<br><br>";
}

//view the original message passed to the SDK 
print_r($msg);echo "<br><br>";

?>