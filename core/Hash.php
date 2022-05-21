<?php

namespace Core;

class Hash
{
    private static array $uppers = [
      'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
      'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
    ];

    private static array $lowers = [
      'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
       'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    ];

    private static array $numbers = [
      '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
    ];

    public static function make(string $input): string
    {
        return sha1($input);
    }

    public static function generate($length = 8): string
    {
        $arr = array_merge(self::$uppers, self::$lowers, self::$numbers);
        shuffle($arr);

        return substr(implode('', $arr), 0, $length);
    }
}
