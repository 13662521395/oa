<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oa_tree".
 *
 * @property string $id
 * @property string $name
 * @property string $fid
 */
class OaTree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oa_tree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['fid'], 'integer'],
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'fid' => 'Fid',
        ];
    }
    public function getOaposition()
    {
        return $this->hasOne(OaPosition::className(),['pos_id'=>'name']);
    }
    public function getOadepartment()
    {
        return $this->hasOne(OaDepartment::className(),['dep_id'=>'name']);
    }
    public function getOaschool()
    {
        return $this->hasOne(OaSchool::className(),['school_id'=>'name']);
    }
    public function getOasdbr()
    {
        return $this->hasOne(OaSdbr::className(),['id'=>'name']);
    }
}
