<?php
namespace UM\User;


use Illuminate\Support\Facades\DB;


class Account
{


  /**
   * Delete whole account based on id_user
   * 
   * @param int $id_user
   * 
   * @since   0.0.0
   * @version 2.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function delete( int $id_user )
  {
    DB::table('UM_users')->where( 'id', $id_user )->delete();
    DB::table('UM_usermeta')->where( 'id_user', $id_user )->delete();
  }




  /**
   * get id_user by id_user, username, email
   * also get the info of user existence
   * 
   * @param int|string id_user | username | email
   * 
   * @return int >0  - user exists
   *              0  - user does not exists
   * 
   * @since   2.0.0
   * @version 2.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function get_id( $value )
  {
    $id_user = DB::table('UM_users')
                ->where( 'id', $value )
                ->orWhere( 'username', $value )
                ->orWhere( 'email', $value )
                ->value('id');

    if( $id_user>0 ) return $id_user;
    return 0;
  }




  /**
   * check user is verified or not
   * 
   * @param int id_user
   * 
   * @return bool - true  - verified user
   *                false - not verified user
   * 
   * @since   1.0.0
   * @version 2.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function is_verified( int $id_user )
  {
    $is_email_verified = DB::table('UM_users')->where('id', $id_user)->value('is_email_verified');
    if( $is_email_verified===1 ) return true;

    return false;
  }


}
