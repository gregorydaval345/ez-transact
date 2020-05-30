<?php
// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

if ($text == "") {
    // This is the first request. Note how we start the response with CON
    $response  = "CON Welcome to EZ Transact NCB \n";
    $response .= "1. Check Acc. Balance \n";
    $response .= "4. Mini Statement \n";
    $response .= "5. Funds Transfer \n";
    $response .= "6. Bill Payments \n";
    $response .= "7. Loan Payment \n";
    $response .= "8. Open an Account\n";
    $response .= "\n";
    $response .= "2. My phone number\n";

} else if ($text == "1") {
    // Business logic for first level response
    $response = "CON Choose account information you want to view \n";
    $response .= "1. Account number \n";
    $response .= "2. Account balance";

} else if ($text == "2") {
    // Business logic for first level response
    // This is a terminal request. Note how we start the response with END
    $response = "END Your phone number is ".$phoneNumber;

} else if($text == "1*1") { 
    // This is a second level response where the user selected 1 in the first instance
    $accountNumber  = "00678****340";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your account number is ".$accountNumber;

} else if ( $text == "1*2" ) {
    // This is a second level response where the user selected 1 in the first instance
    $balance  = "JMD 10,000";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your balance is ".$balance;

    // Deposit to your account
} else if ($text == "5") {
    $response = "CON Transfers Funds \n";
    $response .= "Making transfer of JMD 5,000.00 to your acc/wallet \n";
    $response .= "1. Confirm\n2. Cancel";
} else if ($text == "5*1") {
    $response = "END We are sending JMD 5,000.00 to your account \n\n".$accountNumber;
} else if ($text == "5*2") {
    $response = "END Thank you for doing business with NCB!";

// Generated Mini Statement
} else if ($text == "4") {
    $response = "CON Mini Statements\n";
    $response .= "Your last 3 transactions are:\n";
    $response .= "1. 00678****40, 3500.00 JMD, 15-05-2020 \n";
    $response .= "2. 00678****40, 2300.00 JMD, 16-09-2020 \n";
    $response .= "3. 00678****40, 4500.00 JMD, 17-03-2020 \n";

} else if ($text == "8") {
    $response = "CON Get these documents ready:\n ";
    $response .= "-> Referees Name \n";
    $response .= "-> TRN# or Drivers License \n";
    $response .= "";
    $response .= "1. Continue \n";
    $response .= "2. Cancel \n";
} else if ($text == "8*1") {
    $response = "CON Enter Referees Name: \n";
    $response .= "1. Enter \n";
} else if ($text == "8*1*1") {
    $response = "CON Enter TRN#: \n";
    $response .= "1. Enter \n";
} else if ($text == "8*1*1*1") {
    $response = "END Thank you! Documents Received\n Your Account Number and PIN will be sent to your phone number\n";
}
// Echo the response back to the API
header('Content-type: text/plain');
echo $response;

