<?php

namespace app\models;

use Yii;
use app\models\OaSchool;
use app\models\OaPosition;
use app\models\OaDepartment;
/**
 * This is the model class for table "oa_position".
 *
 * @property integer $pos_id
 * @property string $pos_name
 * @property string $pos_rank
 * @property integer $pos_grade
 * @property string $pos_numbers
 * @property integer $pos_fid
 * @property integer $pos_status
 * @property integer $dep_id
 * @property integer $school_id
 * @property string $pos_creattime
 * @property string $pos_uptime
 * @property integer $pos_softdel
 */
class OaPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_position';
    }
    /*
     *表连接
     */
    public function getOaschool()
    {
        return $this->hasOne(OaSchool::className(),['school_id'=>'school_id']);
    }
    public function getOadepartment()
    {
        return $this->hasOne(OaDepartment::className(),['dep_id'=>'dep_id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pos_name', 'pos_rank', 'pos_grade',  'pos_fid', 'pos_status', 'dep_id', 'school_id',  'pos_softdel'], 'required'],
            [['pos_grade', 'pos_fid', 'pos_status', 'dep_id', 'school_id', 'pos_softdel'], 'integer'],
            [['pos_uptime'], 'safe'],
            [['pos_name'], 'string', 'max' => 50],
            [['pos_rank'], 'string', 'max' => 20],
            [['pos_numbers'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pos_id' => '序号',
            'pos_name' => '职位名称',
            'pos_rank' => '职位等级名称',
            'pos_grade' => '职位等级',
            // 'pos_numbers' => 'Pos Numbers',
            'pos_fid' => '上级',
            'pos_status' => '负责人',
            'dep_id' => '所属部门',
            'school_id' => '所属校区',
            'pos_creattime' => 'Pos Creattime',
            // 'pos_uptime' => 'Pos Uptime',
            'pos_softdel' => '状态',
        ];
    }
}
