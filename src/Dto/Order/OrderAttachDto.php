<?php

namespace Cblink\Service\FinchAspect\Dto\Order;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * 附加信息
 *
 * @property string $scene       场景信息
 * @property string $scene_id    场景ID
 * @property string $scene_val   场景值
 */
class OrderAttachDto extends BaseAspectDto
{
    protected $fillable = [
        'scene', 'scene_id', 'scene_val',
    ];
}