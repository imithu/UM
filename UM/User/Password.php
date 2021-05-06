<?php

namespace UM\User;


use UM\Verify\User;
use UM\Verify\Syntax;
use UM\Generate\Unknown_Data;
use UM\Database\Users;


class Password
{
    /**
     * update password of an user
     * 
     * @param int    $user_id
     * @param string $temp_otp
     * @param string $password
     * 
     * @return bool - true  - password update successful
     *                false - password update failed
     * 
     * @since   0.0.0
     * @version 1.0.0
     * @author  Mahmudul Hasan Mithu
     */
    public static function password_update( int $user_id, string $temp_otp, string $password )
    {
        $SR = false;

        if( 
               Syntax::password($password) 
            && $user_id>0 
            && User::user_is_verified( $user_id ) 
            && User::temp_otp($user_id, $temp_otp) 
        )
        {
            Users::update( $user_id, 'password', password_hash($password, PASSWORD_DEFAULT) );
            $SR = true;
        }

        return $SR;
    }

}