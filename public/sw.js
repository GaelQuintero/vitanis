const CACHE_NAME = "offline-cache-v1";
const filesToCache = [
    "/",
    "/offline.html",
    "/css/app.css",
    "/js/app.js",
    "/img/logo.png"
];

// Pre-carga los archivos en caché
self.addEventListener("install", function (event) {
    event.waitUntil(
        caches.open(CACHE_NAME).then(function (cache) {
            return cache.addAll(filesToCache);
        })
    );
});

// Activa el Service Worker y limpia cachés antiguas
self.addEventListener("activate", function (event) {
    event.waitUntil(
        caches.keys().then(function (cacheNames) {
            return Promise.all(
                cacheNames
                    .filter(name => name !== CACHE_NAME)
                    .map(name => caches.delete(name))
            );
        })
    );
});

// Intercepta las peticiones
self.addEventListener("fetch", function (event) {
    if (!event.request.url.startsWith("http")) {
        return; // Evita peticiones no HTTP
    }

    event.respondWith(
        fetch(event.request)
            .then(response => {
                return caches.open(CACHE_NAME).then(cache => {
                    if (event.request.method === "GET") {
                        cache.put(event.request, response.clone());
                    }
                    return response;
                });
            })
            .catch(() => caches.match(event.request).then(response => response || caches.match("/offline.html")))
    );
});

// 📡 Background Sync para reintentar correos cuando vuelva la conexión
self.addEventListener("sync", function (event) {
    if (event.tag === "sync-emails") {
        event.waitUntil(retryPendingEmails());
    }
});





