<?php

namespace Cblink\Service\FinchAspect\Dto\Product;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property int $ratio_type 佣金类型
 * @property int $tier 层级
 * @property int|float $self_price 自购佣金
 * @property int $self_ratio 自购比例
 * @property int|float $total_commission 总佣金
 * @property int|float $share_price 分享佣金
 * @property int $share_ratio 分享比例
 * @property int|float $child_share_price 下级佣金
 * @property int $child_share_ratio 下级比例
 */
class ProductSalesmanDto extends BaseAspectDto
{
    protected $fillable = [
        'ratio_type', 'tier', 'self_price', 'self_ratio', 'total_commission',
        'share_price', 'share_ratio', 'child_share_price', 'child_share_ratio',
    ];
}