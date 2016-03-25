<?php

$to_email = 'info@wdsolutionsonline.com'; // set your email address

/*		DO NOT CHANGE ANYTHING BELOW THIS LINE 		*/

try{

	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

	$errors = array();

	// validate form
	if(strlen($name) < 1)
		$errors[] = array('id' => 'name', 'message' => 'Name field is required!');

	if(strlen($email) < 1)
		$errors[] = array('id' => 'email', 'message' => 'Email field is required!');
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		$errors[] = array('id' => 'email', 'message' => 'Invalid email address!');

	if(strlen($subject) < 1)
		$errors[] = array('id' => 'subject', 'message' => 'Subject field is required!');

	if(strlen($message) < 1)
		$errors[] = array('id' => 'message', 'message' => 'Message field is required!');

	if(!empty($errors))
	{
		echo json_encode(array(
			'success' => false,
			'type' => 'validation',
			'data' => $errors
		));

		return;
	}

		// define headers
	$headers = "From: " . strip_tags($name) . "<" . strip_tags($email) . ">\r\n";
	$headers .= "Reply-To: ". strip_tags($email) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

	$message = preg_replace('/\n/', '</p><p>', strip_tags( $message, "\n"));

	$message = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>' . $subject . '</title>
</head>
<body>
	<div>
		<p>' . $message . '</p>
	</div>
</body>
</html>';

	@mail($to_email, strip_tags($subject), $message, $headers);

	echo json_encode(array('success' => true, 'message' => ''));

}catch(Exception $e)
{
	echo json_encode(array('success' => false, type => 'system', 'message' => 'Server Error!'));
}

?>