<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleos".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descripcion
 * @property string $created_at
 * @property int $poblacion_id
 * @property int $empleador_id
 * @property int $profesion_id
 *
 * @property Poblaciones $poblacion
 * @property Profesiones $profesion
 * @property Usuarios $empleador
 * @property Presupuestos[] $presupuestos
 */
class Empleos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion', 'poblacion_id', 'empleador_id', 'profesion_id'], 'required'],
            [['created_at'], 'safe'],
            [['poblacion_id', 'empleador_id', 'profesion_id'], 'default', 'value' => null],
            [['poblacion_id', 'empleador_id', 'profesion_id'], 'integer'],
            [['titulo', 'descripcion'], 'string', 'max' => 255],
            [['poblacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poblaciones::className(), 'targetAttribute' => ['poblacion_id' => 'id']],
            [['profesion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesiones::className(), 'targetAttribute' => ['profesion_id' => 'id']],
            [['empleador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['empleador_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'created_at' => 'Created At',
            'poblacion_id' => 'Poblacion ID',
            'empleador_id' => 'Empleador ID',
            'profesion_id' => 'Profesion ID',
        ];
    }

    /**
     * Gets query for [[Poblacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPoblacion()
    {
        return $this->hasOne(Poblaciones::className(), ['id' => 'poblacion_id'])->inverseOf('empleos');
    }

    /**
     * Gets query for [[Profesion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesion()
    {
        return $this->hasOne(Profesiones::className(), ['id' => 'profesion_id'])->inverseOf('empleos');
    }

    /**
     * Gets query for [[Empleador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleador()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'empleador_id'])->inverseOf('empleos');
    }

    /**
     * Gets query for [[Presupuestos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresupuestos()
    {
        return $this->hasMany(Presupuestos::className(), ['empleo_id' => 'id'])->inverseOf('empleo');
    }
}
