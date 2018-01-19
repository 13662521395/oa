<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oa_work".
 *
 * @property integer $w_id
 * @property string $w_teacher
 * @property string $w_time
 * @property string $w_subjects
 * @property string $w_number
 * @property string $w_fees
 * @property string $w_status
 */
class OaWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['w_teacher', 'w_time', 'w_subjects', 'w_number', 'w_fees', 'w_status'], 'required'],
            [['w_teacher', 'w_subjects'], 'string', 'max' => 8],
            [['w_time'], 'string', 'max' => 20],
            [['w_number', 'w_fees'], 'string', 'max' => 5],
            [['w_status'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'w_id' => '序号',
            'w_teacher' => '教师名称',
            'w_time' => '年-月-日',
            'w_subjects' => '科目',
            'w_number' => '课时数',
            'w_fees' => '课时费',
            'w_status' => '状态',
        ];
    }
}
