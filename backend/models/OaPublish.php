<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oa_publish".
 *
 * @property string $p_id
 * @property string $p_name
 * @property integer $p_user
 * @property integer $p_fid
 * @property string $p_content
 * @property integer $p_import
 * @property string $p_create_time
 * @property string $p_edit_time
 * @property integer $p_status
 */
class OaPublish extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_publish';
    }

    /*
     * 用户关联模型
     */
    public function getOaUser()
    {
        return $this->hasOne(OaUser::className(),['oa_uid'=>'p_user']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_name', 'p_user', 'p_content'], 'required'],
            [['p_fid', 'p_import', 'p_status', 'p_users'], 'integer'],
            [['p_content'], 'string'],
            [['p_name'], 'string', 'max' => 300],
            [['p_create_time', 'p_edit_time'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p_id' => 'P ID',
            'p_name' => '任务',
            'p_user' => '发布人',
            'p_fid' => 'P Fid',
            'p_content' => '任务详情',
            'p_import' => '任务优先级',
            'p_joinusers' => '执行者',
            'p_create_time' => '发布时间',
            'p_edit_time' => '修改时间',
            'p_users' => '执行者',
            'p_status' => 'P Status',
        ];
    }
}
