<?php

namespace Tests\Panther;

use Symfony\Component\Panther\PantherTestCase;

class HomeTest extends PantherTestCase
{
    public function testMyApp(): void
    {
        $client = static::createPantherClient(); // Your app is automatically started using the built-in web server
        $client->request('GET', '/');

        // Use any PHPUnit assertion, including the ones provided by Symfony
        $this->assertSelectorTextContains('#my-para', 'Testing propValue');
    }
}
