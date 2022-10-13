<?php

namespace Cblink\Service\FinchAspect\Dto;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property string $mobile     收货手机号
 * @property string $name       收货人信息
 * @property string $province   省份
 * @property string $city       城市
 * @property string $district   区/县
 * @property string $street     街道
 * @property string $address    详细地址
 * @property string $lng        经度
 * @property string $lat        纬度
 */
class AspectOrderAddressDto extends BaseAspectDto
{
    protected $fillable = [
        'mobile',
        'name',
        'province',
        'city',
        'district',
        'street',
        'address',
        'lng',
        'lat',
    ];
}