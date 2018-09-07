<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Users;
use App\Posts;
class PostsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    // 修改权限
    public function update(Users $users,Posts $posts){
        return $users->id == $posts->user_id;
    }
    // 删除权限
    public function delete(Users $users,Posts $posts){
        return $users->id == $posts->user_id;
    }
}
