<?php declare(strict_types=1);

namespace Madewithlove;

use Http\Adapter\Guzzle6\Client;
use Http\Factory\Guzzle\ServerRequestFactory;
use Madewithlove\HtaccessClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Tester\CommandTester;

final class HtaccessCommandTest extends TestCase
{
    /**
     * @var HtaccessCommand
     */
    private $command;

    public function setUp(): void
    {
        $htaccessClient = new HtaccessClient(
            Client::createWithConfig([
                'headers' => [
                    'User-Agent' => 'HtaccessCli',
                ],
            ]),
            new ServerRequestFactory()
        );

        $this->command = new HtaccessCommand($htaccessClient);
    }

    /** @test */
    public function it does not run without url argument(): void
    {
        $commandTester = new CommandTester($this->command);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Not enough arguments (missing: "url")');
        $commandTester->execute([]);
    }

    /** @test */
    public function it does not run without htaccess file available(): void
    {
        $commandTester = new CommandTester($this->command);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('We could not find an .htaccess file in the current directory');
        $commandTester->execute([
            'url' => 'http://localhost',
        ]);
    }
}
