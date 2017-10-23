<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class PageLink extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'page_link',
        'label' => '',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'post_type' => [],
        'taxonomy' => [],
        'allow_null' => 0,
        'allow_archives' => 1,
        'multiple' => 0
    ];

    public static $type = 'field';

}