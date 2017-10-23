<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class Gallery extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'gallery',
        'label' => '',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'min' => '',
        'max' => '',
        'insert' => 'append',
        'library' => 'uploadedTo',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
    ];

    public static $type = 'field';

}