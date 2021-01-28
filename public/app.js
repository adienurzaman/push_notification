function push_request_permission() {
    if (Notification.permission !== "granted") {
        Notification.requestPermission()
            .then(result => {
                push_updateSubscription()
            })
    }
}

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - (base64String.length % 4)) % 4);
    const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}


function push_updateSubscription() {
    if (Notification.permission === "granted") {
        let elemen = document.querySelector('.info_notifikasi');
        elemen.style.display = "none";
        $('#push_requestPermission').modal('hide');

        const applicationServerPublicKey = "BC95eIvC37YDwxARmrSkiyIC6nU1x8hFbqIUBBtW4-rC2SJhAfllaulfW0vBDldrNGJBxXZzMgKOIslmsmCv8rk";

        navigator.serviceWorker.ready
            .then(registration => {
                console.log(registration);
                return registration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: urlBase64ToUint8Array(applicationServerPublicKey),
                })
            })
            .then(subscription => {
                console.log('User is subscribed:', subscription);
                console.log(JSON.stringify(subscription));
                const key = subscription.getKey('p256dh');
                const token = subscription.getKey('auth');
                const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0];

                fetch('./push/save', {
                    method: 'POST',
                    body: new URLSearchParams({
                        endPoint: subscription.endpoint,
                        publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
                        authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
                        contentEncoding,
                    })
                }).then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return Promise.reject({
                            status: response.status,
                            statusText: response.statusText
                        });
                    }
                }).then(data => {
                    console.log(data);
                }).catch(error => console.log(error));
            })
    } else {
        $('#push_requestPermission').modal({
            keyboard: false,
            backdrop: 'static'
        });

        let elemen = document.querySelector('.info_notifikasi');
        elemen.style.display = "block";

        $('#push_requestPermission').modal('show');
    }
}


window.addEventListener('load', () => {
    navigator.serviceWorker.register('./sw.js')
        .then(reg => {
            console.log('Service Worker is registered', reg);
            reg.installing;
            reg.waiting;
            reg.active;

            reg.addEventListener('updatefound', () => {
                const newWorker = reg.installing;
                newWorker.state;
            })

            push_updateSubscription()
        })
})