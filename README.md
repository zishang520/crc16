# CRC16

Default support: `ccittfalse`, `arc`, `augccitt`, `buypass`, `cdma2000`, `dds110`, `dectr`, `dectx`, `dnp`, `en13757`, `genibus`, `maxim`, `mcrf4xx`, `riello`, `t10dif`, `teledisk`, `tms37157`, `usb`, `a`, `kermit`, `modbus`, `x25`, `xmodem`

### Installation package
```bash
composer require luoyy/crc16
```

### Quick Sample Usage
```php
/**
 * DEMO
 */
use luoyy\Crc16\Crc16;

var_dump(Crc16::make(Crc16::HEX, 'ABCD', Crc16::MODBUS));
var_dump(Crc16::dechex(Crc16::make(Crc16::HEX, 'ABCD', Crc16::MODBUS), true)); // The little-endian byte order used by the C language by default.
var_dump(Crc16::make(Crc16::STRING, 'ABCD', Crc16::A));
// If you need custom polynomial:
var_dump(Crc16::string('test', 0x0001, 0x0001, 0x0001, false, false));
var_dump(Crc16::hex('ABCD', 0x0001, 0x0001, 0x0001, false, false));
// Next, use your abilities.
```
