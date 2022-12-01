<?php

namespace Cblink\Service\FinchAspect\Dto\Product;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property ProductDto[] $products 商品集合
 */
class ProductsDto extends BaseAspectDto
{
    protected $fillable = [
        'products'
    ];

    /**
     * @return ProductDto[]
     */
    public function getProductsData()
    {
        return $this->getFromTranslateCache('products', ProductDto::class);
    }
}