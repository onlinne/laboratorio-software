<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    protected $fillable = ['user_id', 'test_id'];

    protected $table = "user_test";

    public function User()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function test()
    {
        return $this->belongsTo('App\Test', 'test_id');
    }
}
