
self.addEventListener("install", function(e) {
  e.waitUntil(
    caches.open("location-cache").then(function(cache) {
      return cache.addAll(["/", "/index.php"]);
    })
  );
});
self.addEventListener("fetch", function(e) {
  e.respondWith(
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});
