import $ from 'jquery';

$(document).ready(function () {
    const $menu = $('#dropdownMenu');
    const $icon = $('#menuIcon');
    const $mainMenu = $('#mainMenu');
    let isOpen = false;

    function openMenu() {
        $('#dropdownMenu').addClass('show'); /* Mostrar el menú */
        $('#menuIcon').removeClass('bi-list').addClass('bi-x');
        $('#mainMenu').removeClass('bg-transparent text-white').addClass('bg-white text-black shadow-lg');
        isOpen = true;
    }

    function closeMenu() {
        $('#dropdownMenu').removeClass('show'); /* Ocultar el menú */
        $('#menuIcon').removeClass('bi-x').addClass('bi-list');
        $('#mainMenu').removeClass('bg-white text-black shadow-lg').addClass('bg-transparent text-white');
        isOpen = false;
    }

    // Alternar el menú al hacer clic en el icono
    $('#menuToggle').click(function () {
        if (!isOpen) {
            openMenu();
        } else {
            closeMenu();
        }
    });

    // Cerrar el menú al hacer clic fuera del área del menú
    $('#closeMenu').click(function () {
        closeMenu();
    });
});