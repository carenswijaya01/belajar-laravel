<?php

namespace App\Data;

class Bar
{

  public Foo $foo; // Dependency Injection

  public function __construct(Foo $foo)
  {
    $this->foo = $foo;
  }

  public function bar(): string
  {
    return $this->foo->foo() . " and Bar";
  }
}
