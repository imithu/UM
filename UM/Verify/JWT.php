<?php
namespace UM\Verify;

use Firebase\JWT\JWT as Firebase_JWT;
use UM\Generate\Unknown_Data;


class JWT
{
  /**
   * encode data in jwt
   * 
   * @param object $payload
   * 
   * @return object key and value
   * eg.
   * $variable->jwt
   * $variable->key
   * 
   * @since   1.10.0
   * @version 1.10.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function encode( object $payload )
  {
    $alg = 'HS512';
    $key = Unknown_Data::random_name();

    $jwt = Firebase_JWT::encode($payload, $key, $alg);

    return (object) [
      'jwt'=>$jwt,
      'key'=>$key
    ];
  }



  /**
   * verify jwt
   * 
   * @param string $jwt
   * @param string $key
   * 
   * @return false|object   false  - when signature is invalid
   *                        object - when signature is valid, return the payload
   * 
   * @since   1.10.0
   * @version 1.10.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function decode(string $jwt, string $key)
  {
    $alg = 'HS512';

    try{
      $payload = Firebase_JWT::decode($jwt, $key, array($alg));
    }
    catch(\Exception $e){
      return false;
    }

    return $payload;
  }
}