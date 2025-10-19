(function ($) {
    'use strict';

    $(document).ready(function () {
        const dropdownSelector = '.navbar .nav-item.dropdown';
        const submenuSelector = '.navbar .dropdown-submenu';

        const closeDropdown = function (dropdown) {
            dropdown.removeClass('show').children('.dropdown-menu').removeClass('show');
            dropdown.children('.dropdown-toggle').attr('aria-expanded', 'false');
            dropdown.find('.dropdown-submenu').removeClass('show').children('.dropdown-menu').removeClass('show');
            dropdown.find('.dropdown-submenu > .dropdown-toggle').attr('aria-expanded', 'false');
        };

        const closeSubmenu = function (submenu) {
            submenu.removeClass('show').children('.dropdown-menu').removeClass('show');
            submenu.children('.dropdown-toggle').attr('aria-expanded', 'false');
        };

        const openDropdown = function (dropdown) {
            $(dropdownSelector + '.show').not(dropdown).each(function () {
                closeDropdown($(this));
            });
            dropdown.addClass('show').children('.dropdown-menu').addClass('show');
            dropdown.children('.dropdown-toggle').attr('aria-expanded', 'true');
        };

        const openSubmenu = function (submenu) {
            submenu.parent().find('> .dropdown-submenu.show').not(submenu).each(function () {
                closeSubmenu($(this));
            });
            submenu.addClass('show').children('.dropdown-menu').addClass('show');
            submenu.children('.dropdown-toggle').attr('aria-expanded', 'true');
        };

        const isDesktop = function () {
            return window.matchMedia('(min-width: 992px)').matches;
        };

        $(dropdownSelector).on('mouseenter focusin', function () {
            if (isDesktop()) {
                openDropdown($(this));
            }
        });

        $(dropdownSelector).on('mouseleave', function () {
            if (isDesktop()) {
                closeDropdown($(this));
            }
        });

        $(dropdownSelector).on('focusout', function (event) {
            if (!isDesktop()) {
                return;
            }

            const $dropdown = $(this);
            setTimeout(function () {
                if (!$dropdown.find(':focus').length) {
                    closeDropdown($dropdown);
                }
            }, 10);
        });

        $('.navbar .dropdown-toggle').on('click', function (event) {
            if (isDesktop()) {
                event.preventDefault();
                const $parent = $(this).parent('.dropdown');
                if ($parent.hasClass('show')) {
                    closeDropdown($parent);
                } else {
                    openDropdown($parent);
                }
            }
        });

        $(submenuSelector).on('mouseenter focusin', function () {
            if (isDesktop()) {
                openSubmenu($(this));
            }
        });

        $(submenuSelector).on('mouseleave', function () {
            if (isDesktop()) {
                closeSubmenu($(this));
            }
        });

        $('.navbar').on('click', '.dropdown-submenu > .dropdown-toggle', function (event) {
            if (isDesktop()) {
                event.preventDefault();
                const $parent = $(this).parent('.dropdown-submenu');
                if ($parent.hasClass('show')) {
                    closeSubmenu($parent);
                } else {
                    openSubmenu($parent);
                }
            }
        });

        $(document).on('keydown', function (event) {
            if (event.key === 'Escape') {
                closeDropdown($(dropdownSelector + '.show'));
            }
        });

        const skipLink = document.querySelector('.skip-link');
        if (skipLink) {
            skipLink.addEventListener('click', function () {
                const target = document.querySelector('#primary');
                if (target) {
                    target.setAttribute('tabindex', '-1');
                    target.focus();
                }
            });
        }
    });
})(jQuery);
