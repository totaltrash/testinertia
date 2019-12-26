<?php

namespace Tests\Mink;

use Behat\Mink\Mink;
use Behat\Mink\Session;
use Tests\Mink\TestCase;
use Lctrs\MinkPantherDriver\PantherDriver;
use Symfony\Component\Process\Process;
use Tests\Config\Web\Assert;

class HomeTest extends TestCase
{
    public function testMyApp(): void
    {
        // $mink = new Mink([
        //     'panther' => new Session(
        //         PantherDriver::createChromeDriver('/usr/bin/google-chrome', ['some', 'arguments'], ['scheme' => 'https'])
        //     ),
        // ]);
        $process = new Process(['/usr/local/bin/symfony', 'server:start', '-d']);
        $process->run();

        // foreach ($process as $type => $data) {
        //     if ($process::OUT === $type) {
        //         echo "\nRead from stdout: ".$data;
        //     } else { // $process::ERR === $type
        //         echo "\nRead from stderr: ".$data;
        //     }
        // }

        // echo $process->getOutput();

        // $this->session = new Session(
        //     PantherDriver::createChromeDriver('/usr/bin/google-chrome-stable', [], [])
        // );
        $mink = new Mink([
            'panther' => new Session(
                // PantherDriver::createChromeDriver('/usr/bin/google-chrome-stable', ['some', 'arguments'], ['scheme' => 'https'])
                PantherDriver::createChromeDriver()
            ),
        ]);
        $this->session = $mink->getSession('panther');

        $this->session->start();
        $this->session->visit('http://127.0.0.1:8000/');
        $this->assert = new Assert($this->session);
        $this->assert->responseContains('Testing propValue');
        $process = new Process(['/usr/local/bin/symfony', 'server:stop']);
        $process->run();
    }
}
