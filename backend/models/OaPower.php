<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oa_power".
 *
 * @property integer $oa_id
 * @property string $oa_controller
 * @property string $oa_fid
 * @property string $oa_module
 */
class OaPower extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_power';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oa_controller', 'oa_fid', 'oa_module'], 'required'],
            [['oa_controller', 'oa_module'], 'string', 'max' => 30],
            [['oa_fid'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oa_id' => 'Oa ID',
            'oa_controller' => 'Oa Controller',
            'oa_fid' => 'Oa Fid',
            'oa_module' => 'Oa Module',
        ];
    }
    public function getOaModular()
    {
        //同样第一个参数指定关联的子表模型类名
        //参数一 关联Model名   参数二 关联字段 不能写表.t_id 自己默认后边是本Model的表id  前边是关联表的id
        return $this->hasOne(OaModular::className(), ['m_id' => 'oa_fid']);
    }
}
