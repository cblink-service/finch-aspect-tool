<?php

namespace Cblink\Service\FinchAspect\Dto\Order;

use Cblink\Service\FinchAspect\Kernel\BaseAspectDto;

/**
 * @property string|null $pickup_name       取货人名称
 * @property string|null $pickup_mobile     取货人手机号
 * @property string|null $table_no          桌号
 * @property int $reserve_at                取货时间
 */
class OrderReserveDto extends BaseAspectDto
{
    protected $fillable = [
        'pickup_name',
        'pickup_mobile',
        'table_no',
        'reserve_at',
    ];

}