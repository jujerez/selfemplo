<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "poblaciones".
 *
 * @property int $id
 * @property string $nombre
 * @property int $provincia_id
 *
 * @property Administradores[] $administradores
 * @property Empleadores[] $empleadores
 * @property Empleos[] $empleos
 * @property Provincias $provincia
 * @property Profesionales[] $profesionales
 */
class Poblaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'poblaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'provincia_id'], 'required'],
            [['provincia_id'], 'default', 'value' => null],
            [['provincia_id'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provincias::className(), 'targetAttribute' => ['provincia_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'provincia_id' => 'Provincia ID',
        ];
    }

    /**
     * Gets query for [[Administradores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdministradores()
    {
        return $this->hasMany(Administradores::className(), ['poblacion_id' => 'id'])->inverseOf('poblacion');
    }

    /**
     * Gets query for [[Empleadores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleadores()
    {
        return $this->hasMany(Empleadores::className(), ['poblacion_id' => 'id'])->inverseOf('poblacion');
    }

    /**
     * Gets query for [[Empleos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleos()
    {
        return $this->hasMany(Empleos::className(), ['poblacion_id' => 'id'])->inverseOf('poblacion');
    }

    /**
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'provincia_id'])->inverseOf('poblaciones');
    }

    /**
     * Gets query for [[Profesionales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesionales()
    {
        return $this->hasMany(Profesionales::className(), ['poblacion_id' => 'id'])->inverseOf('poblacion');
    }

    public static function lista($provincia_id)
    {
        return static::find()
            ->select('nombre')
            ->where(['provincia_id' => $provincia_id])
            ->orderBy('nombre')
            ->indexBy('id')
            ->column();
    }
}
