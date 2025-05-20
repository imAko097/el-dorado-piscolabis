import $ from 'jquery';

$(document).ready(function () {
    const $menu = $('#dropdownMenu');
    const $icon = $('#menuIcon');
    const $mainMenu = $('#mainMenu');
    let isOpen = false;

    function setNavbarState() {
        if (isOpen || window.scrollY > 100) {
            $mainMenu.removeClass('bg-transparent text-white').addClass('bg-white text-black shadow-lg');
        } else {
            $mainMenu.removeClass('bg-white text-black shadow-lg').addClass('bg-transparent text-white');
        }
    }

    function openMenu() {
        $menu.addClass('show');
        $icon.removeClass('bi-list').addClass('bi-x');
        $('body').addClass('overflow-hidden');
        isOpen = true;
        setNavbarState();
    }

    function closeMenu() {
        $menu.removeClass('show');
        $icon.removeClass('bi-x').addClass('bi-list');
        $('body').removeClass('overflow-hidden');
        isOpen = false;
        setNavbarState(); // vuelve a aplicar estilo según scroll
    }

    $('#menuToggle').click(function () {
        if (!isOpen) {
            openMenu();
        } else {
            closeMenu();
        }
    });

    $('#closeMenu').click(function () {
        closeMenu();
    });

    // Detectar scroll
    $(window).on('scroll', function () {
        setNavbarState();
    });

    // Estado inicial
    setNavbarState();
});