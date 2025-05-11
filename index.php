<?php
// index.php - فرم ثبت اطلاعات و موقعیت مکانی
?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>سامانه ثبت موقعیت</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="manifest" href="manifest.json">
  <script>
    if ("serviceWorker" in navigator) {
      navigator.serviceWorker.register("service-worker.js").then(() => {
        console.log("Service Worker registered");
      });
    }
  </script>
  <style>
    body {
      font-family: sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-container {
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 300px;
    }
    input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
    }
    button {
      width: 100%;
      padding: 10px;
      background: green;
      color: white;
      border: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h3>ثبت اطلاعات</h3>
    <input type="text" id="fullname" placeholder="نام و نام خانوادگی">
    <input type="text" id="phone" placeholder="شماره همراه">
    <button onclick="sendLocation()">ثبت اطلاعات</button>
    <p id="status"></p>
  </div>
  <script>
    function sendLocation() {
      const fullname = document.getElementById("fullname").value;
      const phone = document.getElementById("phone").value;
      const status = document.getElementById("status");

      if (!navigator.geolocation) {
        status.textContent = "موقعیت مکانی پشتیبانی نمی‌شود.";
        return;
      }

      navigator.geolocation.getCurrentPosition(pos => {
        fetch("send-location.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            fullname,
            phone,
            latitude: pos.coords.latitude,
            longitude: pos.coords.longitude
          })
        }).then(res => res.json()).then(data => {
          status.textContent = data.status === "ok" ? "با موفقیت ارسال شد." : "خطا در ارسال";
        });
      }, () => {
        status.textContent = "عدم دسترسی به موقعیت";
      });
    }
  </script>
</body>
</html>
