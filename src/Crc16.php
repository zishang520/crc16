<?php

namespace luoyy\Crc16;

use Generator;
use luoyy\Crc16\Enums\Metatype;
use luoyy\Crc16\Enums\Polynomial;

class Crc16
{
    public const HEX = Metatype::HEX;

    public const STRING = Metatype::STRING;

    public const CCITTFALSE = Polynomial::CCITTFALSE;

    public const ARC = Polynomial::ARC;

    public const AUGCCITT = Polynomial::AUGCCITT;

    public const BUYPASS = Polynomial::BUYPASS;

    public const CDMA2000 = Polynomial::CDMA2000;

    public const DDS110 = Polynomial::DDS110;

    public const DECTR = Polynomial::DECTR;

    public const DECTX = Polynomial::DECTX;

    public const DNP = Polynomial::DNP;

    public const EN13757 = Polynomial::EN13757;

    public const GENIBUS = Polynomial::GENIBUS;

    public const MAXIM = Polynomial::MAXIM;

    public const MCRF4XX = Polynomial::MCRF4XX;

    public const RIELLO = Polynomial::RIELLO;

    public const T10DIF = Polynomial::T10DIF;

    public const TELEDISK = Polynomial::TELEDISK;

    public const TMS37157 = Polynomial::TMS37157;

    public const USB = Polynomial::USB;

    public const A = Polynomial::A;

    public const KERMIT = Polynomial::KERMIT;

    public const MODBUS = Polynomial::MODBUS;

    public const X25 = Polynomial::X25;

    public const XMODEM = Polynomial::XMODEM;

    protected const REVERSE_CHAR_MAP = [
        0x00, 0x80, 0x40, 0xC0, 0x20, 0xA0, 0x60, 0xE0, 0x10, 0x90, 0x50, 0xD0, 0x30, 0xB0, 0x70, 0xF0,
        0x08, 0x88, 0x48, 0xC8, 0x28, 0xA8, 0x68, 0xE8, 0x18, 0x98, 0x58, 0xD8, 0x38, 0xB8, 0x78, 0xF8,
        0x04, 0x84, 0x44, 0xC4, 0x24, 0xA4, 0x64, 0xE4, 0x14, 0x94, 0x54, 0xD4, 0x34, 0xB4, 0x74, 0xF4,
        0x0C, 0x8C, 0x4C, 0xCC, 0x2C, 0xAC, 0x6C, 0xEC, 0x1C, 0x9C, 0x5C, 0xDC, 0x3C, 0xBC, 0x7C, 0xFC,
        0x02, 0x82, 0x42, 0xC2, 0x22, 0xA2, 0x62, 0xE2, 0x12, 0x92, 0x52, 0xD2, 0x32, 0xB2, 0x72, 0xF2,
        0x0A, 0x8A, 0x4A, 0xCA, 0x2A, 0xAA, 0x6A, 0xEA, 0x1A, 0x9A, 0x5A, 0xDA, 0x3A, 0xBA, 0x7A, 0xFA,
        0x06, 0x86, 0x46, 0xC6, 0x26, 0xA6, 0x66, 0xE6, 0x16, 0x96, 0x56, 0xD6, 0x36, 0xB6, 0x76, 0xF6,
        0x0E, 0x8E, 0x4E, 0xCE, 0x2E, 0xAE, 0x6E, 0xEE, 0x1E, 0x9E, 0x5E, 0xDE, 0x3E, 0xBE, 0x7E, 0xFE,
        0x01, 0x81, 0x41, 0xC1, 0x21, 0xA1, 0x61, 0xE1, 0x11, 0x91, 0x51, 0xD1, 0x31, 0xB1, 0x71, 0xF1,
        0x09, 0x89, 0x49, 0xC9, 0x29, 0xA9, 0x69, 0xE9, 0x19, 0x99, 0x59, 0xD9, 0x39, 0xB9, 0x79, 0xF9,
        0x05, 0x85, 0x45, 0xC5, 0x25, 0xA5, 0x65, 0xE5, 0x15, 0x95, 0x55, 0xD5, 0x35, 0xB5, 0x75, 0xF5,
        0x0D, 0x8D, 0x4D, 0xCD, 0x2D, 0xAD, 0x6D, 0xED, 0x1D, 0x9D, 0x5D, 0xDD, 0x3D, 0xBD, 0x7D, 0xFD,
        0x03, 0x83, 0x43, 0xC3, 0x23, 0xA3, 0x63, 0xE3, 0x13, 0x93, 0x53, 0xD3, 0x33, 0xB3, 0x73, 0xF3,
        0x0B, 0x8B, 0x4B, 0xCB, 0x2B, 0xAB, 0x6B, 0xEB, 0x1B, 0x9B, 0x5B, 0xDB, 0x3B, 0xBB, 0x7B, 0xFB,
        0x07, 0x87, 0x47, 0xC7, 0x27, 0xA7, 0x67, 0xE7, 0x17, 0x97, 0x57, 0xD7, 0x37, 0xB7, 0x77, 0xF7,
        0x0F, 0x8F, 0x4F, 0xCF, 0x2F, 0xAF, 0x6F, 0xEF, 0x1F, 0x9F, 0x5F, 0xDF, 0x3F, 0xBF, 0x7F, 0xFF,
    ];

