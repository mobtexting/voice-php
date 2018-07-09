<?php

namespace Mobtexting\Voice;

use Mobtexting\Voice\Voice;

class Voice
{
    protected $name;
    protected $append = [];
    protected $attributes = [];
    protected $nested = [];

    /**
     * DialPlan Constructor
     *
     * @param string $name Dial Plan Element Name
     * @param array $attributes Attributes of The Dial Plan Element Attributes
     */

    public function __construct($name, $attributes = [])
    {
        $this->name = $name;
        if (is_array($attributes)) {
            $this->attributes = array_merge_recursive($this->attributes, $attributes);
        }
        
        $this->append = array();
    }

    /**
     *
     */
    public function setAttribute($name, $value = null, $instance = false)
    {
        if ($name instanceof Attribute) {
            $this->attributes = array_merge_recursive($this->attributes, $name->toArray());
        } elseif (\is_array($name)) {
            $this->attributes = array_merge_recursive($this->attributes, $name);
        } else {
            $this->attributes[$name] = $value;
        }

        if ($instance) {
            return $value;
        }
        
        return $this;
    }
    
    public function append($verb, $args = [])
    {
        $widget = 'Mobtexting\\Voice\\Tag\\'.ucfirst(strtolower($verb));

        $widget = new $widget(...$args);

        return $widget;
    }

    /**
     * Convert Dial Plan to json
     *
     * @return string DialPlan json representation
     */

    public function toJson()
    {
        $element = $this->toArray();
        return json_encode($element);
    }

    /**
     * Convert Dial Plan to String
     *
     * @return string DialPlan json representation
     */
    public function __toString()
    {
        return $this->toJson();
    }

    public function getDefaultAttributes()
    {
        return [];
    }

    /**
    * Convert Dial Plan to An PHP Array
    *
    * @return Array DialPlan Array representation
    **/
    public function toArray()
    {
        $element = array();
        $attributes = $this->getDefaultAttributes();

        $attributes = array_merge($attributes, $this->processAttribs($this->attributes));

        $element[$this->name] = $attributes;
     
        return $element;
    }

    public function processAttribs($attributes = [])
    {
        foreach ($attributes as $name => $value) {
            if ($value instanceof Voice) {
                $attributes[$name] = $value->toArray();
            }

            if (is_array($value)) {
                $attributes[$name] = $this->processAttribs($value);
            }
        }

        return $attributes;
    }

    public function __call($name, $value = [])
    {
        if (substr($name, 0, 3) == 'set') {
            $name = ltrim($name, 'set');
            return $this->setAttribute(strtolower($name), current($value));
        }

        if (substr($name, 0, 2) == 'on') {
            return $this->setAttribute($name, $this->append($value), true);
        }

        if (in_array($name, $this->nested)) {
            return $this->setAttribute($name, $this->append($value), true);
        }

        return $this->append($name, $value);
    }
}
