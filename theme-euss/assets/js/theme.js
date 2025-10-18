(function ($) {
    'use strict';

    $(document).ready(function () {
        const dropdownSelector = '.navbar .dropdown';

        const closeDropdown = function (dropdown) {
            dropdown.removeClass('show').find('.dropdown-menu').removeClass('show');
        };

        const openDropdown = function (dropdown) {
            $(dropdownSelector + '.show').not(dropdown).each(function () {
                closeDropdown($(this));
            });
            dropdown.addClass('show').find('.dropdown-menu').addClass('show');
        };

        $(dropdownSelector).on('mouseenter focusin', function () {
            if (window.matchMedia('(min-width: 992px)').matches) {
                openDropdown($(this));
            }
        });

        $(dropdownSelector).on('mouseleave', function () {
            if (window.matchMedia('(min-width: 992px)').matches) {
                closeDropdown($(this));
            }
        });

        $(dropdownSelector).on('focusout', function (event) {
            if (!window.matchMedia('(min-width: 992px)').matches) {
                return;
            }

            const $dropdown = $(this);
            setTimeout(function () {
                if (!$dropdown.find(':focus').length) {
                    closeDropdown($dropdown);
                }
            }, 10);
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
