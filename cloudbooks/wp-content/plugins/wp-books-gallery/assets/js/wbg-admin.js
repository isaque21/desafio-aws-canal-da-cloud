(function($) {

    // USE STRICT
    "use strict";

    function initColorPicker(widget) {
        widget.find('.wbg-color-picker').not('[id*="__i__"]').wpColorPicker({
            change: _.throttle(function() {
                $(this).trigger('change');
            }, 3000)
        });
    }

    function onFormUpdate(event, widget) {
        initColorPicker(widget);
    }

    $(document).on('widget-added widget-updated', onFormUpdate);

    $(document).ready(function() {
        $('.widget-inside:has(.wbg-color-picker)').each(function() {
            initColorPicker($(this));
        });
    });

    var wbgColorPicker = [
        '#wbg_container_border_color',
        '#wbg_container_bg_color',
        '#wbg_btn_color',
        '#wbg_btn_font_color',
        '#wbg_btn_border_color',
        '#wbg_search_reset_bg_color',
        '#wbg_search_reset_border_color',
        '#wbg_search_reset_font_color',
        '#wbg_search_panel_bg_color',
        '#wbg_search_panel_border_color',
        '#wbg_search_panel_input_bg_color',
        '#wbg_download_btn_color',
        '#wbg_download_btn_font_color',
        '#wbg_download_btn_color_hvr',
        '#wbg_download_btn_font_color_hvr',
        '#wbg_title_color',
        '#wbg_title_hover_color',
        '#wbg_description_color',
        '#wbg_loop_book_border_color',
        '#wbg_loop_book_bg_color',
        '#wbg_search_btn_bg_color_hover',
        '#wbg_search_font_color_hover',
        '#wbg_single_title_font_color',
        '#wbg_single_subtitle_font_color',
        '#wbg_single_label_font_color',
        '#wbg_single_info_font_color',
        '#wbg_pagination_bg_color',
        '#wbg_pagination_font_color',
        '#wbg_pagination_hover_bg_color',
        '#wbg_pagination_hover_font_color',
        '#wbg_pagination_active_bg_color',
        '#wbg_pagination_active_font_color',
        '#wbg_single_modal_bg_color',
        '#wbg_single_modal_border_color',
        '#wbg_rprice_font_color',
        '#wbg_dprice_font_color',
        '#wbg_loop_format_font_color',
        '#wbg_loop_cat_font_color',
        '#wbg_loop_author_font_color',
    ];

    $.each(wbgColorPicker, function(index, value) {
        $(value).wpColorPicker();
    });

    $("#wbg_published_on").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
    });

    $('.wbg-search-settings-table').sortable({
        items: '.wbg_list_item',
        opacity: 0.6,
        cursor: 'move',
        axis: 'y',
        update: function() {
            var order = $(this).sortable('serialize') + '&action=search_item_order';
            $.post(ajaxurl, order, function() {
                //alert('test');
            });
        }
    });

    $('.wbg-closebtn').on('click', function() {
        this.parentElement.style.display = 'none';
    });

})(jQuery);