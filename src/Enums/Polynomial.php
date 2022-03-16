<?php

namespace luoyy\Crc16\Enums;

enum Polynomial
{
    case CCITTFALSE;
    case ARC;
    case AUGCCITT;
    case BUYPASS;
    case CDMA2000;
    case DDS110;
    case DECTR;
    case DECTX;
    case DNP;
    case EN13757;
    case GENIBUS;
    case MAXIM;
    case MCRF4XX;
    case RIELLO;
    case T10DIF;
    case TELEDISK;
    case TMS37157;
    case USB;
    case A;
    case KERMIT;
    case MODBUS;
    case X25;
    case XMODEM;

    const DEFAULT = Polynomial::ARC;

    /**
     * 获取选项.
     * @copyright (c) zishang520 All Rights Reserved
     * @return array<int, int|bool>
     */
    public function option(): array
    {
        return match ($this) {
            Polynomial::CCITTFALSE => [0x1021, 0xFFFF, 0x0000, false, false],
            Polynomial::ARC => [0x8005, 0x0000, 0x0000, true, true],
            Polynomial::AUGCCITT => [0x1021, 0x1D0F, 0x0000, false, false],
            Polynomial::BUYPASS => [0x8005, 0x0000, 0x0000, false, false],
            Polynomial::CDMA2000 => [0xC867, 0xFFFF, 0x0000, false, false],
            Polynomial::DDS110 => [0x8005, 0x800D, 0x0000, false, false],
            Polynomial::DECTR => [0x0589, 0x0000, 0x0001, false, false],
            Polynomial::DECTX => [0x0589, 0x0000, 0x0000, false, false],
            Polynomial::DNP => [0x3D65, 0x0000, 0xFFFF, true, true],
            Polynomial::EN13757 => [0x3D65, 0x0000, 0xFFFF, false, false],
            Polynomial::GENIBUS => [0x1021, 0xFFFF, 0xFFFF, false, false],
            Polynomial::MAXIM => [0x8005, 0x0000, 0xFFFF, true, true],
            Polynomial::MCRF4XX => [0x1021, 0xFFFF, 0x0000, true, true],
            Polynomial::RIELLO => [0x1021, 0xB2AA, 0x0000, true, true],
            Polynomial::T10DIF => [0x8BB7, 0x0000, 0x0000, false, false],
            Polynomial::TELEDISK => [0xA097, 0x0000, 0x0000, false, false],
            Polynomial::TMS37157 => [0x1021, 0x89EC, 0x0000, true, true],
            Polynomial::USB => [0x8005, 0xFFFF, 0xFFFF, true, true],
            Polynomial::A => [0x1021, 0xC6C6, 0x0000, true, true],
            Polynomial::KERMIT => [0x1021, 0x0000, 0x0000, true, true],
            Polynomial::MODBUS => [0x8005, 0xFFFF, 0x0000, true, true],
            Polynomial::X25 => [0x1021, 0xFFFF, 0xFFFF, true, true],
            Polynomial::XMODEM => [0x1021, 0x0000, 0x0000, false, false],
        };
    }
}
