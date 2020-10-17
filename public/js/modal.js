window.addEventListener('DOMContentLoaded', () => {
    const users_block = document.getElementById('users_block');
    const addUser = document.getElementById('addUser');
    const addFolder = document.getElementById('addFolder');

    users_block.addEventListener('click', (event) => {

        if (event.target.className === 'addUser') {
            openModal(addUser);
        }

        if (event.target.className === 'addFolder') {
            openModal(addFolder);
        }

    });

    addUser.addEventListener('click', (event) => {

        console.log(event.target);

        if (event.target.className == 'close' || event.target.className == 'modal openModal') {
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
        document.body.style.overflow = 'hidden';
    }

});