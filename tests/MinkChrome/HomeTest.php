<?php

namespace Tests\MinkChrome;

use Behat\Mink\Mink;
use Behat\Mink\Session;
use DMore\ChromeDriver\ChromeDriver;
use Symfony\Component\Process\Process;
use Tests\Config\Web\Assert;

class HomeTest extends TestCase
{
    public function ztestHome(): void
    {
        $this->session = new Session(new ChromeDriver(
            'http://localhost:9222',
            null,
            'http://127.0.0.1:8080'
        ));

        $this->session->start();
        $this->session->visit('http://127.0.0.1:8080/');
        $this->assert = new Assert($this->session);
        $this->assert->responseContains('Testing propValue');
    }

    public function testAgain(): void
    {
        $this->session = new Session(new ChromeDriver(
            'http://localhost:9222',
            null,
            'http://127.0.0.1:8080'
        ));

        $this->session->start();
        $this->session->visit('http://127.0.0.1:8080/');
        $this->assert = new Assert($this->session);
        // sleep(2);
        // $this->assert->statusCodeEquals(200);
        $this->assert->elementExists('css', 'p#my-para');
        $this->assert->elementContains('css', 'p#my-para', 'Testing propValue');

        $page = $this->session->getPage();

        //$page->clickLink('Items');
        $link = $page->find('css', 'nav div.v-list-item__title:contains("Items")');
        // $link = $link->getParent()->getParent();
        $link->click();
        sleep(1);
        $this->assert->elementNotExists('css', 'p#my-para');

    }
}
