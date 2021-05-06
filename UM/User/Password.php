<?php
namespace UM\User;


use Illuminate\Support\Facades\DB;


class Password
{


  /**
   * update user password
   * 
   * @param int    $id_user
   * @param string $password
   * 
   * @since   2.0.0
   * @version 2.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function update( int $id_user, string $password )
  {
    DB::table('UM_users')->where('id', $id_user)->update([ 'password' => password_hash($password, PASSWORD_DEFAULT) ]);
  }


}
