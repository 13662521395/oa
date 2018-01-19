<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oa_mission".
 *
 * @property integer $m_id
 * @property string $m_name
 * @property integer $m_fid
 * @property integer $m_user
 * @property string $m_content
 * @property integer $m_import
 * @property string $m_lv
 * @property integer $m_creat_time
 * @property integer $m_edit_time
 * @property integer $m_status
 * @property integer $m_big_check
 * @property integer $m_biger_check
 * @property string $m_big_command
 * @property string $m_biger_command
 */
class OaMission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_mission';
    }

    /*
     * 用户关联模型
     */
    public function getOaUser()
    {
        return $this->hasOne(OaUser::className(),['oa_uid'=>'m_user']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           /* [['m_fid', 'm_user', 'm_import', 'm_creat_time', 'm_edit_time', 'm_status', 'm_big_check', 'm_biger_check'], 'integer'],
            [['m_name','m_user'], 'required' ],
            [['m_name', 'm_content', 'm_lv'], 'string', 'max' => 255],
            [['m_big_command', 'm_biger_command'], 'string', 'max' => 500],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'm_id' => 'ID',
            'm_name' => '任务名称',
            'm_fid' => '父级任务',
            'm_user' => '申请人',
            'm_content' => '任务详情',
            'm_import' => '任务优先级',
            'm_estima' => '预计时间',
            'm_lv' => '任务评分',
            'm_joinusers' => '参与者',
            'm_creat_time' => '申请时间',
            'm_edit_time' => '修改时间',
            'm_status' => 'M Status',
            'm_big_check' => '初步审核',
            'm_biger_check' => '最终审核',
            'm_big_command' => '初步审核批示',
            'm_biger_command' => '最终审核批示',
        ];
    }
}
