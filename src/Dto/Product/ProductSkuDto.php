<?php

namespace Cblink\Service\FinchAspect\Dto\Product;

use Cblink\Service\FinchAspect\Dto\Order\OrderAddressDto;
use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property string $id         SKU ID
 * @property string $union_id   SKU UNION ID
 * @property string $name       SKU名称
 * @property array $code        SKU CODE
 * @property string $sku_code   商品编码
 * @property string $image      sku图片
 * @property numeric $price     价格，单位元
 * @property numeric $cost_price 成本价，单位元
 * @property numeric $origin_price 原价，单位元
 * @property numeric $weight    重量，单位千克
 * @property int $stock         库存数
 * @property ProductDiscountDto $discount 优惠信息
 */
class ProductSkuDto extends BaseAspectDto
{
    protected $fillable = [
        'id', 'union_id', 'name', 'code', 'sku_code', 'image',
        'price', 'cost_price', 'origin_price', 'weight', 'stock', 'discount',
    ];

    /**
     * @return OrderAddressDto
     */
    public function getDiscountData()
    {
        return $this->getFromCache('discount', function () {
            return new OrderAddressDto($this->getItem('discount'));
        });
    }
}