<?php

namespace Cblink\Service\FinchAspect\Dto\Product;

use Cblink\Service\FinchAspect\Dto\Order\OrderAddressDto;
use Cblink\Service\FinchAspect\Dto\Order\OrderProductDto;
use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property string $id 商品ID
 * @property string $union_id 商品Union id
 * @property string $supplier_id 供应商ID
 * @property int $channel 商品渠道/来源
 * @property string $name 商品名称
 * @property string $image 商品封面图片
 * @property string $product_code 商品编码
 * @property string $industry 商品行业
 * @property int $product_type 商品类型
 * @property int $is_addons 是否包含附加品
 * @property string $desc 商品简介
 * @property int $sku_type sku类型
 * @property int $sort 商品序号
 * @property int $status 商品状态
 * @property numeric $price 最小价格，单位元
 * @property numeric $max_price 最大价格，单位元
 * @property string $origin 划线价（文本）
 * @property int $point 积分
 * @property array|ProductBrandDto $brand 品牌信息
 * @property array $category 分类信息
 * @property ProductSkuDto[] $sku sku信息
 * @property ProductDiscountDto $discount 优惠信息
 * @property ProductSalesmanDto|null $salesman_price 佣金价格
 */
class ProductDto extends BaseAspectDto
{
    protected $fillable = [
        "id", "union_id", 'supplier_id', 'channel', "name", "image", "product_code", "industry", "product_type", "is_addons", "desc",
        "sku_type", "sort", "status", "price", "max_price", "origin", "brand", "category", 'sku', 'discount', 'salesman_price', 'point',
    ];

    /**
     * @return OrderProductDto[]
     */
    public function getSkuData()
    {
        return $this->getFromTranslateCache(
            'sku',
            ProductSkuDto::class
        );
    }

    /**
     * @return ProductCategoryDto[]
     */
    public function getCategoryData()
    {
        return $this->getFromTranslateCache(
            'category',
            ProductCategoryDto::class
        );
    }

    /**
     * @return ProductBrandDto
     */
    public function getBrandData()
    {
        return $this->getFromCache('brand', function () {
            return new ProductBrandDto($this->getItem('brand'));
        });
    }

    /**
     * @return ProductDiscountDto
     */
    public function getDiscountData()
    {
        return $this->getFromCache('discount', function () {
            return new ProductDiscountDto($this->getItem('discount'));
        });
    }
}