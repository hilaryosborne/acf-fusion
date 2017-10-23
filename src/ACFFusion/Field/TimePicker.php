<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class TimePicker extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'time_picker',
        'label' => '',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'display_format' => "g:i a",
        'return_format' => "g:i a"
    ];

    public static $type = 'field';

}