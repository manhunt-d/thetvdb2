<?php

namespace Adrenth\Thetvdb\Exception;

/**
 * Class CouldNotAddFavoriteException
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Exception
 * @author   A. Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class CouldNotAddFavoriteException extends \InvalidArgumentException
{
    /**
     * @param string $message
     * @return static
     */
    public static function reason($message)
    {
        return new static('Could not add favorite: ' . $message);
    }
}
