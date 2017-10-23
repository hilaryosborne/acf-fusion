<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class Select extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'select',
        'label' => '',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'choices' => [],
        'default_value' => '',
        'allow_null' => 0,
        'multiple' => 0,
        'ui' => 0,
        'ajax' => 0,
        'return_format' => 'value',
        'placeholder' => ''
    ];

    public static $type = 'field';

    public function setChoices($choices) {
        // Set the available choices
        $this->settings['choices'] = $choices;
        // Return for chaining
        return $this;
    }

}