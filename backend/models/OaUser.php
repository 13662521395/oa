<?php

namespace app\models;

use Yii;
use backend\models\OaRole;
/**
 * This is the model class for table "oa_user".
 *
 * @property integer $oa_uid
 * @property string $oa_uname
 * @property string $oa_nickname
 * @property string $oa_card
 * @property integer $oa_sex
 * @property integer $oa_age
 * @property string $oa_utel
 * @property string $oa_pwd
 * @property string $oa_emil
 * @property integer $oa_standing
 * @property integer $dep_id
 * @property integer $pos_id
 * @property integer $school_id
 * @property string $duty_id
 * @property integer $oa_auth
 * @property string $oa_ucreattime
 * @property integer $oa_status
 * @property integer $role_id
 */
class OaUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oa_uname', 'oa_pwd', 'role_id'], 'required'],
            [['oa_status', 'role_id'], 'integer'],
            [['oa_uname'], 'string', 'max' => 8],
            [['oa_pwd'], 'string', 'max' => 35],
            [['oa_emil'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oa_uid' => 'ID',
            'oa_uname' => '用户名',
            'oa_pwd' => '密码',
            'oa_emil' => '邮箱',
            'oa_status' => '状态',
            'role_id' => '角色',
        ];
    }
    public function getOaRole()
    {
        //同样第一个参数指定关联的子表模型类名
        //参数一 关联Model名   参数二 关联字段 不能写表.t_id 自己默认后边是本Model的表id  前边是关联表的id
        return $this->hasOne(OaRole::className(), ['role_id' => 'role_id']);
    }
}
