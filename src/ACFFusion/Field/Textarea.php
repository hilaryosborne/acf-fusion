<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class Textarea extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'textarea',
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
        'placeholder' => '',
        'maxlength' => '',
        'rows' => 3,
        'new_lines' => ''
    ];

    public static $type = 'field';

}