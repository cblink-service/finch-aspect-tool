<?php

namespace Cblink\Service\FinchAspect\Dto\Order;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;


/**
 * @property string $product_id 商品ID
 * @property string $supplier_id 供应商ID
 * @property int $channel 商品渠道/来源
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
 * @property bool $delivery_status 配送状态， 1可配送，2不可配送
 * @property int $product_type 商品类型：1实物，3虚拟
 * @property int $group_id 商品分组ID
 * @property int $price 商品单价（包含附加品金额）
 * @property int $point 商品积分
 * @property int $stock 商品库存
 * @property int $num 需要购买的数量
 * @property numeric $weight 商品重量，单位千克
 * @property int $calc_price 商品计费单价（包含附加品和商品金额）
 * @property int $addons_price 附加品金额单价
 * @property int $addons_total_fee 商品附加品小计金额
 * @property int $product_total_fee 商品小计金额（不包含附加品）
 * @property int $total_point 商品小计积分
 * @property int $total_fee 商品小计金额
 * @property int $discount_total_fee 商品合计优惠金额
 * @property string|null $cart_id 购物车ID
 * @property OrderProductAddonsDto[] $addons 附加品信息
 * @property OrderDiscountDto[] $discount 商品折扣信息（针对单行商品）
 * @property OrderAttachDto[] $attach 附加品信息
 * @property OrderProductFreightTemplateDto $freight_template 运费模版配置
 */
class OrderProductDto extends BaseAspectDto
{
    protected $fillable = [
        // array
        'addons',
        'attach',
        'discount',
        'freight_template',
        // fillable
        'cart_id',
        'supplier_id',
        'channel',
        'sku_id',
        'sku_union_id',
        'product_id',
        'product_union_id',
        'group_id',
        'product_name',
        'product_desc',
        'sku_name',
        'image',
        'industry',
        'product_type',
        'product_code',
        'sku_code',
        'product_status',
        'delivery_status',
        'num',
        'stock',
        'weight',
        // price
        'point',
        'total_point',
        'price',
        'total_fee',
        'addons_price',
        'addons_total_fee',
        'product_total_fee',
        'calc_price',
        'discount_total_fee',
    ];

    public function getData()
    {
        return [
            'product_id' => $this->getItem('product_id'),
            'product_union_id' => $this->getItem('product_union_id'),
            'supplier_id' => $this->getItem('supplier_id'),
            'sku_id' => $this->getItem('sku_id'),
            'sku_union_id' => $this->getItem('sku_union_id'),
            'cart_id' => $this->getItem('cart_id'),
            'product_name' => $this->getItem('product_name'),
            'product_desc' => $this->getItem('product_desc'),
            'sku_name' => $this->getItem('sku_name'),
            'industry' => $this->getItem('industry'),
            'channel' => $this->getItem('channel'),
            'image' => $this->getItem('image'),
            'product_code' => $this->getItem('product_code'),
            'sku_code' => $this->getItem('sku_code'),
            'product_status' => (int) $this->getItem('product_status'),
            'delivery_status' => (int) $this->getItem('delivery_status', 1),
            'product_type' => (int) $this->getItem('product_type'),
            'group_id' => (int) $this->getItem('group_id', 0),
            'stock' => (int) $this->getItem('stock', 0),
            'num' => (int) $this->getItem('num', 0),
            'point' => (int) $this->getItem('point', 0),
            'price' => (int) $this->getItem('price', 0),
            'addons_price' => (int) $this->getItem('addons_price', 0),
            'calc_price' => (int) $this->getItem('calc_price', 0),
            'addons_total_fee' => (int) $this->getItem('addons_total_fee', 0),
            'total_point' => (int) $this->getItem('total_point', 0),
            'product_total_fee' => (int) $this->getItem('product_total_fee', 0),
            'total_fee' => (int) $this->getItem('total_fee', 0),
            'discount_total_fee' => (int) $this->getItem('discount_total_fee', 0),
            'addons' => $this->getAddonsData(),
            'discount' => $this->getDiscountData(),
            'attach' => $this->getAttachData(),
        ];
    }

    /**
     * @return OrderProductDto[]
     */
    public function getAddonsData()
    {
        return $this->getFromTranslateCache(
            'addons',
            OrderProductAddonsDto::class
        );
    }

    /**
     * @return OrderProductDto[]
     */
    public function getDiscountData()
    {
        return $this->getFromTranslateCache(
            'discount',
            OrderDiscountDto::class
        );
    }

    /**
     * @return OrderProductDto[]
     */
    public function getAttachData()
    {
        return $this->getFromTranslateCache(
            'attach',
            OrderAttachDto::class
        );
    }

    /**
     * @return OrderProductFreightTemplateDto
     */
    public function getFreightTemplateData()
    {
        return $this->getFromCache('freight_template', function () {
            return new OrderProductFreightTemplateDto($this->getItem('freight_template'));
        });
    }

    /**
     * @param string $scene
     * @param string $sceneId
     * @param string|float|int|null $sceneVal
     * @return $this|OrderDto
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