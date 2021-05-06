<?php

namespace Misc;


class Moment
{
  /**
   * get current utc datetime
   * 
   * @return  string utc datetime  eg. 2021-05-03 14:51:08
   * 
   * @since   1.0.0
   * @version 1.0.0
   * @author  Mahmudul Hasan Mithu
   */
  public static function datetime()
  {
    date_default_timezone_set('UTC');
    return date('Y-m-d H:i:s');
  }
}