<?php  namespace Fake; 

class Bar {

    private $foo;

    /**
     * @param \Fake\Foo $foo
     */
    function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }

}
