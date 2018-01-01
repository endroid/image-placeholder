<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\ImagePlaceholderBundle\Exception;

use Exception;

class InvalidProviderException extends Exception
{
    /**
     * Creates a new instance.
     *
     * @param string    $name
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($name, $code = 0, Exception $previous = null)
    {
        $message = sprintf('Invalid image provider "%s"', $name);

        parent::__construct($message, $code, $previous);
    }
}
