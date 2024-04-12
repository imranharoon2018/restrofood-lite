<?php 
namespace RestroFoodLite;
/**
 *
 * @package     Restrofood
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */
class Date_Time_Map {

  /**
   * [$timeZone description]
   * @var string
   */
  private static $timeZone;

  private static function setTimeZone() {
    $zone = get_option('restrofoodlite_options');
    self::$timeZone = !empty( $zone['time-zone'] ) ? $zone['time-zone'] : '';

    return new \DateTimeZone(wp_timezone_string());
  }

  /**
   * [SetDateTime description]
   * @param string $timeZone 
   * @return  object
   */
  private static function SetDateTime() {

    $date = new \DateTime();
    $date->setTimezone(self::setTimeZone());
    return $date;
    
  }

  public static function getDateTime() {
    return self::SetDateTime();
  }

  /**
   * [getDate description]
   * @return [type] [description]
   */
  public static function getDate() {}

  /**
   * [getTime description]
   * @return [type] [description]
   */
  public static function getTimes( $selectedDate = '', $selectedBranch = ''  ) {
    return self::timeListMaping( $selectedDate, $selectedBranch );
  }

  /**
   * [dataMaping description]
   * @return [type] [description]
   */
  public static function dataMaping() {}

  /**
   * [timeMaping description]
   * @return [type] [description]
   */
  public static function timeListMaping( $selectedDate = '', $selectedBranch = '' ) {

    $options = get_option('restrofoodlite_options');
    // get date time
    $getDateTime = self::getDateTime();
    // Get day name by date
    $getDay = !empty( $selectedDate ) ? self::getDay( $selectedDate ) : $getDateTime->format("l");
    // Get date $selectedDate or current date
    $getDate = !empty( $selectedDate ) ? $selectedDate : $getDateTime->format('d-m-Y');
    
    // Check branch type and take action
    if( restrofoodlite_is_multi_branch() ) {

      $getBranchDayTime = get_post_meta( $selectedBranch, 'restrofoodbranch_day_based_time', true );

      $dtd = self::restrofoodlite_get_day_order_times( $getBranchDayTime );

      if( empty( $dtd ) ) {
        return;
      }

      $getDayNumber = restrofoodlite_get_day_number( $getDay );
      $shopOpeningTime = !empty( $dtd[$getDayNumber][1] ) ? $dtd[$getDayNumber][1] : '';
      $shopClosingTime = !empty( $dtd[$getDayNumber][2] ) ? $dtd[$getDayNumber][2] : '';

      $breakStartTime = !empty( $dtd[$getDayNumber][4] ) ? $dtd[$getDayNumber][4] : '';
      $breakEndTime   = !empty( $dtd[$getDayNumber][5] ) ? $dtd[$getDayNumber][5] : '';

    } else {

      if( empty( $options['delivery-time-day'] ) ) {
        return;
      }

      // Get delivery time list and day
      $dtd = self::restrofoodlite_get_day_order_times( $options['delivery-time-day'] );

      $getDayNumber = restrofoodlite_get_day_number( $getDay );

      $shopOpeningTime = !empty( $dtd[$getDayNumber][1] ) ? $dtd[$getDayNumber][1] : '';
      $shopClosingTime = !empty( $dtd[$getDayNumber][2] ) ? $dtd[$getDayNumber][2] : '';

      $breakStartTime = !empty( $dtd[$getDayNumber][4] ) ? $dtd[$getDayNumber][4] : '';
      $breakEndTime = !empty( $dtd[$getDayNumber][5] ) ? $dtd[$getDayNumber][5] : '';
    }

    // Check is holiday 
    if( !empty( $dtd[$getDayNumber][3] ) ) {
      return;
    }
    // Time format 
    $timeFormat = restrofoodlite_time_format();
    //
    $timeSlot = '';
    if( !empty( $options['delivery-time-slot'] ) ) {
      $timeSlot = explode(',', $options['delivery-time-slot'] );
    }

    $times = [];

    // Round formatted time
    $getCurrentHour     = $getDateTime->format('h');
    $getCurrentMeridiem = $getDateTime->format('a');

    $getMinute = $getDateTime->format('i') < 30 ? '30' : '00';
    
    $getCurrentTime = "$getCurrentHour:$getMinute$getCurrentMeridiem";

    // Check is shop Opening Time set
    if( empty( $shopOpeningTime ) ) {
      return;
    }

    // Check start time
    $setStartTime = $getCurrentTime;

    if( strtotime($shopOpeningTime) > strtotime($getCurrentTime) ) {
      $setStartTime = $shopOpeningTime;
    }

    if( !empty( $selectedDate ) ) {

      $currentDate  = strtotime( $getDateTime->format('d-m-Y') );
      $selectedDate = strtotime( $selectedDate );

      if( $selectedDate > $currentDate ) {
        $setStartTime = $shopOpeningTime;
      }

    }

    // value init 
    $startTime   = $setStartTime;
    $endTime     = !empty( $shopClosingTime ) ? $shopClosingTime : '';
    $MinutesDeff = 30;

    // Get start time to end time different
    $startTimeStr = strtotime( $startTime );
    $endTimeStr   =  $timeSlot[1] == '30' ? strtotime( '+30 minutes',strtotime( $endTime )  ) : strtotime( '+1 hour',strtotime( $endTime ) ); // add minutes and hour with store closing time depend on time slot 
    $deff         = $endTimeStr - $startTimeStr;
    $totalHour    = date('h', $deff );

    if( $MinutesDeff > 60 ) {
      $loopTime  = $totalHour / $timeSlot[0];
      $loopTime  = round( $loopTime );
    } else {
      $loopTime = $totalHour * $timeSlot[0];
    }

    //
    $addMinutes  = 0;
    $newTime     = '';
    //
    for( $i = 0; $i <= $loopTime; $i++ ) {

      if( !empty( $newTime ) ) {
        $addMinutes = $MinutesDeff;
        $startTime = $newTime;
      }

      $t = strtotime( '+'.$addMinutes.' minutes',strtotime( $startTime ) );

      // New time
      $newTime = date( $timeFormat, $t );

      // Break time set
      $breakTime = '';
      $getNewTimeStr = strtotime( $newTime );

      if( strtotime( $breakStartTime ) <= $getNewTimeStr && strtotime( $breakEndTime ) >= $getNewTimeStr ) {
        $breakTime = 'true';
      }

      //
      $count = '';
      $slotOrderStatus = '';

      if( $endTimeStr == $t || $t > $endTimeStr ) {
        break;
      }

      $times[] = ['times' => $newTime, 'count' => $count, 'slot_order_status' => $slotOrderStatus, 'break_time' => $breakTime];
  
    }

    return $times;

  }

