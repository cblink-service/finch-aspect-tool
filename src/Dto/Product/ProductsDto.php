<?php

namespace Cblink\Service\FinchAspect\Dto\Product;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property ProductDto[] $products 商品集合
 * @property array $meta meta信息
 */
class ProductsDto extends BaseAspectDto
{
    protected $fillable = [
        'products',
        'meta',
    ];

    /**
     * @return ProductDto[]
     */
    public function getProductsData()
    {
        return $this->getFromTranslateCache('products', ProductDto::class);
    }
}