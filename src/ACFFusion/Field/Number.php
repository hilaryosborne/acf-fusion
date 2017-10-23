<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class Number extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'number',
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
        'prepend' => '',
        'append' => '',
        'min' => '',
        'max' => '',
        'step' => ''
    ];

    public static $type = 'field';

}