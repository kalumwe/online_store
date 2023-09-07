<?php
      /*  if(isset($_POST['g-recaptcha-response'])){
			$captcha=$_POST['g-recaptcha-response'];
			$secretKey = "6LcXCAUnAAAAAL2p1HuUVK6Zo5wkfqpZ6OfSsWmF";
			$ip_address = $_SERVER['REMOTE_ADDR']; 
			$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip_address);
			$keys = json_decode($response,true);
			if(intval($keys["success"]) !== 1) {
				echo "<h4 class='text-center'>Are you human? Click recaptcha</h4>";
				header( "refresh:1;" );
			}
		}
		else { echo "<h4 class='text-center'>Are you human? Click recaptcha!</h4>";
		header( "refresh:1;" );
		}*/
		

// Validate the reCAPTCHA response
function verifyRecaptcha($response, $secretKey) {
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $secretKey,
        'response' => $response
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $responseJson = json_decode($result, true);

    return $responseJson['success'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = 'YOUR_RECAPTCHA_SECRET_KEY'; // Replace with your Secret key obtained in step 1

    // Verify the reCAPTCHA response
    $isRecaptchaValid = verifyRecaptcha($recaptchaResponse, $secretKey);

    if ($isRecaptchaValid) {
        // reCAPTCHA validation successful
        // Process the rest of your form submission here
        // ...

        echo "Form submission successful!";
    } else {
        // reCAPTCHA validation failed
        echo "reCAPTCHA verification failed. Please try again.";
    }
}
?>
