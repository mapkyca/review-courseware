<?php

namespace IdnoPlugins\Courseware\Entities\Fields;

/**
 * Helper definitions for entity fields.
 */
trait Definition {
    
    /**
     * Fields available in this entity.
     * @return variable => viewtype
     */
    abstract public function fields() : array;
    
    /**
     * Field defaults.
     * @return variable => default value
     */
    abstract public function fieldsDefaults() : array;
    
    /**
     * Field defaults.
     * @return variable => bool
     */
    abstract public function fieldsRequired() : array;
    
    /**
     * Field labels
     * @return variable => text
     */
    abstract public function fieldsLabels() : array;
    
    /**
     * Field placeholders
     * @return variable => text
     */
    abstract public function fieldsPlaceholders() : array;
    
    /**
     * Field help text
     * @return variable => text
     */
    abstract public function fieldsHelp() : array;
    
}