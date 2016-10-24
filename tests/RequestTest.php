<?php

namespace TechFinancials\Tests;

use TechFinancials\Request;

class RequestTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWrongInitialization()
    {
        new Request(['UnknownProperty' => 'AnyValue']);
    }
}
