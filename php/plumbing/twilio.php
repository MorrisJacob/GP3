<?php

function SendText($to_number, $message){
    $account_sid = 'AC4f4e5a3cf53caa1f2842c2d377777804';
    $auth_token  = '8b03c3f1317f30426875bcde7aa619e0';
    $from_number = '8446482390'; // Your Twilio number
    $to_number   = '7654616017'; // The recipient
    $message     = 'Grand Park Rentals!';

    // The API endpoint
    $url = "https://api.twilio.com/2010-04-01/Accounts/{$account_sid}/Messages.json";

    // Data to send
    $data = [
        'From' => $from_number,
        'To' => $to_number,
        'Body' => $message
    ];

    // Initialize cURL
    $ch = curl_init();

    // Set options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_USERPWD, "$account_sid:$auth_token");

    // Execute and decode response
    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
    } else {
        echo 'Response: ' . $response;
    }

    // Clean up
    curl_close($ch);
}
?>

