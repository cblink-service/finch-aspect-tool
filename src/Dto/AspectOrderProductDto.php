<?php

namespace Cblink\Service\FinchAspect\Dto;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property string $product_id 商品ID
 * @property string $product_union_id 商品 Union ID
 * @property string $sku_id 商品SKU ID
 * @property string $sku_union_id 商品SKU Union ID
 * @property string $product_name 商品名称
 * @property string $product_desc 商品描述
 * @property string $sku_name 商品SKU名称
 * @property string $industry 商品行业：default电商，retail 零售/茶饮/餐饮
 * @property string $image 商品封面图片
 * @property string $product_code 商品封面图片
 * @property string $sku_code sku编码
 * @property int $product_status 商品状态：1在售，2仓库中，3下架
 * @property int $product_type 商品类型：1实物，3虚拟
 * @property int $group_id 商品分组ID
 * @property int $price 商品单价（包含附加品金额）
 * @property int $point 商品积分
 * @property int $stock 商品库存
 * @property int $num 需要购买的数量
 * @property int $additional_price 附加品金额
 * @property int $additional_total_fee 商品小计附加品金额
 * @property int $total_point 商品小计积分
 * @property int $total_fee 商品小计金额
 * @property int $discount_total_fee 商品合计优惠金额
 * @property string|null $cart_id 购物车ID
 * @property AspectOrderProductAdditionalDto[] $additional 附加品信息
 * @property AspectDiscountDto[] $discount 商品折扣信息（针对单行商品）
 */
class AspectOrderProductDto extends BaseAspectDto
{
    protected $fillable = [
        'product_id',
        'product_union_id',
        'sku_id',
        'sku_union_id',
        'product_name',
        'product_desc',
        'sku_name',
        'industry',
        'image',
        'product_code',
        'sku_code',
        'product_status',
        'product_type',
        'group_id',
        'price',
        'point',
        'stock',
        'num',
        'additional_price',
        'additional_total_fee',
        'total_point',
        'total_fee',
        'discount_total_fee',
        'additional',
        'discount',
        'cart_id',
        'attach',
    ];

    public function getData()
    {
        return [
            'product_id' => $this->getItem('product_id'),
            'product_union_id' => $this->getItem('product_union_id'),
            'sku_id' => $this->getItem('sku_id'),
            'sku_union_id' => $this->getItem('sku_union_id'),
            'product_name' => $this->getItem('product_name'),
            'product_desc' => $this->getItem('product_desc'),
            'sku_name' => $this->getItem('sku_name'),
            'industry' => $this->getItem('industry'),
            'image' => $this->getItem('image'),
            'product_code' => $this->getItem('product_code'),
            'sku_code' => $this->getItem('sku_code'),
            'product_status' => (int) $this->getItem('product_status'),
            'product_type' => (int) $this->getItem('product_type'),
            'group_id' => (int) $this->getItem('group_id', 0),
            'price' => (int) $this->getItem('price', 0),
            'point' => (int) $this->getItem('point', 0),
            'stock' => (int) $this->getItem('stock', 0),
            'num' => (int) $this->getItem('num', 0),
            'additional_price' => (int) $this->getItem('additional_price', 0),
            'additional_total_fee' => (int) $this->getItem('additional_total_fee', 0),
            'total_point' => (int) $this->getItem('total_point', 0),
            'total_fee' => (int) $this->getItem('total_fee', 0),
            'discount_total_fee' => (int) $this->getItem('discount_total_fee', 0),
            'additional' => $this->getAdditionalData(),
            'discount' => $this->getDiscountData(),
        ];
    }

    /**
     * @return AspectOrderProductDto[]
     */
    public function getAdditionalData()
    {
        return $this->getFromTranslateCache(
            'additional',
            AspectOrderProductAdditionalDto::class
        );
    }

    /**
     * @return AspectOrderProductDto[]
     */
    public function getDiscountData()
    {
        return $this->getFromTranslateCache(
            'discount',
            AspectDiscountDto::class
        );
    }

    /**
     * @return AspectOrderProductDto[]
     */
    public function getAttachData()
    {
        return $this->getFromTranslateCache(
            'attach',
            AspectOrderAttachDto::class
        );
    }

    /**
     * @param string $scene
     * @param string $sceneId
     * @param string|float|int|null $sceneVal
     * @return $this|AspectOrderDto
     */
    public function appendAttach(string $scene, string $sceneId, string|float|int|null $sceneVal = null)
    {
        if ($sceneVal == "") {
            return $this;
        }

        return $this->appendData('attach', [
            'scene' => $scene,
            'scene_id' => $sceneId,
            'scene_val' => (string) $sceneVal,
        ]);
    }
}