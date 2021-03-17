<?php

namespace UM\User;

use UM\Database\Users;
use UM\Verify\User;


class Authentication
{
  /**
   * main authentication
   * 
   * @param int    $user_id
   * @param string $username
   * @param string $email
   * @param string $password_hashed
   * @param string $usertype
   * 
   * @return string (json) - successful authentication  - see (i)
   *                       - failed authentication      - see (ii)
   * 
   * i. 
   *    {
   *      "success": true
   *    }
   * 
   * ii. 
   *    {
   *      "success": false
   *    }
   *
   * 
   * @since   1.7.0
   * @version 1.8.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function main( int $user_id, string $username, string $email, string $password_hashed, string $usertype )
  {

    $user_id_DB = Users::id_username_or_email( $username );

    if(
         $user_id_DB>0
      && User::user_is_verified($user_id_DB) 
      && ( $user_id === $user_id_DB )
      && ( $username === Users::select( $user_id_DB, 'username' ) )
      && ( $email === Users::select( $user_id_DB, 'email' ) )
      && ( $password_hashed === Users::select($user_id_DB, 'password') )
      && ( $usertype === Users::select($user_id_DB, 'usertype') )
    ) {
      return '{ "success": true }';
    }


    return '{ "success": false }';
  }
}