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
    abstract protected function fields() : array;
    
    /**
     * Field defaults.
     * @return variable => default value
     */
    abstract protected function fieldsDefaults() : array;
    
    /**
     * Field defaults.
     * @return variable => bool
     */
    abstract protected function fieldsRequired() : array;
    
}