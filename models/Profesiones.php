<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profesiones".
 *
 * @property int $id
 * @property string $pronom
 * @property int $sector_id
 *
 * @property Empleos[] $empleos
 * @property Profesionales[] $profesionales
 * @property Sectores $sector
 */
class Profesiones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesiones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pronom', 'sector_id'], 'required'],
            [['sector_id'], 'default', 'value' => null],
            [['sector_id'], 'integer'],
            [['pronom'], 'string', 'max' => 255],
            [['sector_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sectores::className(), 'targetAttribute' => ['sector_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pronom' => 'Pronom',
            'sector_id' => 'Sector ID',
        ];
    }

    /**
     * Gets query for [[Empleos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleos()
    {
        return $this->hasMany(Empleos::className(), ['profesion_id' => 'id'])->inverseOf('profesion');
    }

    /**
     * Gets query for [[Profesionales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesionales()
    {
        return $this->hasMany(Profesionales::className(), ['profesion_id' => 'id'])->inverseOf('profesion');
    }

    /**
     * Gets query for [[Sector]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSector()
    {
        return $this->hasOne(Sectores::className(), ['id' => 'sector_id'])->inverseOf('profesiones');
    }
}
