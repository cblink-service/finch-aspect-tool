<?php

namespace Cblink\Service\FinchAspect\Dto\Product;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property string $id     品牌ID
 * @property string $name   品牌名称
 * @property string $logo   品牌LOGO
 */
class ProductBrandDto extends BaseAspectDto
{
    protected $fillable = [
        'id', 'name', 'logo',
    ];
}