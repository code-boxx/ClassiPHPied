// (A) FILES TO CACHE
const cName = "classiphpied-adm",
cFiles = [
  // (A1) BOOTSTRAP + TINYMCE
  "assets/bootstrap.bundle.min.js",
  "assets/bootstrap.bundle.min.js.map",
  "assets/bootstrap.min.css",
  "assets/bootstrap.min.css.map",
  "assets/tinymce/tinymce.min.js",
  // (A2) ICONS + IMAGES
  "assets/favicon.png",
  "assets/ico-512.png",
  "assets/work.jpg",
  // (A3) COMMON INTERFACE
  "assets/ADM-cb.js",
  "assets/maticon.woff2",
  // (A4) PAGES
  "assets/ADM-category.js",
  "assets/ADM-classified.js",
  "assets/ADM-images.css",
  "assets/ADM-images.js",
  "assets/ADM-login.js",
  "assets/ADM-settings.js",
  "assets/ADM-users.js"
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
