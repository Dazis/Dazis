<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Figure extends Model
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
    public function figureList(){
        $res = DB::table('figure') -> where('status', 1) -> first();
        return $res;
    }
    public function collectionList(){
        $res = DB::table('collection')->limit(20)->get();
        return $res;
    }
}
