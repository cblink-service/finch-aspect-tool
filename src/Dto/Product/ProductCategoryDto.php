<?php

namespace Cblink\Service\FinchAspect\Dto\Product;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property string $id     品牌ID
 * @property string $name   分类名称
 * @property string $logo   分类图片
 */
class ProductCategoryDto extends BaseAspectDto
{
    protected $fillable = [
        'id', 'name', 'image',
    ];
}