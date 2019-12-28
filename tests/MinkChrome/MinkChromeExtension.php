<?php declare(strict_types=1);

namespace Tests\MinkChrome;

use PHPUnit\Runner\BeforeFirstTestHook;
use PHPUnit\Runner\AfterLastTestHook;
use Symfony\Component\Process\Process;

final class MinkChromeExtension implements BeforeFirstTestHook, AfterLastTestHook
{
    protected $serverPort;
    protected $browserPort;

    protected $server;
    protected $browser;

    public function __construct(int $serverPort = 8080, int $browserPort = 9222)
    {
        $this->serverPort = $serverPort;
        $this->browserPort = $browserPort;
    }

    public function executeBeforeFirstTest(): void
    {
        $this->server = new Process([
            '/usr/local/bin/symfony',
            'server:start',
            '--port=' . $this->serverPort,
            // '-d', // Daemon, run with server->run to wait until the server has started
        ]);
        $this->server->start();
        
        $this->browser = new Process([
            '/usr/bin/google-chrome-stable',
            '--disable-gpu',
            '--headless',
            '--remote-debugging-address=0.0.0.0',
            '--remote-debugging-port=' . $this->browserPort,
        ]);
        $this->browser->start();

        // dirty hack yo, but wait some time until both the browser and server have hopefully started
        sleep(3);
    }

    public function executeAfterLastTest(): void
    {
        $this->browser->stop(3, SIGINT);
        $this->server->stop(3, SIGINT);
    }
}
