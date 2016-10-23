<?php

namespace TechFinancials;

/**
 * Class Entity
 * @package TechFinancials
 */
class Entity
{
    public function __construct($params = [])
    {
        foreach ($params as $name => $value) {
            if (property_exists($this, $name)) {
                $this->{$name} = $value;
            }
        }
    }
}
