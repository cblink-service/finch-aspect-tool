<?php

namespace Cblink\Service\FinchAspect\Dto;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

class AspectOrderAttachDto extends BaseAspectDto
{
    protected $fillable = [
        'scene', 'scene_id', 'scene_val',
    ];
}