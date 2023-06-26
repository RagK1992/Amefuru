<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'article_title',
        'article_description',
        'article_thumbnail'
    ];

    protected $primaryKey = 'article_id';

    // 非表示にするクーポンを除外するスコープを追加
    public function scopeVisible($query) {
        return $query->where('deleted', 0);
    }
}
