<?php

namespace Cblink\Service\FinchAspect\Dto\Order;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property string $name   附加费用名称
 * @property int $additional_fee    附加费用金额
 * @property int $type  附加类型
 * @property int|string|null $ext_id    扩展ID
 */
class OrderAdditionalDto extends BaseAspectDto
{
    protected $fillable = [
        'name',
        'additional_fee',
        'type',
        'ext_id',
    ];
}