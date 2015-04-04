<?php

namespace spec\Intonate\Container;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContainerSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('Intonate\Container\Container');
    }

    function it_can_receive_new_bindings()
    {
        $this->bind('user', 'User');
        $this->bindings()->shouldHaveCount(1);
    }

    function it_returns_instance_even_if_not_binded()
    {
        $this->make('Fake\Foo')->shouldReturnAnInstanceOf('Fake\Foo');
    }

    function it_returns_instance_given_a_existing_binding_key()
    {
        $this->bind('foo', 'Fake\Foo');
        $this->make('foo')->shouldReturnAnInstanceOf('Fake\Foo');
    }

    function it_resolves_dependencies_for_the_instance()
    {
        $this->bind('bar', 'Fake\Bar');
        $this->make('bar')->shouldReturnAnInstanceOf('Fake\Bar');
    }

    function it_resolves_dependencies_recursively()
    {
        $this->bind('baz', 'Fake\Baz');
        $this->make('baz')->shouldReturnAnInstanceOf('Fake\Baz');
    }

    function it_throws_an_exception_when_the_binding_is_undefined()
    {
        $this->shouldThrow()->duringMake('some_undefined_binding');
    }

}
