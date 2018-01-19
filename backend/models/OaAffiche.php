<?php

namespace app\models;

use Yii;
use app\models\OaUser;
/**
 * This is the model class for table "oa_affiche".
 *
 * @property integer $aff_id
 * @property string $aff_title
 * @property string $aff_content
 * @property integer $oa_uid
 * @property integer $aff_pos
 * @property string $aff_publication
 * @property string $aff_creattime
 */
class OaAffiche extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_affiche';
    }
     public function getOaUser()
    {
        return $this->hasOne(OaUser::className(), ['oa_uid' => 'oa_uid']);//第一个函数是要关联模型名，第二个固定。后面是当前模型的外键
    }
    public function getOaelec()
    {
        return $this->hasOne(OaElec::className(), ['aff_id' => 'aff_id']);//第一个函数是要关联模型名，第二个固定。后面是当前模型的外键
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aff_title', 'aff_content', 'oa_uid', 'aff_pos', 'aff_publication','aff_rstate'], 'required'],
            [['aff_content'], 'string'],
            //[[ 'aff_pos'], 'integer'],
            [['aff_title'], 'string', 'max' => 20],
            [['aff_publication'], 'string', 'max' => 255],
            //[['aff_creattime'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aff_id' => '序号',
            'aff_title' => '公告标题',
            'aff_content' => '公告内容',
            'oa_uid' => '发布用户',
            'aff_pos' => '发布类型',
            'aff_publication' => '发布对象',
            'aff_creattime' => '发布时间',
             'aff_rstate' => '阅读状态',
        ];
    }
}
