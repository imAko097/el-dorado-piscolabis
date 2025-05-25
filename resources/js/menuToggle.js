import $ from 'jquery';

function initializeNavbar() {
    const $menu = $('#dropdownMenu');
    const $icon = $('#menuIcon');
    const $mainMenu = $('#mainMenu');
    let isOpen = false;

    // Clases iniciales definidas en Blade y pasadas a JS
    const initialBg = window.menuColors?.bgColor || 'bg-transparent';
    const initialText = window.menuColors?.colorText || 'text-white';

    // Clases para cuando el menú está abierto o se hace scroll
    const scrolledBg = 'bg-white';
    const scrolledText = 'text-black';
    const shadowClass = 'shadow-lg';

    function setNavbarState() {
        const $userButton = $('#userDropdownToggle');

        if (isOpen || window.scrollY > 100) {
            $mainMenu
                .removeClass(`${initialBg} ${initialText}`)
                .addClass(`${scrolledBg} ${scrolledText} ${shadowClass}`);

            //  Actualiza el botón del usuario
            $userButton.removeClass(initialText).addClass(scrolledText);
        } else {
            $mainMenu
                .removeClass(`${scrolledBg} ${scrolledText} ${shadowClass}`)
                .addClass(`${initialBg} ${initialText}`);

            // Vuelve a su color inicial
            $userButton.removeClass(scrolledText).addClass(initialText);
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
