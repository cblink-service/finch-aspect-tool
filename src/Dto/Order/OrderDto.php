<?php

namespace Cblink\Service\FinchAspect\Dto\Order;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;
use JetBrains\PhpStorm\ArrayShape;
use Ramsey\Uuid\Uuid;

/**
 * @property string $scene 使用场景
 * @property int $sale_id 卖家ID
 * @property int $group_id 卖家分组ID
 * @property int $buyer_id 买家ID
 * @property int $goods_fee 商品金额（原价金额），单位分
 * @property int $goods_discount_fee 商品优惠金额，单位分
 * @property int $discount_fee 合计优惠金额，单位分
 * @property int $freight_fee 配送费用，单位分
 * @property int $package_fee 打包费用，单位分
 * @property int $total_fee 订单应付金额，单位分
 * @property int $origin_fee 订单金额，单位分
 * @property int $point_fee 订单积分
 *
 * @property OrderAttachDto[]|array $discount 订单折扣信息
 * @property OrderProductDto[]|array $products 商品信息
 * @property OrderProductDto[]|array $unable_products 无效的商品
 * @property OrderDiscountDto[]|array $attach 附加信息
 * @property OrderAddressDto $address 地址信息
 * 2@property OrderReserveDto $reserve 预定信息
 */
class OrderDto extends BaseAspectDto
{
    protected $fillable = [
        'scene',
        'sale_id',
        'group_id',
        'buyer_id',
        'goods_fee',
        'goods_discount_fee',
        'discount_fee',
        'freight_fee',
        'package_fee',
        'total_fee',
        'origin_fee',
        'point_fee',

        'products',
        'unable_products',

        'discount',
        'additional',

        'attach',
        'address',
        'reserve',
    ];

    #[ArrayShape([
        'scene' => 'string',
        'sale_id' => 'int',
        'group_id' => 'int',
        'buyer_id' => 'int',
        'goods_fee' => 'int',
        'goods_discount_fee' => 'int',
        'discount_fee' => 'int',
        'freight_fee' => 'int',
        'package_fee' => 'int',
        'total_fee' => 'int',
        'origin_fee' => 'int',
        'point_fee' => 'int',
    ])]
    public function getBaseInfo()
    {
        return [
            'scene' => (string) $this->getItem('scene'),
            'sale_id' => (int) $this->getItem('sale_id'),
            'group_id' => (int)  $this->getItem('group_id'),
            'buyer_id' => (int)  $this->getItem('buyer_id'),
            'goods_fee' => (int)  $this->getItem('goods_fee', 0),
            'goods_discount_fee' =>  (int) $this->getItem('goods_discount_fee', 0),
            'discount_fee' => (int)  $this->getItem('discount_fee', 0),
            'freight_fee' => (int)  $this->getItem('freight_fee', 0),
            'package_fee' => (int)  $this->getItem('package_fee', 0),
            'total_fee' => (int)  $this->getItem('total_fee', 0),
            'origin_fee' => (int)  $this->getItem('origin_fee', 0),
            'point_fee' => (int)  $this->getItem('point_fee', 0),
        ];
    }

    public function toData(): array
    {
        return $this->getBaseInfo() +
            [
                'products' => $this->getProductsData(),
                'unable_products' => $this->getUnableProductsData(),
                'attach' => $this->getAttachData(),
                'additional' => $this->getAdditionalData(),
                'address' => $this->getAddressData(),
                'discount' => $this->getDiscountData(),
                'reserve' => $this->getReserveData(),
            ];
    }

    /**
     * @return OrderProductDto[]
     */
    public function getProductsData()
    {
        return $this->getFromTranslateCache(
            'products',
            OrderProductDto::class
        );
    }

    /**
     * @return OrderProductDto[]
     */
    public function getUnableProductsData()
    {
        return $this->getFromTranslateCache(
            'unable_products',
            OrderProductDto::class
        );
    }

    /**
     * @return OrderDiscountDto[]
     */
    public function getDiscountData()
    {
        return $this->getFromTranslateCache(
            'discount',
            OrderDiscountDto::class
        );
    }

    /**
     * @return OrderDiscountDto[]
     */
    public function getAdditionalData()
    {
        return $this->getFromTranslateCache(
            'additional',
            OrderAdditionalDto::class
        );
    }

    /**
     * @return mixed
     */
    public function getAddressData()
    {
        return $this->getFromCache('address', function () {
            return new OrderAddressDto($this->getItem('address'));
        });
    }

    /**
     * @return mixed
     */
    public function getReserveData()
    {
        return $this->getFromCache('reserve', function () {
            return new OrderAddressDto($this->getItem('reserve'));
        });
    }

    /**
     * @return OrderAttachDto[]
     */
    public function getAttachData()
    {
        return $this->getFromTranslateCache(
            'attach',
            OrderAttachDto::class
        );
    }

    /**
     * 获取场景值
     *
     * @param $scene
     * @param $sceneId
     * @return mixed
     */
    public function getAttachVal($scene, $sceneId)
    {
        $result = collect($this->getItem('attach', []))
            ->where('scene', $scene)
            ->where('scene_id', $sceneId);

        if ($result->isEmpty()) {
            return null;
        }

        return $result->first()['scene_val'];
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