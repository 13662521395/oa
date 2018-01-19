<?php
namespace common\models;

use Yii;
use yii\base\Model;


class Date extends Model
{
   public function datechange($date)
   {
      return strtotime($date);
   }
}
    