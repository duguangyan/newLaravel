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
    protected  $guarded = []; // ������ע����ֶ�
    // protected  $fillable = ['title','content']; // ����ע��������ֶ�
}