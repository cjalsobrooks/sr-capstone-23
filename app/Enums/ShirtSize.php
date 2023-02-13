<?php
namespace App\Enums;

class ShirtSize{
  private static $sizes = ["xs","s","m","l","xl"];

  public static function randomSize(){
    shuffle(ShirtSize::$sizes);
    return ShirtSize::$sizes[0];
  }
}


