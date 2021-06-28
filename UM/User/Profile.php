<?php
namespace UM\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use UM\Generate\Unknown_Data;




class Profile
{


  /**
   * get multiple info of a user at a time
   * 
   * @param string $query
   * @param int    $id_user
   * @param array  $schema
   * 
   * @return array|null array - result
   *                    null  - fail to parse the query
   * 
   * @since   2.4.0
   * @version 2.4.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function get_info(string $query, int $id_user, array $schema)
  {
    $query = json_decode($query, false);
    if( gettype($query)==='array' ){
      $data = [];
      foreach( $query as $key=>$value ){
        if(    array_key_exists('usermeta', $schema) && in_array($value, $schema['usermeta'], true)) $data[$value] = Meta::get_text($id_user, $value);
        elseif(array_key_exists('users', $schema)    && in_array($value, $schema['users'],    true)) $data[$value] = DB::table('UM_users')->where('id', $id_user)->value($value);
        elseif(array_key_exists('usermeta_with_alias', $schema) && array_key_exists($value, $schema['usermeta_with_alias']))    $data[$value] = Meta::get_text($id_user, $schema['usermeta_with_alias'][$value]);
        elseif(array_key_exists('users_with_alias', $schema)    && array_key_exists($value, $schema['users_with_alias']))       $data[$value] = DB::table('UM_users')->where('id', $id_user)->value($schema['users_with_alias'][$value]);
      }
      return $data;
    }
    else return NULL;
  }


  /**
   * get multiple file url of a user at a time
   * 
   * @param string $query
   * @param int    $id_user
   * @param array  $schema
   * 
   * @return array|null array - result
   *                    null  - failed to parse the query
   * 
   * @since   2.4.0
   * @version 2.4.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function get_file(string $query, int $id_user, array $schema)
  {
    $query = json_decode($query, false);
    if( gettype($query)==='array' ){
      $data = [];
      foreach( $query as $key=>$value ){
        if( array_key_exists($value, $schema) ){
          $filename  = Meta::get_text($id_user, $value) ?? $schema[$value]['name_default'] ;
          $url = rawurlencode(Storage::disk($schema[$value]['disk'])->url($schema[$value]['path'].$filename));
          $data[$value] = $url;
        };
      }
      return $data;
    }
    else return NULL;
  }


  /**
   * set user info one by one  based on schema
   * 
   * @param int    $id_user
   * @param string $meta_key
   * @param string $meta_value
   * @param array  $schema
   * 
   * @return boolean - true  - success
   *                   false - fail
   * 
   * @since   2.4.0
   * @version 2.4.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function set_info( int $id_user, string $meta_key, string $meta_value, array $schema )
  {
    if( $meta_key && $meta_value && in_array($meta_key, $schema, true) ){
      Meta::set_text($id_user, $meta_key, $meta_value);
      return true;
    }
    else return false;
  }


  /**
   * 
   * upload file one by one based on schema
   * and delete previous file based on meta key only if it exists
   * 
   * @param int    $id_user
   * @param string $meta_key
   * @param array  $file
   * @param array  $schema
   * 
   * @return boolean - true  - success
   *                   false - fail
   * 
   * @since   2.4.0
   * @version 2.4.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function set_file( int $id_user, string $meta_key, array $file, array $schema )
  {
    if( $meta_key && $file && array_key_exists($meta_key, $schema) && in_array($file['type'], $schema[$meta_key]['type']) ){
      // delete previous file
      $previous_filename = Meta::get_text($id_user, $meta_key ) ?? '' ;
      if($previous_filename) Storage::disk($schema[$meta_key]['disk'])->delete($schema[$meta_key]['path'].$previous_filename);

      // upload new file
      $filename = Unknown_Data::random_name( $id_user, $file['name'], '' );
      Storage::disk($schema[$meta_key]['disk'])->putFileAs( $schema[$meta_key]['path'], $file['tmp_name'], $filename );
      Meta::set_text($id_user, $meta_key, $filename );

      return true;
    }
    else return false;
  }


}
