<?php

namespace Tests\Panther;

use Symfony\Component\Panther\PantherTestCase;

class HomeTest extends PantherTestCase
{
    public function testMyApp(): void
    {
        
        $client = static::createPantherClient(); // Your app is automatically started using the built-in web server
        // $kernel = static::createKernel();
        // $container = self::$container;
        $client->request('GET', '/');

        // Use any PHPUnit assertion, including the ones provided by Symfony
        $this->assertSelectorTextContains('#my-para', 'Testing propValue');
        $client->clickLink('Items');

        $client->waitFor('#items_table');
        $this->assertSelectorTextContains('#items_table', 'Television');
        $this->assertSelectorTextNotContains('#items_table', 'Books');
    }
}
