<?php

namespace Cblink\Service\FinchAspect\Dto\Order;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * 运费模版
 *
 * @property int $type 计费类型，1固定运费，2模版运费
 * @property int $template_id 运费模版ID
 * @property int $price 运费金额，单位分
 */
class OrderProductFreightTemplateDto extends BaseAspectDto
{
    protected $fillable = [
        'type', 'template_id', 'price',
    ];
}