<?php

namespace Pergie\Irc\Tests\Plugin\React\MagicEightBall;

use Phergie\Irc\Plugin\React\MagicEightBall\EightballProvider;

class EightballProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testProviderImplementsAnswerProvider()
    {
        $this->assertInstanceOf('Phergie\Irc\Plugin\React\MagicEightBall\AnswerProvider', new EightballProvider());
    }

    public function testGetAnswerReturnsAString()
    {
        $provider = new EightballProvider();
        $this->assertInternalType('string', $provider->getAnswer());
    }
}
