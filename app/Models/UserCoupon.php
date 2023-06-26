<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model {
    use HasFactory;

    protected $table = 'user_coupon';
    protected $primaryKey = null; // user_idとcoupon_idの組み合わせが主キーである場合は、$primaryKeyプロパティをnullに設定します。
    public $incrementing = false; // 主キーが自動インクリメントされない場合は、$incrementingプロパティをfalseに設定します。

    protected $fillable = [
        'user_id',
        'coupon_id',
    ];
}
