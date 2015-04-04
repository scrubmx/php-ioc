<?php

namespace spec\Intonate\Container;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConcreteSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('Fake\Foo');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Intonate\Container\Concrete');
    }

    public function it_can_instantiate_a_class()
    {
        $this->instance()->shouldReturnAnInstanceOf('Fake\Foo');
    }

    public function it_can_instantiate_a_class_with_provided_dependencies()
    {
        $this->setClassName('Fake\Bar');

        $parameters = new \Fake\Foo;

        $this->instance(compact('parameters'))->shouldReturnAnInstanceOf('Fake\Bar');
    }

    public function it_returns_false_if_the_class_does_not_have_a_constructor()
    {
        $this->hasConstructor()->shouldReturn(false);
    }

    public function it_returns_true_if_the_class_does_have_a_constructor()
    {
        $this->setClassName('Fake\Bar');

        $this->hasConstructor()->shouldReturn(true);
    }

    public function it_can_return_a_reflection_class_instance()
    {
        $this->getReflection()->shouldReturnAnInstanceOf('ReflectionClass');
    }

    public function it_can_get_the_parameters_for_the_constructor()
    {
        $this->setClassName('Fake\Baz');

        $parameters = $this->getParameters();

        $parameters->shouldHaveCount(2);
        $parameters[0]->shouldReturnAnInstanceOf('ReflectionParameter');
        $parameters[1]->shouldReturnAnInstanceOf('ReflectionParameter');
    }

    public function it_can_get_the_class_name()
    {
        $this->getClassName()->shouldBeEqualTo('Fake\Foo');
    }

    public function it_can_set_a_new_class_name()
    {
        $this->setClassName('Fake\Baz');

        $this->getClassName()->shouldBeEqualTo('Fake\Baz');
    }

    public function it_throws_an_exception_when_the_class_does_not_exist()
    {
        $this->setClassName('Fake\DoesNotExist');

        $this->shouldThrow('ReflectionException')->duringGetReflection('ReflectionClass');
    }
}
