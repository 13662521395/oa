<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "oa_role".
 *
 * @property string $role_id
 * @property string $role_name
 * @property string $role_power
 * @property integer $status
 * @property string $remark
 * @property integer $isdel
 */
class OaRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['remark'], 'required'],
            [['status', 'isdel'], 'integer'],
            [['role_name'], 'string', 'max' => 20],
            [['role_power', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'ID',
            'role_name' => '角色名称',
            'role_power' => '角色权限',
            'status' => '状态',
            'remark' => '角色描述',
            'isdel' => '软删除',
        ];
    }

}
