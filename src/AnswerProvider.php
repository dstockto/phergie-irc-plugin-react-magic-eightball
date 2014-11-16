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
 * Interface for answer providers
 *
 * @category Phergie
 * @package Phergie\Irc\Plugin\React\MagicEightBall
 */
interface AnswerProvider 
{
    /**
     * Retrieves an answer
     *
     * @return string
     */
    public function getAnswer();
}
