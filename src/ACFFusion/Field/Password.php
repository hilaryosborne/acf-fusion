<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class Password extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'password',
        'label' => '',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'placeholder' => '',
        'prepend' => '',
        'append' => ''
    ];

    public static $type = 'field';

}