<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class PostObject extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'post_object',
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
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1
    ];

    public static $type = 'field';

}