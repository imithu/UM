<?php
namespace UM\User;


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




  /**
   * check user exists or not
   * 
   * @param int|string id_user | username | email
   * 
   * @return bool true  - user exists
   *              false - user does not exists
   * 
   * @since   2.0.0
   * @version 2.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function is_exist( $value )
  {
    $id_user = DB::table('UM_users')
                ->where( 'id', $value )
                ->orWhere( 'username', $value )
                ->orWhere( 'email', $value )
                ->value('id');

    if( $id_user>0 ) return true;
    return false;
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
  public static function is_verified( int $user_id )
  {
    $is_email_verified = DB::table('UM_users')->where('id', $user_id)->value('email_is_verified');
    if( $is_email_verified==='yes' ) return true;

    return false;
  }


}
