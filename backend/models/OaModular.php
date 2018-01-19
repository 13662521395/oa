<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oa_modular".
 *
 * @property integer $m_id
 * @property string $m_ename
 * @property string $m_cname
 */
class OaModular extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_modular';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['m_ename', 'm_cname'], 'required'],
            [['m_ename', 'm_cname'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'm_id' => 'M ID',
            'm_ename' => 'M Ename',
            'm_cname' => 'M Cname',
        ];
    }
    public function getOaBigmodelar()
    {
        //同样第一个参数指定关联的子表模型类名
        //参数一 关联Model名   参数二 关联字段 不能写表.t_id 自己默认后边是本Model的表id  前边是关联表的id
        return $this->hasOne(OaPower::className(), ['b_id' => 'm_fid']);
    }
    public function getOaPower()
    {
        //同样第一个参数指定关联的子表模型类名
        //参数一 关联Model名   参数二 关联字段 不能写表.t_id 自己默认后边是本Model的表id  前边是关联表的id
        return $this->hasOne(OaPower::className(), ['oa_fid' => 'm_id']);
    }
}
