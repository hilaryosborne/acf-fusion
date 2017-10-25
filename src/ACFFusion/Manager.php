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

    public function load() {
        // Retrieve the manager object
        $builderObj = $this->builderObj;
        // Retrieve the current field values
        $this->values = $builderObj->toValues(get_fields($this->pid, false),'acf','key');
        // Return for chaining
        return $this;
    }

    public function dump($mode='name') {
        // Retrieve the manager object
        $builderObj = $this->builderObj;
        // Retrieve the current field values
        return $builderObj->toValues($this->values,'key',$mode);
    }

    public function inject($values, $mode='key') {
        // Update the values
        $this->values = $mode === 'name' ? $this->builderObj->toValues($values,'name','key') : $values;
        // Return for chaining
        return $this;
    }

    public function getField($path=false, $default=false, $format=true) {
        // Retrieve the manager object
        $builderObj = $this->builderObj;
        // Retrieve the name values
        $names = $builderObj->toValues($this->values,'key','name');
        // Attempt to retrieve the field object
        $value = Arrays::get($names, $path);
        // If no value exists with that keypath
        if (!$value) { return $default ? $default : null; }
        // Return the formatted value
        return $format ? $this->format($path, $value, 'names') : $value ;
    }

    public function setField($path, $value) {
        // Retrieve the manager object
        $builderObj = $this->builderObj;
        // Retrieve the name values
        $names = $builderObj->toValues($this->values,'key','name');
        // Retrieve the current field values
        $values = Arrays::set($names, $path, $value);
        // Retrieve the name values
        $this->values = $builderObj->toValues($values,'name','key');
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

    public function format($path, $value, $mode ='keys') {
        // Retrieve the manager object
        $builderObj = $this->builderObj;
        // Retrieve the field objects
        $fields = $builderObj->toArray();
        // THIS NEEDS REGEX WORK!
        $filtered = preg_replace("/(\.[0-9]+\.)/", ".",$path);
        $filtered = preg_replace("/(\.[0-9]+)/", "",$filtered);
        $filtered = preg_replace("/([0-9]+\.)/", "",$filtered);
        // Replace all dots with subfields
        // Child field objects are stored within subfields
        $prepared = str_replace('.','.sub_fields.', $filtered);
        // Attempt to retrieve the field object
        $fieldObject = Arrays::get($fields['fields'], $prepared);
        // If no object was found then return the provided variables
        // Do this incase fields have been moved or removed
        if (!$fieldObject) { return $value; }
        // Rebuild the acf cache key
        // This cache key is directly from ACF
        $cache_key = "format_value/post_id={$this->pid}/name={$fieldObject['name']}";
        // Apply ACF filters
        // These filters are directly from ACF
        $value = apply_filters( "acf/format_value", $value, $this->pid, $fieldObject );
        $value = apply_filters( "acf/format_value/type={$fieldObject['type']}", $value, $this->pid, $fieldObject );
        $value = apply_filters( "acf/format_value/name={$fieldObject['_name']}", $value, $this->pid, $fieldObject );
        $value = apply_filters( "acf/format_value/key={$fieldObject['key']}", $value, $this->pid, $fieldObject );
        // update cache
        acf_set_cache($cache_key, $value);
        // Return the filtered value
        return $value;
    }

}