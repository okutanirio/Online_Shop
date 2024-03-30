<?php
namespace App\Consts;

class ProductConst {
    const TYPE_PIARCE   = 1;
    const TYPE_NECKLACE = 2;
    const TYPE_RING     = 3;
    const TYPE_BRACELET = 4;
    const TYPE_LIST = [
        self::TYPE_PIARCE   => 'ピアス', 
        self::TYPE_NECKLACE => 'ネックレス', 
        self::TYPE_RING     => 'リング', 
        self::TYPE_BRACELET => 'ブレスレット', 
    ];
}