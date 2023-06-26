<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {
    use HasFactory;

    protected $fillable = [
        'company_id',
        'area_id',
        'coupon_name',
        'coupon_description',
        'expiry',
        'terms_and_conditions',
        'coupon_img'
    ];

    protected $primaryKey = 'coupon_id';

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function area() {
        return $this->belongsTo(Area::class, 'area_id');
    }

    // 非表示にするクーポンを除外するスコープを追加
    public function scopeVisible($query) {
        return $query->where('deleted', 0);
    }
}
