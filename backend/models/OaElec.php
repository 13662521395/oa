<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oa_elec".
 *
 * @property integer $elec_id
 * @property integer $oa_uid
 * @property integer $aff_public
 */
class OaElec extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_elec';
    }
    public function getOaaffiche()
    {
        return $this->hasOne(OaAffiche::className(), ['oa_uid' => 'oa_uid']);//第一个函数是要关联模型名，第二个固定。后面是当前模型的外键
    }
    public function getOauser()
    {
        return $this->hasOne(OaUser::className(), ['oa_uid' => 'oa_uid']);//第一个函数是要关联模型名，第二个固定。后面是当前模型的外键
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oa_uid', 'aff_public'], 'required'],
            [['oa_uid', 'aff_public'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elec_id' => 'Elec ID',
            'oa_uid' => 'Oa Uid',
            'aff_public' => 'Aff Public',
        ];
    }
}
