<?php
namespace UM\User;

use UM\Verify\User;
use UM\Database\Users;
use Illuminate\Support\Facades\DB;

class Account
{
    /**
     * Delete whole account based on user_id
     * 
     * @param int $user_id
     * 
     * @since   0.0.0
     * @version 0.0.0
     * @author  Mahmudul Hasan Mithu
     */
    public static function delete( int $user_id )
    {
        DB::delete('DELETE FROM UM_users WHERE `id`=?', [$user_id]);
        DB::delete('DELETE FROM UM_usermeta WHERE `user_id`=?', [$user_id]);
    }
}