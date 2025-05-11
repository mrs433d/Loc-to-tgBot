<?php
// وقتی با JavaScript اطلاعات ارسال میشه
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

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
  <title>ارسال لوکیشن به تلگرام</title>
  <style>
    body {
      font-family: sans-serif;
      text-align: center;
      margin-top: 100px;
    }
    button {
      padding: 15px 25px;
      font-size: 18px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    #status {
      margin-top: 20px;
      color: green;
    }
  </style>
</head>
<body>
  <h2>برای ارسال موقعیت مکانی‌ات، روی دکمه زیر بزن:</h2>
  <button onclick="sendLocation()">ارسال موقعیت</button>
  <div id="status"></div>

  <script>
    function sendLocation() {
      if (!navigator.geolocation) {
        alert("مرورگر شما موقعیت مکانی را پشتیبانی نمی‌کند.");
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
        }).then(res => res.json())
          .then(data => {
            document.getElementById("status").innerText = "موقعیت مکانی با موفقیت ارسال شد!";
          }).catch(() => {
            document.getElementB<?php
// وقتی با JavaScript اطلاعات ارسال میشه
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

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
  <title>ارسال لوکیشن به تلگرام</title>
  <style>
    body {
      font-family: sans-serif;
      text-align: center;
      margin-top: 100px;
    }
    button {
      padding: 15px 25px;
      font-size: 18px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    #status {
      margin-top: 20px;
      color: green;
    }
  </style>
</head>
<body>
  <h2>برای ارسال موقعیت مکانی‌ات، روی دکمه زیر بزن:</h2>
  <button onclick="sendLocation()">ارسال موقعیت</button>
  <div id="status"></div>

  <script>
    function sendLocation() {
      if (!navigator.geolocation) {
        alert("مرورگر شما موقعیت مکانی را پشتیبانی نمی‌کند.");
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
        }).then(res => res.json())
          .then(data => {
            document.getElementById("status").innerText = "موقعیت مکانی با موفقیت ارسال شد!";
          }).catch(() => {
            document.getElementById("status").innerText = "خطا در ارسال.";
          });
      }, () => {
        alert("اجازه دسترسی به موقعیت مکانی داده نشد.");
      });
    }
  </script>
</body>
</html>
yId("status").innerText = "خطا در ارسال.";
          });<?php
// وقتی با JavaScript اطلاعات ارسال میشه
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

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
  <title>ارسال لوکیشن به تلگرام</title>
  <style>
    body {
      font-family: sans-serif;
      text-align: center;
      margin-top: 100px;
    }
    button {
      padding: 15px 25px;
      font-size: 18px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    #status {
      margin-top: 20px;
      color: green;
    }
  </style>
</head>
<body>
  <h2>برای ارسال موقعیت مکانی‌ات، روی دکمه زیر بزن:</h2>
  <button onclick="sendLocation()">ارسال موقعیت</button>
  <div id="status"></div>

  <script>
    function sendLocation() {
      if (!navigator.geolocation) {
        alert("مرورگر شما موقعیت مکانی را پشتیبانی نمی‌کند.");
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
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // دریافت و بررسی داده‌ها
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
      font-family: sans-serif;
      text-align: center;
      margin-top: 100px;
    }
    button {
      padding: 15px 25px;
      font-size: 18px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    #status {
      margin-top: 20px;
      color: green;
    }
  </style>
</head>
<body>
  <h2>برای ارسال موقعیت مکانی‌ات، روی دکمه زیر کلیک کن:</h2>
  <button onclick="sendLocation()">ارسال موقعیت</button>
  <div id="status"></div>

  <script>
    function sendLocation() {
      if (!navigator.geolocation) {
        alert("مرورگر شما موقعیت مکانی را پشتیبانی نمی‌کند.");
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
        }).then(res => res.json())
          .then(data => {
            if (data.status === "ok") {
              document.getElementById("status").innerText = "موقعیت مکانی با موفقیت ارسال شد!";
            } else {
              document.getElementById("status").innerText = "خطا: " + data.message;
            }
          }).catch(() => {
            document.getElementById("status").innerText = "خطا در ارسال.";
          });
      }, () => {
        alert("اجازه دسترسی به موقعیت مکانی داده نشد.");
      });
    }
  </script>
</body>
</html>
