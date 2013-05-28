<?php
/**
* Packfire Logger
* By Sam-Mauris Yong
*
* Released open source under New BSD 3-Clause License.
* Copyright (c) Sam-Mauris Yong <sam@mauris.sg>
* All rights reserved.
*/

namespace Packfire\Logger;

use Packfire\Logger\Format\Standard;
use Psr\Log\AbstractLogger;
use Packfire\Logger\Format\FormatInterface;

/**
 * File class
 *
 * Provide standard logging to a log file
 *
 * @author Sam-Mauris Yong / sam@mauris.sg
 * @copyright Copyright (c) 2013 Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Logger
 * @since 1.0.0
 */
class File extends AbstractLogger
{

    /**
     * Unlimited file size
     */
    const SIZE_UNLIMITED = -1;

    /**
     * The log file to write to
     * @var string
     * @since 1.0.0
     */
    protected $file;

    /**
     * The format of the log output
     * @var Packfire\Logger\Format\FormatInterface
     * @since 1.0.0
     */
    protected $format;

    /**
     * The maximum size of a log file
     * @var integer
     * @since 1.0.0
     */
    protected $maxSize;

    public function __construct(
        $file,
        FormatInterface $format = null,
        $maxFileSize = self::SIZE_UNLIMITED
    ) {
        if (!$file) {
            throw new \InvalidArgumentException('File parameter is invalid in creating a file logger.');
        }
        if (!$format) {
            $format = new Standard();
        }

        $this->file = $file;
        $this->format = $format;
        $this->maxSize = $maxFileSize;
    }

    public function format()
    {
        return $this->format;
    }

    public function maxSize()
    {
        return $this->maxSize;
    }

    public function file()
    {
        return $this->file;
    }

    public function log($level, $message, array $context = array())
    {
        $this->write($this->format->format($level, $message, $context) . "\n");
    }

    protected function write($text)
    {
        $file = $this->file;

        if ($this->maxSize !== self::SIZE_UNLIMITED) {
            $inc = 0;
            $pathinfo = pathinfo($file);
            $ext = isset($pathinfo['extension']) ? '.' . $pathinfo['extension'] : '';
            while (file_exists($file) && filesize($file) > $this->maxSize) {
                ++$inc;
                $file = $pathinfo['dirname'] . '/' . $pathinfo['basename']
                 . '-' . $inc . $ext;
            }
        }

        $fh = fopen($file, 'a');
        fwrite($fh, $text);
        fclose($fh);
    }
}
