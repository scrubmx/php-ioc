<?php

namespace Intonate;

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
     * @throws \Intonate\ContainerResolutionException
     *
     * @return mixed
     */
    public function make($abstract)
    {
        if ( class_exists($abstract) )
        {
            return $this->build($abstract);
        }

        if ( array_key_exists($abstract, $this->bindings) )
        {
            return $this->build($this->bindings[ $abstract ]);
        }

        throw new ContainerResolutionException;
    }

    public function build($className)
    {
        $concrete = new Concrete($className);

        if ( $concrete->hasConstructor() )
        {
            $parameters = [];

            foreach( $concrete->getParameters() as $parameter )
            {
                $parameters[] = $this->make( $parameter->getClass()->name );
            }

            return $concrete->instance($parameters);
        }

        return $concrete->instance();
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

}
