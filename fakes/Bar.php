<?php

namespace Fake;

class Bar
{

    private $foo;

    /**
     * @param \Fake\Foo $foo
     */
    public function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }

}
