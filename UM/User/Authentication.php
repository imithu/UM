<?php
namespace UM\User;


use Illuminate\Support\Facades\DB;
use UM\Verify\JWT;


class Authentication
{


  /**
   * main authentication
   * 
   * @param string token
   * 
   * @return int >0 - success - return id of user
   *              0 - fail
   * 
   * @since   1.7.0
   * @version 2.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function main( string $token )
  {
    $token_key = DB::table('UM_login')->where('token', $token)->value('token_key');

    if($token_key!==NULL){
      $payload = JWT::decode( $token, $token_key );
      if( $payload ) return $payload->id_user;
    }

    return 0;
  }


}
