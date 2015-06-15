<?php
    	
	use awsSDK\Aws\Ses\SesClient;
 
	require 'awsSDK/aws-autoloader.php';
	 
	$client = SesClient::factory(array(
		'key' => 'AKIAJ4ULQMA6T3Y5NX5A',
		'secret' => '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',
		'region' => 'us-east-1'
	));
	 
	$emailSentId = $client->sendEmail(array(
		// Source is required
		'Source' => 'pandubabu2010@gmail.com',
		// Destination is required
		'Destination' => array(
			'ToAddresses' => array('support@selfawarestories.in')
		),
		// Message is required
		'Message' => array(
			// Subject is required
			'Subject' => array(
				// Data is required
				'Data' => 'SES Testing',
				'Charset' => 'UTF-8',
			),
			// Body is required
			'Body' => array(
				'Text' => array(
					// Data is required
					'Data' => 'My plain text email',
					'Charset' => 'UTF-8',
				),
				'Html' => array(
					// Data is required
					'Data' => '<b>My HTML Email</b>',
					'Charset' => 'UTF-8',
				),
			),
		),
		'ReplyToAddresses' => array( 'pandubabu2010@gmail.com' ),
		'ReturnPath' => 'pandubabu2010@gmail.com'
	));

?>