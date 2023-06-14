jQuery(document).ready(function($){
    $('.nav-menu .menu-item-has-children').on("click", function(e){
            e.stopPropagation();
            if($(this).is("li")){
                if($(this).hasClass('opened')){
                    $(this).addClass('closed');
                }else{$(this).removeClass('closed');}
                $(this).siblings().children('.sub-menu').removeClass('visible');
                $(this).siblings().removeClass('current-menu-parent opened');
                $(this).toggleClass('current-menu-parent opened');
                $(this).children('.sub-menu').toggleClass('visible');
            }
            else{
                if($(this).parent().hasClass('opened')){
                    $(this).parent().addClass('closed');
                }else{$(this).parent().removeClass('closed');}
                $(this).parent().siblings().children('.sub-menu').removeClass('visible');
                $(this).parent().siblings().removeClass('current-menu-parent');
                $(this).parent().children('.sub-menu').toggleClass('visible');
                $(this).parent().toggleClass('current-menu-parent opened');
            }
    });
});