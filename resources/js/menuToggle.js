import $ from 'jquery';

function initializeNavbar() {
    const $menu = $('#dropdownMenu');
    const $icon = $('#menuIcon');
    const $userToggle = $('#userDropdownToggle');
    const $mainMenu = $('#mainMenu');
    let isOpen = false;

    // Definimos initialText y initialBg usando window.menuColors
    const initialBg = window.menuColors.bgColor;     // 'bg-transparent' o 'bg-white'
    const initialText = window.menuColors.colorText;   // 'text-white'       o 'text-black'

    function setNavbarState() {
        if (isOpen || window.scrollY > 100) {
            // Navbar
            $mainMenu
                .removeClass(initialBg).removeClass(initialText)
                .addClass('bg-white text-black shadow-lg');

            // Botón de usuario
            if ($userToggle.length) {
                $userToggle
                    .removeClass(initialText)
                    .addClass('text-black');
            }
        } else {
            // Navbar
            $mainMenu
                .removeClass('bg-white text-black shadow-lg')
                .addClass(initialBg).addClass(initialText);

            // Botón de usuario
            if ($userToggle.length) {
                $userToggle
                    .removeClass('text-black')
                    .addClass(initialText);
            }
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

    $('#menuToggle').off('click').on('click', function () {
        if (!isOpen) {
            openMenu();
        } else {
            closeMenu();
        }
    });

    // Si tienes botón para cerrar menú aparte, puedes usar este handler
    $('#closeMenu').off('click').on('click', function () {
        closeMenu();
    });

    // Escuchar scroll para cambiar navbar
    $(window).off('scroll').on('scroll', function () {
        setNavbarState();
    });

    // Estado inicial al cargar página
    setNavbarState();
}

// Inicializa cuando DOM esté listo
$(function () {
    initializeNavbar();
});

// Si usas Livewire, reinicializa el menú cuando haya cambios en la página
document.addEventListener('livewire:load', initializeNavbar);
document.addEventListener('livewire:update', initializeNavbar);
document.addEventListener('livewire:navigated', initializeNavbar);
