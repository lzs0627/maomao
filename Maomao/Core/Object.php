<?php

namespace Maomao\Core;

/**
 * ベースクラス
 *
 * @author lizhaoshi
 */

class Object
{
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            throw new \LogicException(sprintf('Undefined property: $%s', $name));
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new \LogicException(sprintf('Undefined property: $%s', $name));
        }
    }
}
