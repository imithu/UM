<?php
namespace UM\Verify;


use Illuminate\Support\Facades\DB;


final class Google
{


  /**
   * verify recaptcha v2 from server side
   * 
   * @param string $response_id
   * 
   * @return bool  true  - if     verified
   *               false - if not verified
   * 
   * 
   * @since   0.0.0
   * @version 2.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function captcha_recaptcha_v2( string $response_id )
  {
    $key = DB::table('UM_options')->where('meta_key', 'google_captcha_recaptcha_v2')->value('meta_value');
    $key = json_decode($key);
    $secret_key = $key->secret_key;

    $url = "https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$response_id}";
    $url = file_get_contents($url);
    $url = json_decode($url);

    if( $url->success==true ) return true;

    return false;
  }


}
