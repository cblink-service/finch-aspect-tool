<?php

namespace Cblink\Service\FinchAspect\Dto;

use App\Common\Third\Consts\ProductConst;
use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;
use Hyperf\Utils\Arr;

/**
 * @property string $union_id
 * @property string $name
 * @property int $num
 * @property int $price
 * @property int $type
 * @property int $price_type
 */
class AspectOrderProductAdditionalDto extends BaseAspectDto
{
    protected $fillable = [
        'union_id',
        'name',
        'num',
        'price',
        'type',
        'price_type',
        'label',
    ];

    // 1固定加价，2叠加价格
    public function getTotalFee()
    {
        // 默认为固定加价
        $price = (string) $this->getItem('price', 0);

        // 叠加加价
        if ($this->getItem('price_type') == 2) {
            $price = bcmul($price, (string) $this->getItem('num', 0), 2);
        }

        return $price;
    }
}