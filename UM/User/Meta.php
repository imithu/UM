<?php
namespace UM\User;


use Illuminate\Support\Facades\DB;




class Meta
{


  /**
   * set unique meta data of an user
   * 
   * @param int    $id_user
   * @param string $meta_key
   * @param string $meta_value
   * 
   * @since   2.3.0
   * @version 2.3.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function set_text( int $id_user, string $meta_key, string $meta_value )
  {
    $meta_value = htmlspecialchars(trim($meta_value));

    if(self::get_text($id_user, $meta_key)!==$meta_value){
      $meta_key   = htmlspecialchars(trim($meta_key));
      DB::table('UM_usermeta')->updateOrInsert(
        [
          'id_user'=>$id_user,
          'meta_key' => $meta_key
        ],
        [
          'meta_value'=>$meta_value,
          'datetime'=>\Misc\Moment::datetime()
        ]
      );
    }
  }




  /**
   * get text meta data of an user
   * 
   * @param int    $id_user
   * @param string $meta_key
   * 
   * 
   * @return string|null - string - value
   *                     - NULL   - not found
   * 
   * @since   2.3.0
   * @version 2.4.1
   * @author  Mahmudul Hasan Mithu
   */
  public static function get_text( int $id_user, string $meta_key )
  {
    $meta_key   = htmlspecialchars(trim($meta_key));
    $meta_value = DB::table('UM_usermeta')->where('id_user', $id_user)->where('meta_key', $meta_key)->value('meta_value');
    return htmlspecialchars_decode($meta_value);
  }


}
