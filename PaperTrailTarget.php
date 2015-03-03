<?php
/**
 * @link https://github.com/fernandezekiel/yii2-papertrail
 * @copyright Copyright (c) 2015 Ezekiel Fernandez
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace fernandezekiel\papertrail;


use yii\helpers\VarDumper;
use yii\log\Target;

/**
 * Log target class for logging message to papertrail server
 */
class PaperTrailTarget extends Target
{
    /**
     * @var string url of the papertrail server
     */
    public $url = 'logs.papertrailapp.com';
    /**
     * @var int server port of the papertrail server
     */
    public $port;


    /**
     * @inheritdoc
     */
    public function export()
    {
        foreach ($this->messages as $message) {
            list($text, $level, $category, $timestamp) = $message;
            if (!is_string($text)) {
                $text = VarDumper::export($text);
            }
            $this->sendLog($text);
        }
    }

    /**
     * sends the text to the papertrail server
     * @param string $text
     */
    public function sendLog($text)
    {
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        socket_sendto($sock, $text, strlen($text), 0, $this->url, $this->port);
        socket_close($sock);
    }
}
