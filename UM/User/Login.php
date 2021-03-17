<?php

namespace UM\User;

use UM\Database\Users;
use UM\Verify\User;


class Login
{
  /**
   * main login
   * 
   * @param string $username_or_email
   * @param string $password
   * @param string $usertype
   * 
   * @return string (json) - successful authentication - see (i)
   *                       - failed authentication     - see (ii)
   * i. 
   *    {
   *      "success": true,
   *      "user_id": 0,
   *      "username": "username",
   *      "email": "email",
   *      "password_hashed": "password_hashed",
   *      "usertype": "usertype",
   *      "userstatus": "userstatus"
   *    }
   * 
   * ii. 
   *    {
   *      "success": false
   *    }
   *
   * 
   * @since   1.8.0
   * @version 1.8.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function main( string $username_or_email, string $password, string $usertype )
  {
    $username_or_email = strtolower(trim($username_or_email));
    $user_id = Users::id_username_or_email( $username_or_email );

    if(
          $user_id>0
      && User::user_is_verified($user_id) 
      && password_verify($password, Users::select($user_id, 'password'))
      && $usertype===Users::select( $user_id, 'usertype' )
      && 'active' ===Users::select( $user_id, 'userstatus' )
    )
    {
      $SR = [
        "success"         => true,
        "user_id"         => $user_id,
        "username"        => Users::select( $user_id, 'username' ),
        "email"           => Users::select( $user_id, 'email' ),
        "password_hashed" => Users::select( $user_id, 'password'),
        "usertype"        => $usertype,
        "userstatus"      => 'active'
      ];
    }else{
      $SR = [
        "success"         => false,
      ];
    }

    return json_encode($SR);
  }
}