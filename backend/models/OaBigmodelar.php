<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oa_bigmodelar".
 *
 * @property integer $b_id
 * @property string $b_ename
 * @property string $b_cname
 */
class OaBigmodelar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_bigmodelar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_id', 'b_ename', 'b_cname'], 'required'],
            [['b_id'], 'integer'],
            [['b_ename', 'b_cname'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'b_id' => 'B ID',
            'b_ename' => 'B Ename',
            'b_cname' => 'B Cname',
        ];
    }
    public function getOaModular()
    {
        //同样第一个参数指定关联的子表模型类名
        //参数一 关联Model名   参数二 关联字段 不能写表.t_id 自己默认后边是本Model的表id  前边是关联表的id
        return $this->hasOne(OaModular::className(), ['m_fid' => 'b_id']);
    }
}
