<?php

namespace UM\User;

use UM\Database\Users;
use UM\User\Account;
use UM\Verify\User;
use UM\Verify\Syntax;
use UM\Generate\Unknown_Data;

use Illuminate\Support\Facades\DB;




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
   * @return string (json) $SR - i.   { "error": true, "username_error": (boolean), "email_error": (boolean) }
   *                             ii.  { "error": false, 'temp_otp'=>'value', 'user_id'=>value }
   * 
   * 
   * @since   1.0.0
   * @version 1.7.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function register_main( string $username, string $email, string $password, string $usertype )
  {
    $SR =
    [
      'error' => true,
      'username_error'=> true,
      'email_error'=>true
    ];

    // removed side space except password
    $username = htmlspecialchars(strtolower(trim($username)));    // convert the username to lowercase
    $email = htmlspecialchars(strtolower(trim($email)));          // convert the email    to lowercase
    $usertype = trim($usertype);

    $SR_temp = Register_Main_Func_Helper::account_check( $username, $email );

    if( $SR_temp['username_error']===true || $SR_temp['email_error']===true ){
      $SR =
      [
        'error' => true,
        'username_error'=> $SR_temp['username_error'],
        'email_error'=>$SR_temp['email_error']
      ];
      return json_encode($SR);
    }

    $SR_temp = Register_Main_Func_Helper::create_account( $username, $email, $password, $usertype );
    $SR = 
    [
      'error' => false,
      'user_id'=> $SR_temp['user_id'],
      'temp_otp'=> $SR_temp['temp_otp']
    ];


    return json_encode($SR);
  }
}




final class Register_Main_Func_Helper
{
  /**
   * create account
   * 
   * @param string $username
   * @param string $email
   * @param string $password
   * 
   * @param string $usertype
   * 
   * @return array $SR [ $temp_otp=>'value',    $user_id=>value ]
   * 
   * @since   1.0.0
   * @version 1.7.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function create_account( string $username, string $email, string $password, string $usertype )
  {
    date_default_timezone_set('UTC');
    $password = password_hash( $password, PASSWORD_DEFAULT );
    $temp_otp = Unknown_Data::random_name();

    DB::table('UM_users')->insert(
      [
        'id' => NULL,
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'usertype' => $usertype,
        'userstatus' => 'pending',
        'email_is_verified' => 'no',
        'temp_otp' => $temp_otp,
        'datetime' => date('Y-m-d H:i:s')
      ]
    );

    $user_id = Users::id_username( $username );


    return
    [
        'temp_otp'=> $temp_otp,
        'user_id'=> $user_id
    ];
  }


  /**
   * check any account exist or not based on username and email
   * also check username syntax is valid or not
   * and take action
   * 
   * @param string $username
   * @param string $email
   * 
   * 
   * @return array $SR [ $username_error=>(bool),    $email_error=>(bool) ]
   * 
   * @since   1.0.0
   * @version 1.7.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function account_check( string $username, string $email )
  {
    $username_error = false;
    $email_error = false;




    // check username syntax is okay or not
    if(Syntax::username($username)){
      // check username exist or not in database
      $user_id = Users::id_username( $username );
      if( $user_id>0 ){
        if( User::user_is_verified( $user_id ) ){
          $username_error = true;
        }else{
          Account::delete( $user_id );
        }
      }
    }else{
      $username_error = true;
    }


    // check email exist or not in database
    $user_id = Users::id_email( $email );
    if( $user_id>0 ){
      if( User::user_is_verified( $user_id ) ){
        $email_error = true;
      }else{
         Account::delete( $user_id );
      }
    }



    $SR =
    [
      'username_error' => $username_error,
      'email_error' => $email_error
    ];
    return $SR;
  }


}