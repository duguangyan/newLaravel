<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/8/28
 * Time: 16:01
 */

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
class Model extends BaseModel
{
    protected  $guarded = []; // 不可以注入的字段
    // protected  $fillable = ['title','content']; // 可以注入的数据字段
}