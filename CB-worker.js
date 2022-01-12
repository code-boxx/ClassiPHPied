// (A) FILES TO CACHE
const cName = "classiphpied",
cFiles = [
  // (A1) COMMON SCRIPTS
  "assets/bootstrap.bundle.min.js",
  "assets/bootstrap.min.css",
  "assets/PAGE-cb.js",
  // (A2) FONT + ICONS + IMAGES
  "assets/maticon.woff2",
  "assets/favicon.png",
  "assets/ico-512.png",
  "assets/noimg.jpg",
  // (A3) PAGES
  "assets/PAGE-classified.css",
  "assets/PAGE-classified.js"
];

// (B) CREATE/INSTALL CACHE
self.addEventListener("install", (evt) => {
  evt.waitUntil(
    caches.open(cName)
    .then((cache) => { return cache.addAll(cFiles); })
    .catch((err) => { console.error(err) })
  );
});

// (C) LOAD FROM CACHE FIRST, FALLBACK TO NETWORK IF NOT FOUND
self.addEventListener("fetch", (evt) => {
  evt.respondWith(
    caches.match(evt.request)
    .then((res) => { return res || fetch(evt.request); })
  );
});
