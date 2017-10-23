<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class Wysiwyg extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'wysiwyg',
        'label' => '',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'default_value' => '',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 1,
        'delay' => 0
    ];

    public static $type = 'field';

}