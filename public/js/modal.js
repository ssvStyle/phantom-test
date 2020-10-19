window.addEventListener('DOMContentLoaded', () => {
    const users_block = document.getElementById('users_block'),
        addUser = document.getElementById('addUser'),
        addFolder = document.getElementById('addFolder'),
        inputId = document.getElementById('userId'),
        inputLogin = document.getElementById('inputLogin'),
        inputEmail = document.getElementById('inputEmail'),
        groupList = document.getElementById('groupList'),
        modalHeader = document.getElementById('modalHeader'),
        userForm = document.getElementById('userForm');

        oldHeader = modalHeader.innerText;



    users_block.addEventListener('click', (event) => {

        if (event.target.className === 'addUser') {
            userForm.action = '/administration/users/create';
            openModal(addUser);
        }

        if (event.target.className === 'addFolder') {
            openModal(addFolder);
        }

        if (event.target.className === 'users_list-item') {
            userForm.action = '/administration/users/update';
            modalHeader.innerText = 'Редактировать пользователя';

            inputId.value = event.target.dataset.userid;
            inputLogin.value = event.target.dataset.userlogin;
            inputEmail.value = event.target.dataset.useremail;

            for (var i=0, child; child=groupList[i]; i++) {
                if (child.value == event.target.dataset.usergroup) {
                    groupList.selectedIndex = i;
                }
            }

            openModal(addUser);
        }

    });

    addUser.addEventListener('click', (event) => {

        if (event.target.className == 'close' || event.target.className == 'modal openModal') {
            userForm.action = '';
            inputId.value = '';
            inputLogin.value = '';
            inputEmail.value = '';
            groupList.selectedIndex = 0;
            modalHeader.innerText = oldHeader;
            closeModal(addUser);
        }
    });

    addFolder.addEventListener('click', (event) => {

        if (event.target.className == 'close' || event.target.className == 'modal openModal') {
            closeModal(addFolder);
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

});