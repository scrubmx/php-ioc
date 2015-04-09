<?php

namespace Intonate\Container;

class Container
{
    /**
     * Associative array containing all the bindings.
     *
     * @var array
     */
    protected $bindings = [];

    /**
     * Create an instance of the specified key.
     *
     * @param $abstract
     *
     * @throws \Intonate\Container\ContainerResolutionException
     *
     * @return mixed
     */
    public function make($abstract)
    {
        if (class_exists($abstract)) {
            return $this->build($abstract);
        }

        if (array_key_exists($abstract, $this->bindings)) {
            return $this->build($this->bindings[ $abstract ]);
        }

        throw new ContainerResolutionException();
    }

    /**
     * Builds the instance of the provided class name
     * Recursively resolves any dependencies that the object might have.
     *
     * @param $className
     *
     * @return mixed
     */
    public function build($className)
    {
        $concrete = new Concrete($className);

        $parameters = $concrete->hasConstructor() ? $this->getParameters($concrete) : [];

        return $concrete->instance($parameters);
    }

    /**
     * Set a new binding in the bindings array.
     *
     * @param $key
     * @param $binding
     */
    public function bind($key, $binding)
    {
        $this->bindings[ $key ] = $binding;
    }

    /**
     * Get the bindings array.
     *
     * @return array
     */
    public function bindings()
    {
        return $this->bindings;
    }

    /**
     * @param $concrete
     *
     * @return array
     */
    protected function getParameters($concrete)
    {
        $parameters = [];

        foreach ($concrete->getParameters() as $parameter) {
            $parameters[] = $this->make($parameter->getClass()->name);
        }

        return $parameters;
    }
}
