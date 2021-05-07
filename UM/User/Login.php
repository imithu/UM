<?php
namespace UM\User;


use Illuminate\Support\Facades\DB;
use UM\Verify\JWT;


final class Login
{


  /**
   * main login
   * 
   * @param string $username_or_email
   * @param string $password
   * @param string $usertype
   * 
   * @return bool|string  string - successful - return a token
   *                       false - fail       - return false
   *
   * 
   * @since   1.8.0
   * @version 2.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function main( string $username_or_email, string $password, string $usertype )
  {
    $username_or_email = strtolower(trim($username_or_email));
    $usertype          = strtolower(trim($usertype));

    $id_user = Account::get_id( $username_or_email, 'u' );
    if($id_user===0) $id_user = Account::get_id( $username_or_email, 'e' );


    if(
          $id_user>0
      && Account::is_verified($id_user)
      && password_verify($password, DB::table('UM_users')->where( 'id', $id_user )->value('password'))
      && $usertype===DB::table('UM_users')->where( 'id', $id_user )->value('usertype')
      &&  'active'===DB::table('UM_users')->where( 'id', $id_user )->value('userstatus')
    )
    {
      $token = JWT::encode( (object)[
          'id_user' => $id_user,
          'iat' => \Misc\Moment::datetime()
      ]);
      DB::table('UM_login')->insert([
        'token' => $token->jwt,
        'token_key' => $token->key,
        'access_count' => 0
      ]);
      return $token->jwt;
    }

    return false;
  }


}
