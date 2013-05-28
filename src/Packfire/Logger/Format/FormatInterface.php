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
 * FormatInterface
 *
 * An abstraaction for formatters
 *
 * @author Sam-Mauris Yong / sam@mauris.sg
 * @copyright Copyright (c) 2013 Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Logger\Format
 * @since 1.0.0
 */
interface FormatInterface
{

    public function format($level, $message, array $context = array());
}
