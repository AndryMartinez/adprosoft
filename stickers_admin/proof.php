<?php
function sendMessage($appId,$authorization) {
    $content      = array(
        "en" => 'Nuevo pack de stickers disponible'
    );
    $fields = array(
        'app_id' => $appId,
        'included_segments' => array(
            'All'
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'contents' => $content
    );
    
    $fields = json_encode($fields);    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic '.$authorization
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    if($response === false)
    {
    	echo 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);
    
    return $response;
}

$response = sendMessage("30736ba9-a988-483c-bb4f-137692747895","ZWRkMzNmNjgtMDQ2Ny00N2RjLTg0M2EtMTM5YTFkNjAwMjFl");
$return["allresponses"] = $response;
$return = json_encode($return);

$data = json_decode($response, true);
print_r($data);
if(isset($data['id'])){
	$id = $data['id'];
	print_r($id);
}

print("\n\nJSON received:\n");
print($return);
print("\n");