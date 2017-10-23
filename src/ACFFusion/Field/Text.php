<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class Text extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'text',
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
        'maxlength' => ''
    ];

    public static $type = 'field';

}