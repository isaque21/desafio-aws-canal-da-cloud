<?php

    $digital_books_scroll_position = get_theme_mod( 'digital_books_scroll_top_position','Right');
    if($digital_books_scroll_position == 'Right'){
        $digital_books_theme_css .='#button{';
            $digital_books_theme_css .='right: 20px;';
        $digital_books_theme_css .='}';
    }else if($digital_books_scroll_position == 'Left'){
        $digital_books_theme_css .='#button{';
            $digital_books_theme_css .='left: 20px;';
        $digital_books_theme_css .='}';
    }else if($digital_books_scroll_position == 'Center'){
        $digital_books_theme_css .='#button{';
            $digital_books_theme_css .='right: 50%;left: 50%;';
        $digital_books_theme_css .='}';
    }