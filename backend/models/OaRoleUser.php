<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "oa_role_user".
 *
 * @property string $user_id
 * @property string $user_name
 * @property string $user_pass
 * @property integer $role_id
 * @property integer $status
 * @property string $last_time
 * @property string $last_ip
 * @property string $mail
 * @property string $remark
 * @property integer $isdel
 */
class OaRoleUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_role_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'user_pass', 'role_id', 'mail'], 'required'],
            [['role_id', 'status', 'last_time', 'isdel'], 'integer'],
            [['user_name'], 'string', 'max' => 15],
            [['user_pass'], 'string', 'max' => 25],
            [['last_ip'], 'string', 'max' => 10],
            [['mail', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'ID',
            'user_name' => '用户名',
            'user_pass' => '管理员密码',
            'role_id' => '角色',
            'status' => '状态',
            'last_time' => '上次登录时间',
            'last_ip' => '上次登录IP',
            'mail' => '邮箱',
            'remark' => '备注',
            'isdel' => '软删除',
        ];
    }
}
