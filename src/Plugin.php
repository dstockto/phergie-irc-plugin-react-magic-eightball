<?php
/**
 * Phergie plugin for Helping users make decisions (https://github.com/dstockto/phergie-irc-plugin-react-magic-eightball)
 *
 * @link https://github.com/dstockto/phergie-irc-plugin-react-magic-eightball for the canonical source repository
 * @copyright Copyright (c) 2014 David Stockton (http://davidstockton.com)
 * @license http://phergie.org/license New BSD License
 * @package Phergie\Irc\Plugin\React\MagicEightBall
 */

namespace Phergie\Irc\Plugin\React\MagicEightBall;

use Phergie\Irc\Bot\React\AbstractPlugin;
use Phergie\Irc\Bot\React\EventQueueInterface as Queue;
use Phergie\Irc\Event\EventInterface as Event;
use Phergie\Irc\Event\UserEvent;

/**
 * Plugin class.
 *
 * @category Phergie
 * @package Phergie\Irc\Plugin\React\MagicEightBall
 */
class Plugin extends AbstractPlugin
{
    /**
     * @var AnswerProvider
     */
    protected $provider;

    public function __construct(AnswerProvider $provider = null)
    {
        if (is_null($provider)) {
            $provider = new EightballProvider();
        }
        $this->provider = $provider;
    }

    /**
     * Returns the events that this plugin listens for
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            'irc.received.privmsg' => 'handleEvent',
        );
    }

    /**
     * Responds with a magic eight ball phrase when asked questions
     *
     * @param \Phergie\Irc\Event\EventInterface $event
     * @param \Phergie\Irc\Bot\React\EventQueueInterface $queue
     */
    public function handleEvent(Event $event, Queue $queue)
    {
        if ($event instanceof UserEvent) {
            $nick = $event->getNick();
            $channel = $event->getSource();
            $params = $event->getParams();
            $text = $params['text'];
            $matched = stripos($text, '8 ball') !== false;
            if ($matched) {
                $msg = $nick . ', the magic 8 ball says "' . $this->getMagicEightBallAnswer() . '"';
                $queue->ircPrivmsg($channel, $msg);
            }
        }
    }

    /**
     * Returns a random, er clairvoyant answer to a given question
     *
     * @return string
     */
    public function getMagicEightBallAnswer()
    {
        return $this->provider->getAnswer();
    }
}
