window.addEventListener('DOMContentLoaded', () => {
    let notifi_block = document.getElementById('msg_block'),
        countMsg = document.getElementById('counMsg'),
        notificationBell = document.getElementById('notificationBell');

    sendRequest('', 'POST', '/messages/get/new', showNewCountMsg);

    window.setInterval( function () {
        sendRequest('', 'POST', '/messages/get/new', showNewCountMsg);
    }, 9500);

    notifi_block.addEventListener("click", (event) =>{

        console.log(event.target);

        if (event.target.className === 'closeMsg') {
            event.target.parentNode.remove();
        }

        if (event.target.className === 'received') {

            sendRequest(`idMsg=${event.target.parentNode.dataset.idmsg}`, 'POST', '/messages/set/read', function (response) {

                if (response == 1) {
                    event.target.parentNode.remove();
                    sendRequest('', 'POST', '/messages/get/new', showNewCountMsg);
                }

            });
        }
    });


    function sendRequest(data = '', reqType, url, callback) {
        let httpRequest;
        if (window.XMLHttpRequest) { // Mozilla, Safari, ...
            httpRequest = new XMLHttpRequest();
        } else if (window.ActiveXObject) { // IE
            httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
        }

        httpRequest = new XMLHttpRequest();
        httpRequest.overrideMimeType('application/json');
        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState == 4) {
                if (httpRequest.status == 200) {

                    callback(JSON.parse(httpRequest.responseText));

                } else if (httpRequest.status == 401) {
                    console.log(httpRequest.status);

                } else if (httpRequest.status == 404) {
                    console.log(httpRequest.status);
                } else {
                    console.log(httpRequest.status);
                }
            }

        };
        httpRequest.open(reqType, url, true);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send(data);
    }

    function showNewCountMsg (collection = 0) {

        if (collection.countAllNotRead > 0) {

            notificationBell.src = 'img/icons/notification-bell.png';
            countMsg.innerText = collection.countAllNotRead;

            let addMsg = '';

            for (const [key, value] of Object.entries(collection.newMsgs)) {


                addMsg = `<div class="msg_block-content" data-idMsg="${value.id}">
                                            <img class="closeMsg" src="img/icons/cancel.png" alt="">
                                            <h6 title="${value.login} - ${unixTime(value.date)}">${value.header}</h6>
                                            <p>${value.message}</p>
                                            <button type="button" class="received">Принято</button>
                                        </div>`;
                notifi_block.insertAdjacentHTML('afterbegin', addMsg);


                setTimeout(function (block) {
                    block.remove();
                }, 29500, notifi_block.firstElementChild);

            }

        } else {
            notificationBell.src = 'img/icons/notification-bell_noMsg.png';
            countMsg.innerText = '';
        }

    }

    function unixTime(unixtime) {

        var u = new Date(unixtime*1000);

        return u.getUTCFullYear() +
            '-' + ('0' + u.getUTCMonth()).slice(-2) +
            '-' + ('0' + u.getUTCDate()).slice(-2) +
            ' ' + ('0' + u.getUTCHours()).slice(-2) +
            ':' + ('0' + u.getUTCMinutes()).slice(-2) +
            ':' + ('0' + u.getUTCSeconds()).slice(-2);
    }


});