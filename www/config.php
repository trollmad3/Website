<?php

  if (isset($_SERVER['HTTP_HOST'])) {
    define("ROOT",(isset($_SERVER['HTTPS']) ? "https" : "http")."://".$_SERVER['HTTP_HOST']."/");
    define("DASH",ROOT."dash/");
    define("DROOT",$_SERVER['DOCUMENT_ROOT']."/");
    require DROOT.'vendor/autoload.php';
  } else {
    if ((@require "./vendor/autoload.php") === false) {
      require "../vendor/autoload.php";
    }
  }

  abstract class Result
  {
    const INVALID       = 0;
    const VALID         = 1;
    const CHANGE        = 2;
    const INSUFFICIENT  = 3;
    const NOTFOUND      = 4;
    const REDIRECT      = 5;
    const FAILED        = 6;

    //MYSQL
    const MYSQLERROR    = 50; //TODO Change to MYSQLCONNECT
    const MYSQLPREPARE  = 51;
    const MYSQLBIND     = 52;
    const MYSQLEXECUTE  = 53;
  }

  abstract class Level
  {
    const DISABLED    = 0;
    const ADMIN       = 1;
    const CAMPER      = 2;
    const MIT         = 4;
    const GUEST       = 256;
  }

  abstract class CampersFilter
  {
    const SIMPLE  = "simple";
    const ALL     = "all";
  }

  function GetFromURL($tag, $default = "") {
    if (isset($_REQUEST[$tag]))
      return $_REQUEST[$tag];
    return $default;
  }

  function NameFromDayCode($code) {
    switch ($code) {
      case 'M':
        return "Monday";
      case 'T':
        return "Tuesday";
      case 'W':
        return "Wednesday";
      case 'R':
        return "Thursday";
      case 'F':
        return "Friday";
      default:
        return Result::INVALID;
        break;
    }
  }

  function HumanFilesize($bytes, $decimals = 2) {
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
  }

  function GeneratePageDefaults() {
    global $PAGE_TYPE;
    global $PAGE_GUEST_ALLOWED;
    global $PAGE_TITLE;
    $PAGE_TYPE = "NORMAL";
    $PAGE_GUEST_ALLOWED = False;
    $PAGE_TITLE = "No Page";
  }

  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
?>
