<?php
 
 require_once('AWSSDKforPHP/ses.php');
 
 $ses = new SimpleEmailService('AKIAJ4ULQMA6T3Y5NX5A', 'OuxJ6Lhh4uT15CeOdfL/WoOp6TIeip9iZOmeo1Ir');

 print_r($ses->verifyEmailAddress('support@selfawarestories.in')); echo "<br><br>";
 
 print_r($ses->listVerifiedEmailAddresses()); echo "<br><br>";
 
$m = new SimpleEmailServiceMessage();
$m->addTo('support@selfawarestories.in');
$m->setFrom('pandubabu2010@gmail.com');
$m->setSubject('Hello, world!');
$m->setMessageFromString('This is the message body.');

print_r($ses->sendEmail($m)); echo "<br><br>";

print_r($ses->getSendQuota()); echo "<br><br>";
print_r($ses->getSendStatistics()); echo "<br><br>";
 
?>