  /**
   * todayDate 
   * @return string
   */
  public static function todayDate() {
    $date = self::getDateTime();
    return $date->format('d-m-Y');
  }

  /**
   * nowTime
   * @return string
   */
  public static function nowTime() {
    $date = self::getDateTime();
    return $date->format('h:i:sa');
  }
  /**
   * Current Time Stamp
   * @return string
   */
  public static function currentTimeStamp() {
    return strtotime(self::nowTime());
  }

  /**
   * [getTodayDateWithDay description]
   * @return array
   */
  public static function getTodayDateWithDay() {

    $date = self::todayDate();
    $day = self::getDay($date);

    return [ ['day' => $day, 'date' => $date] ];
  }

  /**
   * getDay 
   * @return string
   */
  public static function getDay( $date, $sepparator = '-' ) {

    // date format should be 04-11-2020
    $parts = explode( $sepparator, $date);
    $date = self::getDateTime();
    $date->setDate( $parts[2], $parts[1], $parts[0] );
    return $date->format("l");
  }

  /**
   * [is_holy_day description]
   * @param  string  $date [description]
   * @return boolean       [description]
   */
  public static function is_holy_day( $date = '' , $branchId = '' ) {
    //
    if( restrofoodlite_is_multi_branch() ) {
      $getHolyDays = !empty( $branchId ) ? get_post_meta( absint( $branchId ), 'restrofoodbranch_day_based_time', true ) : '';
    } else {
      $options = get_option('restrofoodlite_options');
      $getHolyDays = !empty( $options['delivery-time-day'] ) ? $options['delivery-time-day'] : '';
    }

    $filteredDay = self::restrofoodlite_get_selected_holy_day( $getHolyDays );
    $getDateTime = self::getDateTime();
    $getDay = !empty( $date ) ? self::getDay( $date ) : $getDateTime->format("l");
    $getCurrentDay = restrofoodlite_get_day_number( $getDay );
    $is_holy_day = false;
    if( is_array($filteredDay) && in_array( $getCurrentDay , $filteredDay) ) {
      $is_holy_day = true;
    }
    return $is_holy_day; 
  }

  /**
   * [restrofoodlite_get_selected_holy_day description]
   * @param  [type] $data [description]
   * @return array
   */
  public static function restrofoodlite_get_selected_holy_day( $data ) {

    if( empty( $data ) ) {
      return;
    }

    $getData = array_map(
          function( $key ) {
            if( !empty( $key['is-holy-day'] ) ) {
             return $key['day'] ; 
            }
          },
          $data
    );

    return array_filter( $getData, [ __CLASS__, 'customArrFilter' ] );

  }
  /**
   * [restrofoodlite_get_day_order_times description]
   * @return [type] [description]
   */
  public static function restrofoodlite_get_day_order_times( $data = array() ) {

    if( empty($data) ) {
      return ;
    }

    $getData = array_map(
          function( $key ) {
            if( !empty( $key['open-time'] ) && !empty( $key['end-time'] ) ) {
              $holyDay = !empty( $key['is-holy-day'] ) ? $key['is-holy-day'] : '';
             return [$key['day'],$key['open-time'], $key['end-time'],$holyDay,$key['break-time-from'],$key['break-time-to']]; 
            }
          },
          $data
    );
    return array_filter( $getData, [ __CLASS__, 'customArrFilter' ] );
  }

  /**
   * [customArrFilter description]
   * @param  [type] $var [description]
   * @return [type]      [description]
   */
  public static function customArrFilter($var){
    return ($var !== NULL && $var !== FALSE && $var !== '');
  }


}