<?php

namespace ACFFusion\Field;

use ACFFusion\Field;

class Group extends Field {

    public static $defaults = [
        'key' => '',
        'name' => '',
        'type' => 'group',
        'instructions' => '',
        'required' => '',
        'conditional_logic' => '',
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'layout' => 'block',
        'button_label' => 'Add Item',
        'sub_fields' => []
    ];

    public static $type = 'group';

    public $subFields = [];

    public function setLayout($value) {
        // Set the setting option value
        $this->settings['layout'] = (string)$value;
        // Return for chaining
        return $this;
    }

    public function setButtonLabel($value) {
        // Set the setting option value
        $this->settings['button_label'] = (string)$value;
        // Return for chaining
        return $this;
    }

    public function addField($fieldObj) {
        // Set the parent for future use
        $fieldObj->setParent($this);
        // Add to the fields collection
        $this->subFields[] = $fieldObj;
        // Return for chaining
        return $this;
    }

    public function addFieldset($fieldset, $prefix='') {
        // Set the parent for future use
        $fieldset->fields($this, $prefix);
        // Return for chaining
        return $this;
    }

    public function toArray() {
        // Retrieve the field settings
        $settings = $this->settings;
        // Loop through each of the sub fields
        foreach ($this->subFields as $k => $field) {
            // Populate the subfields with the to array results
            $settings['sub_fields'][$field->getCode()] = $field->toArray();
        }
        // return the built settings
        return $settings;
    }

    public function toSettings() {
        // Retrieve the field settings
        $settings = $this->settings;
        // Loop through each of the sub fields
        foreach ($this->subFields as $k => $field) {
            // Populate the subfields with the to array results
            $settings['sub_fields'][] = $field->toSettings();
        }
        // return the built settings
        return $settings;
    }

    public function toKeys() {
        // Retrieve the field settings
        $keys = [];
        // Loop through each of the fields
        foreach ($this->subFields as $k => $field) {
            // Populate the subfields with the to array results
            $keys = array_merge($keys, $field->toKeys());
        }
        // return the built settings
        return [$this->getKey() => $keys];
    }

    public function toIndex($index, $values, $keyPrefix='', $namePrefix='') {
        // Set the field in the index collection
        $index->collection[$keyPrefix.$this->getKey()] = $namePrefix.$this->getCode();
        // Create the new key prefix
        $groupKeyPrefix = $keyPrefix.$this->getKey().'.';
        $groupNamePrefix = $keyPrefix.$this->getCode().'.';
        // Loop through each of the fields
        foreach ($this->subFields as $k => $fieldObj) {
            // Retrieve the value
            $value = isset($values[$fieldObj->getKey()]) ? $values[$fieldObj->getKey()] : false ;
            // Populate the subfields with the to array results
            $fieldObj->toIndex($index, $value, $groupKeyPrefix, $groupNamePrefix);
        }
    }

    public function toNames() {
        // Retrieve the field settings
        $names = [];
        // Loop through each of the fields
        foreach ($this->subFields as $k => $field) {
            // Populate the subfields with the to array results
            $names = array_merge($names, $field->toNames());
        }
        // return the built settings
        return [$this->getCode() => $names];
    }

    public function toValues($values, $valueFormat='key', $outFormat='key', $prefix='') {
        // Retrieve the field settings
        $output = [];
        // Determine the keys we are going to look for
        $valueKey = ($valueFormat === 'key' || $valueFormat === 'acf') ? $this->getKey() : $this->getCode();
        $outKey = ($outFormat === 'key' || $outFormat === 'acf') ? $this->getKey() : $this->getCode();
        // Loop through each of the fields
        foreach ($this->subFields as $k => $fieldObj) {
            // Determine the keys we are going to look for
            $fieldValueKey = ($valueFormat === 'key' || $valueFormat === 'acf') ? $prefix.$fieldObj->getKey() : $prefix.$fieldObj->getCode();
            $fieldOutKey = ($outFormat === 'key' || $outFormat === 'acf') ? $prefix.$fieldObj->getKey() : $prefix.$fieldObj->getCode();
            // If no value has been set
            if (!isset($values[$fieldValueKey])) { continue; }
            // Populate the subfields with the to array results
            $output = array_merge($output, $fieldObj->toValues($values[$fieldValueKey], $valueFormat, $outFormat));
        }
        // return the built settings
        return [$outKey => $output];
    }

}