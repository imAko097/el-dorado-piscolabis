import $ from 'jquery';

function initializeNavbar() {
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
        setNavbarState();
    }

    // Evento para el botón de menú
    $('#menuToggle').off('click').on('click', function () {
        if (!isOpen) {
            openMenu();
        } else {
            closeMenu();
        }
    });

    // Evento para cerrar el menú
    $('#closeMenu').off('click').on('click', function () {
        closeMenu();
    });

    // Evento de scroll
    $(window).off('scroll').on('scroll', function () {
        setNavbarState();
    });

    // Estado inicial
    setNavbarState();
}

// Inicializar cuando el documento está listo
$(function () {
    initializeNavbar();
});

// Reinicializar después de cada actualización de Livewire
document.addEventListener('livewire:load', function () {
    initializeNavbar();
});

document.addEventListener('livewire:update', function () {
    initializeNavbar();
});

// Asegurarse de que el navbar se actualice después de cualquier actualización de Livewire
document.addEventListener('livewire:navigated', function () {
    initializeNavbar();
});