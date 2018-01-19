<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oa_mission_log".
 *
 * @property integer $mlog_id
 * @property string $mlog_name
 * @property integer $oa_uid
 * @property string $mlog_creattime
 * @property string $mlog_user
 * @property integer $mlog_status
 */
class OaMissionLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_mission_log';
    }
    public function getOaUser()
    {
        return $this->hasOne(OaUser::className(),['oa_uid'=>'oa_uid']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mlog_name', 'oa_uid', 'mlog_user', 'mlog_type'], 'required'],
            [['oa_uid', 'mlog_status','mlog_creattime'], 'integer'],
            [['mlog_name'], 'string', 'max' => 50],
       
            [['mlog_user'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mlog_id' => 'Mlog ID',
            'mlog_name' => 'Mlog Name',
            'oa_uid' => 'Oa Uid',
            'mlog_creattime' => 'Mlog Creattime',
            'mlog_user' => 'Mlog User',
            'mlog_status' => 'Mlog Status',
        ];
    }
}
