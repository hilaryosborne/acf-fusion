<?php

namespace ACFFusion;

use Underscore\Types\Arrays;

class Manager {

    public $pid;

    public $builderObj;

    protected $values = [];

    public function __construct($pid, $builderObj)
    {
        $this->pid = $pid;
        $this->builderObj = $builderObj;
    }

    public function getBuilder() {
        // Return the builder object
        return $this->builderObj;
    }

    public function load() {
        // Retrieve the current field values
        $this->values = $this->toValues(get_fields($this->pid, false),'acf','key');
        // Return for chaining
        return $this;
    }

    public function dump($mode='name') {
        // Retrieve the current field values
        return $this->toValues($this->values,'key',$mode);
    }

    public function inject($values, $mode='key') {
        // Update the values
        $this->values = $mode === 'name' ? $this->builderObj->toValues($values,'name','key') : $values;
        // Return for chaining
        return $this;
    }

    public function getField($path=false, $default=false, $format=true) {
        // Retrieve the name values
        $names = $this->toValues($this->values,'key','name');
        // Attempt to retrieve the field object
        $value = Arrays::get($names, $path);
        // If no value exists with that keypath
        if (!$value) { return $default ? $default : null; }
        // Return the formatted value
        return $format ? $this->format($path, $value, 'names') : $value ;
    }

    public function setField($path, $value) {
        // Retrieve the name values
        $names = $this->toValues($this->values,'key','name');
        // Retrieve the current field values
        $values = Arrays::set($names, $path, $value);
        // Retrieve the name values
        $this->values = $this->toValues($values,'name','key');
        // Return for chaining
        return $this;
    }

    public function save() {
        // Retrieve the raw values
        $values = $this->values;
        // Loop through each of the stored values
        // The values should be stored as KEYS for ACF to work
        foreach ($values as $fieldKey => $fieldValues) {
            // Update the field
            update_field($fieldKey, $fieldValues, $this->pid);
        }
    }

    public function format($path, $value) {
        // Retrieve the manager object
        $builderObj = $this->builderObj;
        // THIS NEEDS REGEX WORK!
        $filtered = preg_replace("/(\.[0-9]+\.)/", ".",$path);
        $filtered = preg_replace("/(\.[0-9]+)/", "",$filtered);
        $filtered = preg_replace("/([0-9]+\.)/", "",$filtered);
        // Attempt to retrieve the field object
        $fieldObject = $builderObj->getFieldObject($filtered);
        // If no object was found then return the provided variables
        // Do this incase fields have been moved or removed
        if (!$fieldObject) { return $value; }
        // Retrieve the settings
        $settings = $fieldObject->toSettings();
        // Rebuild the acf cache key
        // Apply ACF filters
        // These filters are directly from ACF
        $value = apply_filters( "acf/format_value", $value, $this->pid, $settings );
        $value = apply_filters( "acf/format_value/type={$settings['type']}", $value, $this->pid, $settings );
        $value = apply_filters( "acf/format_value/name={$settings['_name']}", $value, $this->pid, $settings );
        $value = apply_filters( "acf/format_value/key={$settings['key']}", $value, $this->pid, $settings );
        // Return the filtered value
        return $value;
    }

    public function getIndex($values) {
        // Retrieve the builder object
        $builderObj = $this->getBuilder();
        // Retrieve the field groups
        $fieldGroups = $builderObj->getFieldGroups();
        // The indexed array
        $indexed = [];
        // Loop through each of the field groups
        foreach ($fieldGroups as $k => $fieldGroupObj) {
            // Populate with the populated field group
            $indexed[$fieldGroupObj->getKey()] = $fieldGroupObj->getIndex($values);
        }
        // return the built settings
        return $indexed;
    }

    public function toValues($values, $valueFormat='key', $outFormat='key') {
        // Retrieve the builder object
        $builderObj = $this->getBuilder();
        // Retrieve the field groups
        $fieldGroups = $builderObj->getFieldGroups();
        // If no field groups have been added
        if (!is_array($fieldGroups)) { return []; }
        // Retrieve the field settings
        $output = [];
        // Loop through each field group
        foreach ($fieldGroups as $k => $fieldGroup) {
            // Populate the subfields with the to array results
            $output = array_merge($output, $fieldGroup->toValues($values, $valueFormat, $outFormat));
        }
        // return the built settings
        return $output;
    }

}