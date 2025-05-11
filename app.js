if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('service-worker.js');
}

function sendLocation() {
  navigator.geolocation.getCurrentPosition(pos => {
    fetch('location.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        latitude: pos.coords.latitude,
        longitude: pos.coords.longitude
      })
    });
  });
}

setInterval(sendLocation, 60000); // هر ۶۰ ثانیه ارسال
sendLocation();
