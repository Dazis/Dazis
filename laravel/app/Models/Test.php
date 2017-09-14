<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Test extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    /**
     * [index description]  // 方法描述
     * @return [type] [description] // 返回说明
     */
    public function index(){
        $arr = array(1, 2);
        return $arr;
    }
}
