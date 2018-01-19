<?php

namespace app\models;

use Yii;
use app\models\OaSchool;
use app\models\OaUser;
/**
 * This is the model class for table "oa_department".
 *
 * @property integer $dep_id
 * @property string $dep_name
 * @property string $dep_number
 * @property integer $dep_logo
 * @property string $dep_syno
 * @property string $oa_uid
 * @property integer $school_id
 * @property string $dep_creattime
 * @property integer $dep_softdel
 */
class OaDepartment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_department';
    }
    /*
     *表连接
     */
    public function getOaschool()
    {
        return $this->hasOne(OaSchool::className(),['school_id'=>'school_id']);
    }
    public function getOauser()
    {
        return $this->hasOne(OaUser::className(),['oa_uid'=>'oa_uid']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_name', 'dep_number', 'dep_logo', 'dep_syno', 'oa_uid', 'school_id', 'dep_softdel'], 'required'],
            [['dep_logo', 'school_id', 'dep_softdel'], 'integer'],
            [['dep_creattime'], 'safe'],
            [['dep_name'], 'string', 'max' => 10],
            [['dep_number', 'oa_uid'], 'string', 'max' => 20],
            [['dep_syno'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dep_id' => '序号',
            'dep_name' => '部门名称',
            'dep_number' => '部门编号',
            'dep_logo' => '部门标识',
            'dep_syno' => '部门简介',
            'oa_uid' => '部门负责人',
            'school_id' => '所属校区',
            //'dep_creattime' => 'Dep Creattime',
            'dep_softdel' => '状态',
        ];
    }
}
