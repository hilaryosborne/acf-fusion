<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class DatePicker extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'date_picker',
        'label' => '',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'display_format' => "d\/m\/Y",
        'return_format' => "d\/m\/Y",
        'first_day' => 1
    ];

    public static $type = 'field';

}