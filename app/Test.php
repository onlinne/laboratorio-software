<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'pregunta', 'user_id', 'respuesta','nivel','tipo_pregunta','imagen'
    ];

    protected $table ='test';
    
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_test', 'test_id');
    }

    public function userTest()
    {
        return $this->hasMany('App\UserTest');
    }
    
}
