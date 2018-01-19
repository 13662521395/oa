<?php

namespace app\models;

use Yii;
use app\models\OaPosition;
/**
 * This is the model class for table "oa_school".
 *
 * @property integer $school_id
 * @property string $school_name
 * @property string $school_number
 * @property string $school_address
 * @property string $school_syno
 * @property string $school_leader
 * @property string $school_addper
 * @property string $school_creattime
 * @property string $school_softdel
 */
class OaSchool extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_school';
    }
    /*
     *表连接
     */
    public function getOaposition()
    {
        return $this->hasOne(OaPosition::className(),['pos'=>'pos_id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_name', 'school_number', 'school_address', 'school_syno', 'school_leader', 'school_addper'], 'required'],
            [['school_syno'], 'string'],
            [['school_creattime'], 'safe'],
            [['school_name', 'school_number', 'school_leader', 'school_addper'], 'string', 'max' => 20],
            [['school_address'], 'string', 'max' => 30],
            [['school_softdel'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'school_id' => '序号',
            'school_name' => '校区名称',
            'school_number' => '学校编号',
            'school_address' => '学校地址',
            'school_syno' => '校区简介',
            'school_leader' => '校区负责人',
            'school_addper' => '校区添加人',
            // 'school_creattime' => '校区加入时间',
            'school_softdel' => '状态',
        ];
    }
}
