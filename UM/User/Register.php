<?php
namespace UM\User;


use Illuminate\Support\Facades\DB;
use UM\Verify\Syntax;


class Register
{


  /**
   * register a user
   * 
   * @param string $username
   * @param string $email
   * @param string $password
   * 
   * @param string $usertype
   * 
   * 
   * @return int >0  - successful user registration ( return newly created user id )
   *              0  - failed     user registration
   * 
   * @since   1.0.0
   * @version 2.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function main( string $username, string $email, string $password, string $usertype )
  {
    $username = strtolower(trim($username));
    $email    = strtolower(trim($email));
    $usertype = strtolower(trim($usertype));
    
    if(  Register_Helper_main::is_username_okay($username) && Register_Helper_main::is_email_okay($email) ){
      $id_user = DB::table('UM_users')->insertGetId(
        [
          'username' => $username,
          'email' => $email,
          'password' => '',
          'usertype' => $usertype,
          'userstatus' => 'pending',
          'is_email_verified' => 0,
          'datetime'=> \Misc\Moment::datetime()
        ]
      );
      Password::update( $id_user, $password );
      return $id_user;
    }

    return 0;
  }


}




final class Register_Helper_main
{


  /**
   * check email syntax is okay or not
   * check email existence
   * 
   * @param string $email
   * 
   * @return bool true  - email is okay   -- new account can be created with this email
   *              false - email is not okay
   * 
   * @since   2.0.0
   * @version 2.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function is_email_okay( string $email )
  {
    // check email syntax
    if( Syntax::email($email) ){
      // check email existence
        $id_user = Account::get_id($email, 'e');
        if( $id_user===0 ) return true;

        $is_user_verified = Account::is_verified( $id_user );
        if( $is_user_verified===false ){
          Account::delete( $id_user );
          return true;
        }
    }

    return false;
  }




  /**
   * check username syntax is okay or not
   * check username existence
   * 
   * @param string $username
   * 
   * @return bool true  - username is okay   -- new account can be created with this username
   *              false - username is not okay
   * 
   * @since   2.0.0
   * @version 2.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function is_username_okay( string $username )
  {
    // check username syntax
    if( Syntax::username($username) ){
      // check username existence
        $id_user = Account::get_id($username, 'u');
        if( $id_user===0 ) return true;

        $is_user_verified = Account::is_verified( $id_user );
        if( $is_user_verified===false ){
          Account::delete( $id_user );
          return true;
        }
    }

    return false;
  }


}
