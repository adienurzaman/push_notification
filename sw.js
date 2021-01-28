self.addEventListener('install', function (event) {
    event.waitUntil(self.skipWaiting())
})

self.addEventListener('activate', function (event) {
    event.waitUntil(self.clients.claim())
})

self.addEventListener('push', function (event) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        console.log('Notification has not granted')
        return
    }

    let msg = event.data.json()

    let options = {
        badge: 'https://www.pinclipart.com/picdir/middle/98-984060_vector-badge-svg-icon-badge-icon-svg-clipart.png',
        icon: 'https://www.pinclipart.com/picdir/middle/98-984060_vector-badge-svg-icon-badge-icon-svg-clipart.png',
        body: msg.text,
        data: { url: msg.url },
        tag: msg.tag,
        renotify: true,
    }

    event.waitUntil(
        self.registration.showNotification('Notifikasi PWA', options)
    )
})

self.addEventListener('notificationclick', function (event) {
    const data = event.notification.data;
    clients.openWindow(data.url)
    event.notification.close()
}, false)