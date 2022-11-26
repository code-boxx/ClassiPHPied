// (A) FILES TO CACHE
const cName = "classiphpied",
cFiles = [
  // (A1) BOOTSTRAP
  "assets/bootstrap.bundle.min.js",
  "assets/bootstrap.bundle.min.js.map",
  "assets/bootstrap.min.css",
  "assets/bootstrap.min.css.map",
  // (A2) ICONS + IMAGES
  "assets/favicon.png",
  "assets/ico-512.png",
  "assets/book.jpg",
  // (A3) COMMON INTERFACE
  "CB-manifest.json",
  "assets/PAGE-cb.js",
  "assets/maticon.woff2",
  // (A4) PAGES
  "assets/ADM-category.js",
  "assets/ADM-classified.js",
  "assets/ADM-images.css",
  "assets/ADM-images.js",
  "assets/ADM-login.js",
  "assets/ADM-settings.js",
  "assets/ADM-users.js",
  "assets/PAGE-classified.css",
  "assets/PAGE-classified.js",
  "assets/PAGE-forgot.js",
  "assets/PAGE-show.js"
];

// (B) CREATE/INSTALL CACHE
self.addEventListener("install", evt => evt.waitUntil(
  caches.open(cName)
  .then(cache => cache.addAll(cFiles))
  .catch(err => console.error(err))
));

// (C) LOAD FROM CACHE FIRST, FALLBACK TO NETWORK IF NOT FOUND
self.addEventListener("fetch", evt => evt.respondWith(
  caches.match(evt.request).then(res => res || fetch(evt.request))
));