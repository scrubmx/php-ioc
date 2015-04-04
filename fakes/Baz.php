<?php

namespace Fake;

class Baz
{

    private $foo;

    private $bar;

    /**
     * @param \Fake\Foo $foo
     * @param \Fake\Bar $bar
     */
    public function __construct(Foo $foo, Bar $bar)
    {
        $this->foo = $foo;
        $this->bar = $bar;
    }

}
