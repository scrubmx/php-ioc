<?php

namespace Intonate\Container;

use ReflectionClass;
use ReflectionMethod;

class Concrete
{
    private $className;

    public function __construct($className)
    {
        $this->className = $className;
    }

    /**
     * Returns an instance of the specified class.
     *
     * It can pass any number of parameters to the constructor
     * from the provided array of parameters.
     *
     * @param array $parameters
     *
     * @return mixed
     */
    public function instance(array $parameters = [])
    {
        if ( empty($parameters) ) {
            return new $this->className;
        }

        return $this->getReflection()->newInstanceArgs($parameters);
    }

    /**
     * @return bool
     */
    public function hasConstructor()
    {
        $reflection = $this->getReflection();

        return $reflection->getConstructor() instanceof ReflectionMethod;
    }

    /**
     * @return \ReflectionClass
     */
    public function getReflection()
    {
        return new ReflectionClass($this->className);
    }

    /**
     * @return \ReflectionParameter[]
     */
    public function getParameters()
    {
        return $this->getReflection()->getConstructor()->getParameters();
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param $className
     *
     * @return void
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }
}
