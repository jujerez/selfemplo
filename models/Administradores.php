<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "administradores".
 *
 * @property int $usuario_id
 * @property string $nombre
 * @property string $apellidos
 * @property string $telefono
 * @property string|null $direccion
 * @property string $created_at
 * @property int $poblacion_id
 *
 * @property Poblaciones $poblacion
 * @property Usuarios $usuario
 */
class Administradores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'administradores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'nombre', 'apellidos', 'telefono', 'poblacion_id'], 'required'],
            [['usuario_id', 'poblacion_id'], 'default', 'value' => null],
            [['usuario_id', 'poblacion_id'], 'integer'],
            [['created_at'], 'safe'],
            [['nombre', 'apellidos', 'telefono', 'direccion'], 'string', 'max' => 255],
            [['usuario_id'], 'unique'],
            [['poblacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poblaciones::className(), 'targetAttribute' => ['poblacion_id' => 'id']],
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
            'created_at' => 'Created At',
            'poblacion_id' => 'Poblacion ID',
        ];
    }

    /**
     * Gets query for [[Poblacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPoblacion()
    {
        return $this->hasOne(Poblaciones::className(), ['id' => 'poblacion_id'])->inverseOf('administradores');
    }

    public function getProvincia()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'provincia_id'])->via('poblacion');
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('administradores');
    }
}
