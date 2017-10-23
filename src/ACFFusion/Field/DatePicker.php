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
        'display_format' => "d/m/Y",
        'return_format' => "d/m/Y",
        'first_day' => 1
    ];

    public static $type = 'field';

    public function setDisplayFormat($value) {
        // Set the setting option value
        $this->settings['display_format'] = (int)$value;
        // Return for chaining
        return $this;
    }

    public function setReturnFormat($value) {
        // Set the setting option value
        $this->settings['return_format'] = (int)$value;
        // Return for chaining
        return $this;
    }

    public function setFirstDay($value) {
        // Set the setting option value
        $this->settings['first_day'] = (bool)$value;
        // Return for chaining
        return $this;
    }
}