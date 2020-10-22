window.addEventListener('DOMContentLoaded', () => {
    let msg_block = document.getElementById('msg_block'),
        countMsg = document.getElementById('counMsg'),
        notificationBell = document.getElementById('notificationBell');

    sendRequest('POST', '/messages/get/new', showNewCountMsg);

    /*window.setInterval( function () {
        sendRequest('POST', '/messages/get/new', showNewCountMsg);
    }, 10000);*/


    msg_block.addEventListener("click", (event) =>{

        console.log(event.target);

        if (event.target.className === 'closeMsg') {
            event.target.parentNode.remove();
        }

        if (event.target.className === 'received') {

            console.log('send ajax set msg is_read = true');
            event.target.parentNode.remove();
        }
    });


    function sendRequest(reqType, url, callback) {
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

                    //console.log(JSON.parse(httpRequest.responseText));

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
        httpRequest.send('id=1');
    }

    function showNewCountMsg (collection = 0) {

        if (!collection.countMsg <= 0) {
            notificationBell.src = 'img/icons/notification-bell.png';
            countMsg.innerText = collection.countMsg;
            console.log(collection);

            let addMsg = '';

            for (const [key, value] of Object.entries(collection.newMsgs)) {

                console.log(key);

                addMsg += `<div class="msg_block-content">
                                            <img class="closeMsg" src="img/icons/cancel.png" alt="">
                                            <h6>${value.header}</h6>
                                            <p>${value.message}</p>
                                            <button type="button" class="received">Принято</button>
                                        </div>`;




                console.log(value.msgId);
                console.log(value.header);
                console.log(value.message);
                console.log(value.date);
                console.log(value.login);
            }

            msg_block.insertAdjacentHTML('afterbegin', addMsg);



        } else {
            notificationBell.src = 'img/icons/notification-bell_noMsg.png';
            countMsg.innerText = '';
        }

    }

});