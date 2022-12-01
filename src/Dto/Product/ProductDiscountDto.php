<?php

namespace Cblink\Service\FinchAspect\Dto\Product;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property $type 折扣类型，member 会员价，sell 促销价，spike 秒杀价，
 * @property $name 折扣类型，活动名称，
 * @property $price 优惠后的金额，
 * @property $ext_id 活动ID
 */
class ProductDiscountDto extends BaseAspectDto
{
    protected $fillable = [
        'type',
        'name',
        'price',
        'ext_id',
    ];
}