/**
 * File custom-jquery.js.
 *
 * Customized juqery to enhance navbar.js and wai-dropdown.js
 * 
 */

jQuery(document).ready(function($) {
    $('#primary-menu button.dropdown-toggle').on("click", function(e) {
        e.stopPropagation();
        if ($(this).is("li")) {
            if ($(this).hasClass('opened')) {
                $(this).addClass('closed');
            } else {
                $(this).removeClass('closed');
            }
            $(this).siblings().children('.sub-menu').removeClass('visible');
            $(this).siblings().removeClass('current-menu-parent opened');
            $(this).toggleClass('current-menu-parent opened');
            $(this).children('.sub-menu').toggleClass('visible');
        } else {
            if ($(this).parent().hasClass('opened')) {
                $(this).parent().addClass('closed');
            } else {
                $(this).parent().removeClass('closed');
            }
            $(this).parent().siblings().children('.sub-menu').removeClass('visible');
            $(this).parent().siblings().removeClass('current-menu-parent');
            $(this).parent().children('.sub-menu').toggleClass('visible');
            $(this).parent().toggleClass('current-menu-parent opened');
        }
		if ($('ul.has-sub-menu ul.sub-menu').hasClass('toggled-on')) {
			$(this).closest('ul.has-sub-menu').addClass('toggled-on');
		}
    });
    // Below sets aria-roles for sidebar/page menu. 
    $('#section-menu li').attr('aria-role', 'none');
    $('#section-menu li a').attr('aria-role', 'menuitem');
});