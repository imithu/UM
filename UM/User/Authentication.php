<?php

namespace UM\User;

use UM\Database\Users;
use UM\Verify\User;


class Authentication
{
  /**
   * main authentication
   * 
   * @param string $auth (json) - {"user_id": 0,"username":"","email":"","password_hashed":"","usertype":""}
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
   * @version 1.9.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function main( string $auth )
  {
    $auth = json_decode($auth);


    $user_id =  (int) $auth->user_id;
    $username = (string) $auth->username;
    $email =    (string) $auth->email;
    $password_hashed = (string) $auth->password_hashed;
    $usertype =        (string) $auth->usertype;


    $user_id_DB = Users::id_username_or_email( $username );
    if(
         $user_id_DB>0
      && User::user_is_verified($user_id_DB) 
      && ( $user_id === $user_id_DB )
      && ( $username === Users::select( $user_id_DB, 'username' ) )
      && ( $email === Users::select( $user_id_DB, 'email' ) )
      && ( $password_hashed === Users::select($user_id_DB, 'password') )
      && ( $usertype === Users::select($user_id_DB, 'usertype') )
      && ( Users::select($user_id_DB, 'userstatus')==='active' )
    ) {
      return '{ "success": true }';
    }


    return '{ "success": false }';
  }
}