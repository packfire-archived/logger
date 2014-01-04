<?php
/**
* Packfire Logger
* By Sam-Mauris Yong
*
* Released open source under New BSD 3-Clause License.
* Copyright (c) Sam-Mauris Yong <sam@mauris.sg>
* All rights reserved.
*/

namespace Packfire\Logger\Format;

/**
 * Standard class
 *
 * The standard formatting for log entries
 *
 * @author Sam-Mauris Yong / sam@mauris.sg
 * @copyright Copyright (c) 2013 Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Logger\Format
 * @since 1.0.0
 */
class Standard implements FormatInterface
{
    public function format($level, $message, array $context = array())
    {
        return date('d M Y h:i.s O') . ' [' . $level . '] "'
                . addslashes($message) . '"' . ($context ? ' ' . str_replace("\n", '', var_export($context, true)) : '');
    }
}
