window.addEventListener('DOMContentLoaded', () => {
    let settingsBlock = document.getElementById('settingsBlock'),
        modal = document.getElementById('modal'),
        modalHeader = document.getElementById('modalHeader'),
        msgBlock = document.getElementById('all_msg_block'),
        groupHeader = 'Настройки группы',
        userHeader = 'Настройки пользователя',
        settings = document.getElementById('settings'),
        id = 0,
        sendTo = '';

    settingsBlock.addEventListener('click', (event) => {

        if (event.target.className === 'category settings') {

            modalHeader.innerText = groupHeader;
            id = event.target.dataset.id;
            sendTo = 'group';

            sendRequest(`id=${id}`, 'POST', `/administration/settings/get/${sendTo}`, function (response) {

                setChecked(response);

            });

            openModal(modal);

        }

        if (event.target.className === 'list-item') {
            sendTo = 'user';
            id = event.target.dataset.id;

            modalHeader.innerText = userHeader;

            sendRequest(`id=${event.target.dataset.id}`, 'POST', `/administration/settings/get/${sendTo}`, function (response) {

                setChecked(response);


            });
            openModal(modal);

        }

    });

    modal.addEventListener("click", (event) =>{

        if (event.target.className == 'close' || event.target.className == 'modal openModal' || event.target.className == 'save') {

            if (event.target.className == 'save') {

                saveSettings();

            }

            let inputs = settings.querySelectorAll('input');

            for (let i = 0; inputs.length > i; i++) {
                inputs[i].checked = false;
            }

            closeModal(modal);
        }


    });






























    function saveSettings() {
        let inputs = settings.querySelectorAll('input');
        let request = [];

        for(let i = 0; inputs.length > i; i++) {

            if (inputs[i].checked === true){

                request.push(inputs[i].value);

            }

        }

        sendRequest(`settings=${JSON.stringify(request)}&uid=${id}`, 'POST', `/administration/settings/set/${sendTo}`, function () {});
    }

    function setChecked(response) {

        let inputs = settings.querySelectorAll('input');

        for (let i = 0; inputs.length > i; i++) {

            for (let c = 0; response.length > c; c++) {

                if (inputs[i].value === response[c].setting_id){

                    inputs[i].checked = true;
                    break;

                } else {

                    inputs[i].checked = false;

                }
            }

        }
    }






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

                    //console.log(httpRequest.responseText);
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


    function openModal($target) {
        $target.classList.add('openModal');
        document.body.style.overflow = 'hidden';
    }

    function closeModal($target) {
        $target.classList.remove('openModal');
        document.body.style.overflow = 'auto';
    }

});