    /**
     * @param Metatype $type 输入数据类型：Metatype::STRING、Metatype::HEX
     * @param string $str 待校验值
     * @param Polynomial $polynomials 参数
     * @throw \InvalidArgumentException
     */
    public static function make(Metatype $type, string $str, Polynomial $polynomials = Polynomial::DEFAULT): int
    {
        return call_user_func([self::class, $type->value], $str, ...$polynomials->option());
    }

    /**
     * @param string $hex 待校验16进制字符串
     * @param int $polynomial 二项式
     * @param int $initValue 初始值
     * @param int $xOrValue 输出结果前异或的值
     * @param bool $inputReverse 输入字符串是否每个字节按比特位反转
     * @param bool $outputReverse 输出是否整体按比特位反转
     */
    public static function hex(string $hex, int $polynomial, int $initValue, int $xOrValue, bool $inputReverse = false, bool $outputReverse = false): int
    {
        $crc = $initValue;
        foreach (self::makeStr($hex, 2) as $s) {
            $o = hexdec((string) $s);
            // 输入数据每个字节按比特位逆转
            $c = $inputReverse ? self::REVERSE_CHAR_MAP[$o] : $o;
            $crc ^= ($c << 8);
            for ($j = 0; $j < 8; ++$j) {
                $crc = ($crc & 0x8000) ? ((($crc << 1) & 0xFFFF) ^ $polynomial) : (($crc << 1) & 0xFFFF);
            }
        }
        if ($outputReverse) {
            // 把低地址存低位，即采用小端法将整数转换为字符串
            // 输出结果按比特位逆转整个字符串
            // 再把结果按小端法重新转换成整数
            [, $crc] = unpack('v', self::reverseString(pack('cc', $crc & 0xFF, ($crc >> 8) & 0xFF)));
        }
        return $crc ^ $xOrValue;
    }

    /**
     * @param string $str 待校验字符串
     * @param int $polynomial 二项式
     * @param int $initValue 初始值
     * @param int $xOrValue 输出结果前异或的值
     * @param bool $inputReverse 输入字符串是否每个字节按比特位反转
     * @param bool $outputReverse 输出是否整体按比特位反转
     */
    public static function string(string $str, int $polynomial, int $initValue, int $xOrValue, bool $inputReverse = false, bool $outputReverse = false): int
    {
        $crc = $initValue;
        foreach (self::makeStr($str, 1) as $s) {
            // 输入数据每个字节按比特位逆转
            $c = $inputReverse ? self::REVERSE_CHAR_MAP[ord((string) $s)] : ord((string) $s);
            $crc ^= ($c << 8);
            for ($j = 0; $j < 8; ++$j) {
                $crc = ($crc & 0x8000) ? ((($crc << 1) & 0xFFFF) ^ $polynomial) : (($crc << 1) & 0xFFFF);
            }
        }
        if ($outputReverse) {
            // 把低地址存低位，即采用小端法将整数转换为字符串
            // 输出结果按比特位逆转整个字符串
            // 再把结果按小端法重新转换成整数
            [, $crc] = unpack('v', self::reverseString(pack('cc', $crc & 0xFF, ($crc >> 8) & 0xFF)));
        }
        return $crc ^ $xOrValue;
    }

    /**
     * 输出hex数据.
     * @copyright (c) zishang520 All Rights Reserved
     * @param int $crc int校验值
     * @param bool $outputReverse 是否反转值，大端序小端序
     * @return string 输出的hex校验值
     */
    public static function dechex(int $crc, $outputReverse = false): string
    {
        // n   无符号短整型(16位，大端字节序)
        // v   无符号短整型(16位，小端字节序)
        return bin2hex(pack($outputReverse ? 'v' : 'n', $crc));
    }

    /**
     * 将一个字节流按比特位反转 eg: 'AB'(01000001 01000010)  --> '\x42\x82'(01000010 10000010).
     */
    protected static function reverseString(string $str): string
    {
        $m = 0;
        $n = strlen($str) - 1;
        while ($m <= $n) {
            if ($m == $n) {
                $str[$m] = self::reverseChar($str[$m]);
                break;
            }
            [$str[$m], $str[$n]] = [self::reverseChar($str[$n]), self::reverseChar($str[$m])];
            ++$m;
            --$n;
        }
        return $str;
    }

    /**
     * 将一个字符按比特位进行反转 eg: 65 (01000001) --> 130(10000010).
     */
    protected static function reverseChar(string $char): string
    {
        return chr(self::REVERSE_CHAR_MAP[ord($char)]);
        // $byte = ord($char);
        // $byte = ($byte & 0x55) << 1 | ($byte & 0xAA) >> 1;
        // $byte = ($byte & 0x33) << 2 | ($byte & 0xCC) >> 2;
        // $byte = ($byte & 0x0F) << 4 | ($byte & 0xF0) >> 4;
        // return chr($byte);
    }

    /**
     * 字符串生成器.
     * @copyright (c) zishang520 All Rights Reserved
     */
    protected static function makeStr(string $str, int $len = 1): Generator
    {
        yield from str_split($str, $len);
    }
}
