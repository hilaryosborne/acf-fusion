<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class GoogleMap extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'google_map',
        'label' => '',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'center_lat' => '',
        'center_lng' => '',
        'zoom' => '',
        'height' => ''
    ];

    public static $type = 'field';

}