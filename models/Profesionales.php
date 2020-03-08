<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profesionales".
 *
 * @property int $usuario_id
 * @property string $nombre
 * @property string $apellidos
 * @property string $telefono
 * @property string|null $direccion
 * @property string|null $slogan
 * @property string $created_at
 * @property int $poblacion_id
 * @property int $profesion_id
 *
 * @property Poblaciones $poblacion
 * @property Profesiones $profesion
 * @property Usuarios $usuario
 */
class Profesionales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesionales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'nombre', 'apellidos', 'telefono', 'poblacion_id', 'profesion_id'], 'required'],
            [['usuario_id', 'poblacion_id', 'profesion_id'], 'default', 'value' => null],
            [['usuario_id', 'poblacion_id', 'profesion_id'], 'integer'],
            [['created_at'], 'safe'],
            [['nombre', 'apellidos', 'telefono', 'direccion', 'slogan'], 'string', 'max' => 255],
            [['usuario_id'], 'unique'],
            [['poblacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poblaciones::className(), 'targetAttribute' => ['poblacion_id' => 'id']],
            [['profesion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesiones::className(), 'targetAttribute' => ['profesion_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usuario_id' => 'Usuario ID',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'slogan' => 'Slogan',
            'created_at' => 'Created At',
            'poblacion_id' => 'Poblacion ID',
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
        return $this->hasOne(Poblaciones::className(), ['id' => 'poblacion_id'])->inverseOf('profesionales');
    }

    /**
     * Gets query for [[Profesion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesion()
    {
        return $this->hasOne(Profesiones::className(), ['id' => 'profesion_id'])->inverseOf('profesionales');
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('profesionales');
    }
}
