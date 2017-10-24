<?php

namespace ACFFusion;

class Field {

    public $code;

    public $label;

    public $settings = [];

    public $parent;

    public static $defaults = [];

    public static $type = 'field';

    public static $purpose = 'data';

    public function __construct($code, $label)
    {
        // Populate with the defaults for the field
        $this->settings = static::$defaults;
        // Set the code and label
        $this->code = $code;
        $this->label = $label;
        // Update the field settings values
        $this->settings['key'] = $this->getKey();
        $this->settings['name'] = $code;
        $this->settings['_name'] = $code;
        $this->settings['label'] = $label;
    }

    public function getCode() {
        // Return the provided code
        return $this->code;
    }

    public function getKey() {
        // If a parent object was returned
        if ($this->parent) {
            // Merge with the parent's code
            return static::$type.'_'.$this->parent->getCode().'_'.$this->getCode();
        } // Otherwise return the standard key
        else { return static::$type.'_'.$this->getCode(); }
    }

    public function setParent($parentObj) {
        // Save the parent for future use
        $this->parent = $parentObj;
        // Regenerate the key
        $this->settings['key'] = $this->getKey();
        // Return for chaining
        return $this;
    }

    public function setOptions($options) {
        // Update the settings with the options
        $this->settings = array_merge($this->settings, $options);
        // Return for chaining
        return $this;
    }

    public function setWrapper($width="100", $class="", $id="") {
        // Set the field wrapper
        $this->settings['wrapper'] = [
            'width' => $width,
            'class' => $class,
            'id' => $id,
        ];
        // Return for chaining
        return $this;
    }

    public function setInstructions($instructions) {
        // Set the setting option value
        $this->settings['instructions'] = $instructions;
        // Return for chaining
        return $this;
    }

    public function setRequired($required) {
        // Set the setting option value
        $this->settings['required'] = $required;
        // Return for chaining
        return $this;
    }

    public function setDefault($default) {
        // Set the setting option value
        $this->settings['default_value'] = $default;
        // Return for chaining
        return $this;
    }

    public function setPlaceholder($placeholder) {
        // Set the setting option value
        $this->settings['placeholder'] = $placeholder;
        // Return for chaining
        return $this;
    }

    public function toArray() {
        // Return the settings array
        return $this->settings;
    }

    public function toSettings() {
        // Return the settings array
        return $this->settings;
    }

    public function toKeys() {
        // return the built settings
        return static::$purpose == 'data' ? [$this->getKey() => ''] : [];
    }

    public function toIndex($index, $values, $keyPrefix='', $namePrefix='') {
        // Set the field in the index collection
        $index->collection[$keyPrefix.$this->getKey()] = $namePrefix.$this->getCode();
    }

    public function toNames() {
        // return the built settings
        return static::$purpose == 'data' ? [$this->getCode() => ''] : [];
    }

    public function toValues($value, $valueFormat='key', $outFormat='key', $prefix='') {
        // Determine the keys we are going to look for
        $valueKey = ($valueFormat === 'key' || $valueFormat === 'acf') ? $this->getKey() : $this->getCode();
        $outKey = ($outFormat === 'key' || $outFormat === 'acf')  ? $this->getKey() : $this->getCode();
        // return the built settings
        return static::$purpose == 'data' ? [$prefix.$outKey => $value] : [];
    }

    public function addCondition($field, $operator, $value) {
        // Populate the conditions
        $conditions = !isset($this->settings['conditional_logic']) || !is_array($this->settings['conditional_logic']) ? [] : $this->settings['conditional_logic'];
        // Add to the conditions
        $conditions[] = [
            'field' => $field,
            'operator' => $operator,
            'value' => $value,
        ];
        // Update the conditional logic
        $this->settings['conditional_logic'] = $conditions;
        // Return the settings array
        return $this->settings;
    }
}