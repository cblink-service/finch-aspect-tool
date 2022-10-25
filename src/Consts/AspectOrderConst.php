<?php

namespace Cblink\Service\FinchAspect\Consts;

class AspectOrderConst
{

    // attach 附加信息
    public const ATTACH_TRADE = 'trade';
    public const ATTACH_COUPON = 'coupon';
    public const ATTACH_SHARE = 'share';
    public const ATTACH_WECHAT = 'wechat';

    // attach_id 附加信息key名
    // trade
    public const ATTACH_TRADE_PICK_TYPE = 'trade_pick_type';
    public const ATTACH_TRADE_CHANNEL = 'trade_channel';
    public const ATTACH_TRADE_REMARK = 'trade_remark';

    // share
    public const ATTACH_SHARE_OPENID = 'share_open_id';

    // coupon
    public const ATTACH_COUPON_BUYER_COUPON_CODE = 'buyer_coupon_code';

    // wechat
    public const ATTACH_WECHAT_MINI_APPID = 'mini_appid';



    // scene 场景
    public const SCENE_ORDER_CREATE = 'order.create';
    public const SCENE_ORDER_PREVIEW = 'order.preview';
    public const SCENE_CART_LIST = 'cert.list';
}