<?php


$receiver_token=$_POST['receiver_token'];
$authorization_key=$_POST['authorization_key'];
$message=$_POST['message'];

$data=[
    "message"=>$message,
];

send_notify($receiver_token,$authorization_key,$data);



function send_notify($receiver_token, $authorization_key, $data) {

    $datObject = json_encode($data, JSON_FORCE_OBJECT);
    $vars = array(
        'to' => $receiver_token,
        'collapse_key' => 'type_a',
        'data' => $datObject,
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);  //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = [
        "Authorization: key=$authorization_key",
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    //print  $server_output;
}

