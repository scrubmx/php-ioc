# PHP Inversion of Control Container

[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/scrubmx/php-ioc/blob/master/license.txt)
[![Build Status](https://travis-ci.org/intonate/container.svg)](https://travis-ci.org/intonate/container)
[![StyleCI](https://styleci.io/repos/33389425/shield)](https://styleci.io/repos/33389425)

*The Inversion of Control (IoC) and Dependency Injection (DI) patterns are all about removing dependencies from your code.*


### The Problem: Tight Coupling
Tight coupling is when a group of classes are highly dependent on one another. This is bad because it reduces flexibility and re-usability of code, it breaks the dependency inversion principle, it's more difficult to make changes and finally is very hard to write unit tests for this class.

Consider the following class:

```php
class PasswordReminder {
    private $db;
    private $mailer;

    public function __construct(MySQL $db, UserMailer $mailer) {
        $this->db = $db;
        $this->mailer = $mailer;
    }
}
```
In the above example we see how PasswordReminder is tightly coupled with the concrete implementations of it's dependencies and this creates all sorts of problems.

### The Solution: Dependency Inversion
So far we know we want to reduce coupling and depend on abstractions rather than concretions. To allow for this we can use the dependency inversion pattern: 

* First we need a container to explicitly declare which implementation we want to use when we are trying to resolve an interface

```php
$container->bind('DBInterface', 'MySQL');
$container->bind('MailerInterface', 'UserMailer');
```

* Then we can change our PasswordReminder class to accept those interfaces

```php
class PasswordReminder {
    private $db;
    private $mailer;

    public function __construct(DBInterface $db, MailerInterface $mailer) {
        $this->db = $db;
        $this->mailer = $mailer;
    }
}
```

* When we want to create a new instance we just ask the container to build it for us:

```php
$passwordReminder = $container->make('PasswordReminder');
```

Is now the container responsibility to map those interfaces to the concrete implementations and build the PasswordReminder class for you.

Now it's very easy to write unit tests because we can easily create mock versions of the interfaces and the code is now much more flexible. If for example we want to change database drivers we just update the container binding and we are done.

So now that we have successfully moved the responsibility of building these complex objects to the container we also have decoupled our code in the process. 

### License

PHP-IoC is open-sourced software licensed under the [MIT license](https://github.com/scrubmx/php-ioc/blob/master/license.txt)
