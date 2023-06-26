<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Admin extends Model implements Authenticatable {
    // ...
    protected $fillable = ['email', 'password'];

    public function getAuthIdentifierName() {
        return 'email'; // ユーザーの識別子となるカラム名を返す
    }

    public function getAuthIdentifier() {
        return $this->getKey(); // ユーザーの識別子を返す
    }

    public function getAuthPassword() {
        return $this->password; // ユーザーのパスワードを返す
    }

    public function getRememberToken() {
        return null; // Remember token を使用しない場合は null を返す
    }

    public function setRememberToken($value) {
        // Remember token を使用しないため、実装は不要
    }

    public function getRememberTokenName() {
        return null; // Remember token のカラム名を指定する場合はカラム名を返す
    }
}
