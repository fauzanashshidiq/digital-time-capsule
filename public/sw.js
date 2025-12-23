const CACHE_NAME = "capsule-cache-v1";
const STATIC_ASSETS = [
    "/",
    "/img/cancel.png",
    "/img/delete.png",
    "/img/ikonutama.png",
    "/img/letter.png",
    "/img/lock.png",
    "/img/locked.png",
    "/img/pencil.png",
    "/img/plus.png",
    "/img/trash.png",
    "/img/unlocked.png",
    "/offline.html",
];

self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(async (cache) => {
            for (const asset of STATIC_ASSETS) {
                try {
                    await cache.add(asset);
                } catch (err) {
                    console.error("Gagal meng-cache asset:", asset, err);
                }
            }
        })
    );
    self.skipWaiting();
});

self.addEventListener("fetch", (event) => {
    const url = new URL(event.request.url);

    // Gambar user
    if (url.pathname.startsWith("/storage/")) {
        event.respondWith(
            caches.match(event.request).then((cached) => {
                return (
                    cached ||
                    fetch(event.request)
                        .then((resp) => {
                            caches.open("dynamic-storage").then((cache) => {
                                cache.put(event.request, resp.clone());
                            });
                            return resp;
                        })
                        .catch(() => caches.match("/img/locked.png"))
                );
            })
        );
        return;
    }

    // Dynamic user pages
    if (
        url.pathname.startsWith("/dashboard") ||
        url.pathname.startsWith("/capsules")
    ) {
        event.respondWith(
            fetch(event.request)
                .then((resp) => {
                    const copy = resp.clone();
                    caches.open("dynamic-user-pages").then((cache) => {
                        cache.put(event.request, copy);
                    });
                    return resp;
                })
                .catch(() => {
                    return (
                        caches.match(event.request) ||
                        caches.match("/offline.html")
                    );
                })
        );
        return;
    }

    // Static assets cache-first
    event.respondWith(
        caches
            .match(event.request)
            .then(
                (cached) =>
                    cached ||
                    fetch(event.request).catch(() =>
                        caches.match("/offline.html")
                    )
            )
    );
});
