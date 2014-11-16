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

/**
 * Provides answers for the magic eight ball
 *
 * @category Phergie
 * @package Phergie\Irc\Plugin\React\MagicEightBall
 */
class EightballProvider implements AnswerProvider
{
    protected $answers = array(
        'It is certain',
        'It is decidedly so',
        'Without a doubt',
        'Yes definitely',
        'You may rely on it',
        'As I see it, yes',
        'Most likely',
        'Outlook good',
        'Yes',
        'Signs point to yes',
        'Reply hazy try again',
        'Ask again later',
        'Better not tell you now',
        'Cannot predict now',
        'Concentrate and ask again',
        "Don't count on it",
        'My reply is no',
        'My sources say no',
        'Outlook not so good',
        'Very doubtful',
    );

    /**
     * Retrieves an answer
     *
     * @return string
     */
    public function getAnswer()
    {
        $answerIndex = array_rand($this->answers);
        return $this->answers[$answerIndex];
    }
}
