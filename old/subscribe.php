<?php

	$file_name = 'subscriptions.txt'; // please change this line

	$email = $_POST['email'];
	$error = null;

	if(strlen($email) === 0)
		$error = 'No email address';

	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		$error = 'Invalid email address';

	if(file_exists($file_name))
	{
		$content = file_get_contents($file_name);
		$list = explode("\n", $content);

		if(in_array($email, $list))
			$error = 'Email address already exists';
	}

	if($error !== null)
	{
		echo json_encode(array(
			'success' => false,
			'message' => $error
		));

		return;
	}

	$fp = fopen($file_name, "a+");
	fwrite($fp, $email."\n");
	fclose($fp);

	/*
	 *	If you want to receive email for every subscribsion, please uncomment next lines and enter your
	 *	email address, subject, message
	*/

	@mail('info@wdsolutionsonline.com', 'New Subscriber for Stealth Running', 'Added email address: ' . $email);

	echo json_encode(array(
		'success' => true
	));

?>