<?php

namespace App\Http\Utils;

use Illuminate\Encryption\Encrypter;

class DecryptUtils
{
    private static Encrypter $encrypt;

    public static function configure(): void
    {
        $key = config('credentials.key');
        $cipher = config('credentials.cipher');

        self::$encrypt = new Encrypter($key, $cipher);
    }

    public static function get($key)
    {
        self::configure();
        $env = config('credentials.environment');
        $enc = config("credentials.$env.enc");

        $credentials = self::$encrypt->decrypt($enc);
        return $credentials[$key];
    }

    public static function crypt($array): string
    {
        self::configure();
        return self::$encrypt->encrypt($array);
    }

    public static function decrypt(string $data): array
    {
        self::configure();
        return self::$encrypt->decrypt($data);
    }
}
