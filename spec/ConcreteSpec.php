<?php

namespace spec\Intonate;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConcreteSpec extends ObjectBehavior
{

    public function let()
    {
        $this->beConstructedWith('Fake\Foo');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Intonate\Concrete');
    }

    function it_can_instantiate_a_class()
    {
        $this->instance()->shouldReturnAnInstanceOf('Fake\Foo');
    }

    function it_can_instantiate_a_class_with_provided_dependencies()
    {
        $this->setClassName('Fake\Bar');

        $parameters = [new \Fake\Foo];

        $this->instance($parameters)->shouldReturnAnInstanceOf('Fake\Bar');
    }

    function it_returns_false_if_the_class_does_not_have_a_constructor()
    {
        $this->hasConstructor()->shouldReturn(false);
    }

    function it_returns_true_if_the_class_does_have_a_constructor()
    {
        $this->setClassName('Fake\Bar');

        $this->hasConstructor()->shouldReturn(true);
    }

    function it_can_return_a_reflection_class_instance()
    {
        $this->getReflection()->shouldReturnAnInstanceOf('ReflectionClass');
    }

    function it_can_get_the_parameters_for_the_constructor()
    {
        $this->setClassName('Fake\Baz');

        $parameters = $this->getParameters();

        $parameters->shouldHaveCount(2);
        $parameters[0]->shouldReturnAnInstanceOf('ReflectionParameter');
        $parameters[1]->shouldReturnAnInstanceOf('ReflectionParameter');
    }

    function it_can_get_the_class_name()
    {
        $this->getClassName()->shouldBeEqualTo('Fake\Foo');
    }

    function it_can_set_a_new_class_name()
    {
        $this->setClassName('Fake\Baz');

        $this->getClassName()->shouldBeEqualTo('Fake\Baz');
    }

    function it_throws_an_exception_when_the_class_does_not_exist()
    {
        $this->setClassName('Fake\DoesNotExist');

        $this->shouldThrow('ReflectionException')->duringGetReflection('ReflectionClass');
    }


}
