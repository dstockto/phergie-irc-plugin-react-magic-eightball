<?php
/**
 * Phergie plugin for Helps users make decisions (https://github.com/dstockto/phergie-irc-plugin-react-magic-eightball)
 *
 * @link https://github.com/dstockto/phergie-irc-plugin-react-magic-eightball for the canonical source repository
 * @copyright Copyright (c) 2014 David Stockton (http://davidstockton.com)
 * @license http://phergie.org/license New BSD License
 * @package Phergie\Irc\Plugin\React\MagicEightBall
 */

namespace Pergie\Irc\Tests\Plugin\React\MagicEightBall;

use Phake;
use Phergie\Irc\Bot\React\EventQueueInterface as Queue;
use Phergie\Irc\Plugin\React\MagicEightBall\Plugin;
use Phergie\Irc\Plugin\React\MagicEightBall\AnswerProvider;

/**
 * Tests for the Plugin class.
 *
 * @category Phergie
 * @package Phergie\Irc\Plugin\React\MagicEightBall
 */
class PluginTest extends \PHPUnit_Framework_TestCase
{
    protected $plugin;
    protected $provider;

    function setUp()
    {
        $this->provider = $this->getMockBuilder('Phergie\Irc\Plugin\React\MagicEightBall\AnswerProvider')
            ->getMock();

        $this->plugin = new Plugin($this->provider);
    }

    /**
     * Tests that getSubscribedEvents() returns an array.
     */
    public function testGetSubscribedEvents()
    {
        $this->assertInternalType('array', $this->plugin->getSubscribedEvents());
    }

    public function testPluginListensForPrivMsgEvent()
    {
        $this->assertArrayHasKey('irc.received.privmsg', $this->plugin->getSubscribedEvents());
    }

    public function testNonUserEventDoesNothing()
    {
        $event = $this->getMockBuilder('Phergie\Irc\Event\EventInterface')
            ->getMock();
        $event->expects($this->never())
            ->method('getNick');
        $event->expects($this->never())
            ->method('getSource');
        $event->expects($this->never())
            ->method('getParams');

        $queue = $this->getMockBuilder('Phergie\Irc\Bot\React\EventQueueInterface')
            ->getMock();
        $queue->expects($this->never())
            ->method('ircPrivmsg');

        $this->plugin->handleEvent($event, $queue);
    }

    /**
     * Tests that messages that match the expected phrase will return as expected
     *
     * @param string $nick
     * @param string $source
     * @param string $message
     * @param string $expected
     *
     * @test
     * @dataProvider phraseProvider
     */
    public function userEventWithCorrectPhraseTriggersResponse($nick, $source, $message, $expected)
    {
        $event = $this->getMockBuilder('Phergie\Irc\Event\UserEvent')
            ->getMock();
        $event->expects($this->atLeastOnce())
            ->method('getNick')
            ->willReturn($nick);
        $event->expects($this->atLeastOnce())
            ->method('getSource')
            ->willReturn($source);
        $event->expects($this->atLeastOnce())
            ->method('getParams')
            ->willReturn(['text' => $message]);

        $response = 'Yes';
        $this->provider->expects($this->once())
            ->method('getAnswer')
            ->willReturn($response);

        $queue = $this->getMockBuilder('Phergie\Irc\Bot\React\EventQueueInterface')
            ->getMock();
        $queue->expects($this->once())
            ->method('ircPrivmsg')
            ->with($source, $expected);

        $this->plugin->handleEvent($event, $queue);
    }

    public function phraseProvider()
    {
        return [
            ['bob', '#phergie', 'Magic 8 ball, should I do that?', 'bob, the magic 8 ball says "Yes"'],
            ['frank', '#phpcc', 'Does the 8 ball think PHP supports single inheritance?', 'frank, the magic 8 ball says "Yes"'],
        ];
    }
}
