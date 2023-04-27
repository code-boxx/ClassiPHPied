// (A) CREATE/INSTALL CACHE
self.addEventListener("install", evt => {
  self.skipWaiting();
  evt.waitUntil(
    caches.open("Classiphpied")
    .then(cache => cache.addAll([
      // (A1) BOOTSTRAP
      "assets/bootstrap.bundle.min.js",
      "assets/bootstrap.bundle.min.js.map",
      "assets/bootstrap.min.css",
      "assets/bootstrap.min.css.map",
      // (A2) ICONS + IMAGES
      "assets/favicon.png",
      "assets/ico-512.png",
      "assets/acct.webp",
      "assets/forgot.webp",
      "assets/login.webp",
      // (A3) COMMON INTERFACE
      "CB-manifest.json",
      "assets/PAGE-cb.js",
      "assets/maticon.woff2",
      // (A4) PAGES
      "assets/ADM-category.js",
      "assets/ADM-classified.js",
      "assets/ADM-classified-images.js",
      "assets/ADM-images.css",
      "assets/ADM-images.js",
      "assets/ADM-settings.js",
      "assets/ADM-users.js",
      "assets/PAGE-activate.js",
      "assets/PAGE-classified.css",
      "assets/PAGE-classified.js",
      "assets/PAGE-forgot.js",
      "assets/PAGE-login.js",
      "assets/PAGE-myaccount.js",
      "assets/PAGE-register.js",
      "assets/PAGE-show.js"
    ]))
    .catch(err => console.error(err))
  );
});

// (B) CLAIM CONTROL INSTANTLY
self.addEventListener("activate", evt => self.clients.claim());

// (C) LOAD FROM CACHE FIRST, FALLBACK TO NETWORK IF NOT FOUND
self.addEventListener("fetch", evt => evt.respondWith(
  caches.match(evt.request).then(res => res || fetch(evt.request))
));