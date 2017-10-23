<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class Taxonomy extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'taxonomy',
        'label' => '',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'taxonomy' => 'access',
        'field_type' => 'multi_select',
        'allow_null' => 0,
        'add_term' => 1,
        'save_terms' => 1,
        'load_terms' => 1,
        'return_format' => 'id',
        'multiple' => 0
    ];

    public static $type = 'field';

}