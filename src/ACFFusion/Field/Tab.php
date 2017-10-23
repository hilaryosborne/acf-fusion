<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class Tab extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'placement' => 'left',
        'endpoint' => ''
    ];

    public static $type = 'tab';

    public static $purpose = 'display';

}