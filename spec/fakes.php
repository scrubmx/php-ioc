<?php

namespace Fake;

class Foo {}

class Bar {

    private $foo;

    function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }
}

class Baz {

    private $foo;
    private $bar;

    function __construct(Foo $foo, Bar $bar)
    {
        $this->foo = $foo;
        $this->bar = $bar;
    }
}