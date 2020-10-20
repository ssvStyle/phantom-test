window.addEventListener('DOMContentLoaded', () => {
    const users_block = document.getElementById('users_block'),
    addUser = document.getElementById('addUser'),
    inputId = document.getElementById('carId'),
    inputNum = document.getElementById('carNumb'),
    inputTax = document.getElementById('carTax'),
    carStatus = document.getElementById('carStatus'),
    modalHeader = document.getElementById('modalHeader'),
    userForm = document.getElementById('userForm'),
    brandCarSelect = document.getElementById('carBrand'),
    carModelSelect = document.getElementById('carModel'),
    oldHeader = modalHeader.innerText;

    let httpRequest;
    if (window.XMLHttpRequest) { // Mozilla, Safari, ...
        httpRequest = new XMLHttpRequest();
    } else if (window.ActiveXObject) { // IE
        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }



    users_block.addEventListener('click', (event) => {

        if (event.target.className === 'addUser') {
            userForm.action = '/directory/car/create';
            openModal(addUser);

            brandCarSelect.addEventListener('change', (event) => {
                getCarModels(event.target.value);
            });
        }

        if (event.target.className === 'users_list-item') {
            userForm.action = '/directory/car/update';
            modalHeader.innerText = 'Редактировать авто';
            getCarModels(event.target.dataset.carbrandid, event.target.dataset.carmodelid);

            inputId.value = event.target.dataset.carid;
            inputNum.value = event.target.dataset.carnumber;
            inputTax.value = event.target.dataset.credit;
            setSelected(carStatus);
            setSelected(brandCarSelect);

            brandCarSelect.addEventListener('change', (event) => {
                getCarModels(event.target.value, event.target.dataset.carmodelid);
            });

            openModal(addUser);
        }

    });

    addUser.addEventListener('click', (event) => {

        if (event.target.className == 'close' || event.target.className == 'modal openModal') {
            carModelSelect.innerHTML = '';
            carStatus.selectedIndex = 0;
            brandCarSelect.selectedIndex = 0;
            inputId.value = '';
            inputNum.value = '';
            inputTax.value = '';
            closeModal(addUser);
        }
    });

    function openModal($target) {
        $target.classList.add('openModal');
        document.body.style.overflow = 'hidden';
    }

    function closeModal($target) {
        $target.classList.remove('openModal');
        document.body.style.overflow = 'auto';
    }

    function getCarModels(id, selected = 0)
    {
        httpRequest = new XMLHttpRequest();
        httpRequest.overrideMimeType('application/json');
        httpRequest.onreadystatechange = function () {
            carModelSelect.innerHTML = '';
            if (httpRequest.readyState == 4) {
                if (httpRequest.status == 200 ) {
                    let collection = JSON.parse(httpRequest.responseText);

                    let option = document.createElement("option");
                    option.text = 'Выберите модель';
                    option.value = 0;
                    carModelSelect.appendChild(option);

                    collection.forEach(obj => {

                        let option = document.createElement("option");
                        option.text = obj.model_name;
                        option.value = obj.id;


                        if (obj.id == selected) {

                            option.setAttribute('selected', 'selected');
                        }
                        carModelSelect.appendChild(option);

                    })

                } else if (httpRequest.status == 401 ){
                    console.log(httpRequest.status);

                } else if (httpRequest.status == 404 ){
                    console.log(httpRequest.status);
                } else {
                    console.log(httpRequest.status);
                }
            }
        };

        httpRequest.open('POST', '/directory/car/get/models', true);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send('id=' + id);
    }

    function setSelected(target) {
        for (let i=0, child; child=target[i]; i++) {
            if (child.value == event.target.dataset.statusid) {
                target.selectedIndex = i;
            }
        }
    }

});