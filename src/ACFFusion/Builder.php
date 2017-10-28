<?php

namespace ACFFusion;

use Underscore\Types\Arrays;

class Builder {

    public $fieldGroups = [];

    public function addFieldGroup($fieldGroupObj) {
        // Add to the fields collection
        $this->fieldGroups[] = $fieldGroupObj;
        // Return for chaining
        return $this;
    }

    public function getFieldGroup($path) {
        // Retrieve the fieldgroups
        return Arrays::get($this->fieldGroups, $path);
    }

    public function getFieldGroups() {
        // Retrieve the fieldgroups
        return $this->fieldGroups;
    }

    public function getFieldObject($path, $format='names') {
        // Convert the subfields to an array
        $fields = $this->toObjects($format);
        // Retrieve the field object
        $fieldObj = Arrays::get($fields, $path);
        // Return the field object
        return $fieldObj;
    }

    /**
     * RETURN FIELD OBJECT INDEX
     * @param string $format
     * @return array
     */

    public function toObjects($format='key') {
        // Retrieve the field settings
        $index = new \stdClass();
        // The collection to add items to
        $index->collection = [];
        // Loop through each of the fields
        foreach ($this->fieldGroups as $k => $fieldGroupObj) {
            // Populate the subfields with the to array results
            $fieldGroupObj->toObjects($index, $format);
        }
        // return the built settings
        return $index->collection;
    }

    /**
     * RETURN FIELD OBJECTS
     * @param string $format
     * @return array
     */

    public function toArray($format='key') {
        // The array to populate with filtered objects
        $fieldGroups = [];
        // Loop through each of the field groups
        foreach ($this->fieldGroups as $k => $fieldGroupObj) {
            // Populate with the populated field group
            $fieldGroups[$fieldGroupObj->getCode()] = $fieldGroupObj->toArray($format);
        }
        // return the built settings
        return $fieldGroups;
    }

    /**
     * GET ACF REGISTER FRIENDLY FIELDS
     * @return array
     */

    public function toSettings() {
        // The array to populate with filtered objects
        $fieldGroups = [];
        // Loop through each of the field groups
        foreach ($this->fieldGroups as $k => $fieldGroupObj) {
            // Populate with the populated field group
            $fieldGroups[$fieldGroupObj->getCode()] = $fieldGroupObj->toSettings();
        }
        // return the built settings
        return $fieldGroups;
    }

    /**
     * ACF FRIENDLY RETRIEVE KEYS
     * @return array
     */

    public function toKeys() {
        // The array to populate with filtered objects
        $fieldGroups = [];
        // Loop through each of the field groups
        foreach ($this->fieldGroups as $k => $fieldGroupObj) {
            // Populate with the populated field group
            $fieldGroups = array_merge($fieldGroups, $fieldGroupObj->toKeys());
        }
        // return the built settings
        return $fieldGroups;
    }

    /**
     * ACF FRIENDLY RETRIEVE NAMES
     * @return array
     */

    public function toNames() {
        // The array to populate with filtered objects
        $fieldGroups = [];
        // Loop through each of the field groups
        foreach ($this->fieldGroups as $k => $fieldGroupObj) {
            // Populate with the populated field group
            $fieldGroups = array_merge($fieldGroups, $fieldGroupObj->toNames());
            // Populate with the populated field group
            $fieldGroups[$fieldGroupObj->getCode()] = $fieldGroupObj->toNames();
        }
        // return the built settings
        return $fieldGroups;
    }

}