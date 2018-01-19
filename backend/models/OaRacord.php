<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oa_racord".
 *
 * @property integer $racord_id
 * @property string $racord_name
 * @property integer $racord_user
 * @property string $racord_time
 */
class OaRacord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_racord';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*[['racord_user'], 'integer'],
            [['racord_name'], 'string', 'max' => 255],
            [['racord_time'], 'string', 'max' => 15],*/
        ];
    }

    public function getOaUser()
    {
        return $this->hasOne(OaUser::className(),['oa_uid'=>'racord_user']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'racord_id' => 'Racord ID',
            'racord_name' => 'Racord Name',
            'racord_user' => 'Racord User',
            'racord_time' => 'Racord Time',
        ];
    }
}
