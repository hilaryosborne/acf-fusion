<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class File extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'file',
        'label' => '',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'return_format' => 'array',
        'library' => 'uploadedTo',
        'min_size' => '',
        'max_size' => '',
        'mime_types' => ''
    ];

    public static $type = 'field';

}