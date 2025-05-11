<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["latitude"]) || !isset($data["longitude"])) {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
        exit;
    }

    $lat = $data["latitude"];
    $lon = $data["longitude"];

    $token = "7926937226:AAFcIfZulEjhnXx7gQpnm712eE1-LvKoT_o";
    $chat_id = "-1002570608346";

    $url = "https://api.telegram.org/bot$token/sendLocation?" . http_build_query([
        "chat_id" => $chat_id,
        "latitude" => $lat,
        "longitude" => $lon
    ]);

    file_get_contents($url);

    echo json_encode(["status" => "ok"]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>ارسال موقعیت مکانی</title>
  <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background: linear-gradient(to right, #dfe9f3, #ffffff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .card {
      background-color: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 320px;
    }

    .card h2 {
      color: #333;
      margin-bottom: 20px;
    }

    .card button {
      background-color: #4CAF50;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .card button:hover {
      background-color: #45a049;
    }

    #status {
      margin-top: 15px;
      font-weight: bold;
      color: #2b7a0b;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>ارسال موقعیت مکانی</h2>
    <button id="sendBtn">ارسال موقعیت</button>
    <div id="status"></div>
  </div>

  <script>
    document.getElementById("sendBtn").addEventListener("click", function () {
      const statusEl = document.getElementById("status");
      statusEl.innerText = "";

      if (!navigator.geolocation) {
        statusEl.innerText = "مرورگر موقعیت مکانی را پشتیبانی نمی‌کند.";
        return;
      }

      navigator.geolocation.getCurrentPosition(position => {
        fetch("", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            latitude: position.coords.latitude,
            longitude: position.coords.longitude
          })
        })
        .then(res => res.json())
        .then(data => {
          if (data.status === "ok") {
            statusEl.innerText = "موقعیت مکانی با موفقیت ارسال شد!";
          } else {
            statusEl.innerText = "خطا: " + data.message;
          }
        })
        .catch(() => {
          statusEl.innerText = "خطا در ارسال.";
        });
      }, () => {
        statusEl.innerText = "اجازه دسترسی به موقعیت مکانی داده نشد.";
      });
    });
  </script>
</body>
</html>
