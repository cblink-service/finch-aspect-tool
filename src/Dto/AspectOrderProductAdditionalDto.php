<?php

namespace Cblink\Service\FinchAspect\Dto;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property string $union_id
 * @property string $name
 * @property int $num
 * @property int $price
 * @property int $type
 * @property int $price_type
 */
class AspectOrderProductAdditionalDto extends BaseAspectDto
{
    protected $fillable = [
        'union_id',
        'name',
        'num',
        'price',
        'type',
        'price_type',
        'label',
    ];
}