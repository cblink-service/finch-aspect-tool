<?php

namespace Cblink\Service\FinchAspect\Dto;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property string $name 折扣名称
 * @property string $discount_fee 折扣金额
 * @property string $type 优惠类型：1优惠券，2红包，3促销，4会员
 * @property string $ext_id 关联的促销活动ID或优惠券ID
 */
class AspectDiscountDto  extends BaseAspectDto
{
    protected $fillable = [
        'name',
        'discount_fee',
        'type',
        'ext_id',
    ];
}