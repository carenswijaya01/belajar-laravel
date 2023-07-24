<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); // new Foo()
        $foo2 = $this->app->make(Foo::class); // new Foo()

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());

        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person("Carens", "Wijaya");
        });

        $person = $this->app->make(Person::class);

        self::assertEquals('Carens', $person->firstName);
        self::assertEquals('Wijaya', $person->lastName);
        self::assertNotNull($person);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Carens", "Wijaya");
        });

        $person1 = $this->app->make(Person::class); // new Person("Carens", Wijaya"); if not exists
        $person2 = $this->app->make(Person::class); // return existing

        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Carens", "Wijaya");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person

        self::assertSame($person, $person1);
        self::assertSame($person, $person2);
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class); // constructor akan di inject new Foo() dari singleton

        self::assertSame($foo, $bar->foo);
    }

    public function testDependencyInjectionInClosure()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        // $bar di function sebelumnya tidak singleton, sehingga bila dibuat object bar lagi, akan berbeda. Supaya singleton bisa dilakukan seperti biasa, dan bisa menggunakan make(Foo::class) di dalam closure

        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class); // constructor akan di inject new Foo() dari singleton

        self::assertSame($bar1, $bar2);
    }

    public function testHelloService()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        // atau

        // $this->app->singleton(HelloService::class, function ($app) {
        //     return new HelloServiceIndonesia();
        // });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo Carens', $helloService->hello("Carens"));
    }
}
