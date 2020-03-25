<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleadores".
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
class Empleadores extends \yii\db\ActiveRecord
{
    private $_provincia = null;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleadores';
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
            [['!provincia'], 'safe'],
            [['usuario_id'], 'unique'],
            [['poblacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poblaciones::className(), 'targetAttribute' => ['poblacion_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['provincia'], );
    }

    public function setProvincia($provincia)
    {
        $this->_provincia = $provincia;
    }

    public function getProvincia()
    {
        if ($this->_provincia === null && !$this->isNewRecord) {
            $this->setProvincia($this->getNom()['nombre']);
        }
        return $this->_provincia;
    }

    public function getProvinci()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'provincia_id'])->via('poblacion');
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
            'telefono' => 'Teléfono',
            'direccion' => 'Dirección',
            'created_at' => 'Created At',
            'poblacion_id' => 'Población',
        ];
    }

    /**
     * Gets query for [[Poblacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPoblacion()
    {
        return $this->hasOne(Poblaciones::className(), ['id' => 'poblacion_id'])->inverseOf('empleadores');
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('empleadores');
    }

    public function getNom() {

        $nombre = (new \yii\db\Query())
         ->select("prov.nombre")
         ->from('empleadores e')
         ->join('left join', 'poblaciones po', 'e.poblacion_id = po.id')
         ->join('left join', 'provincias prov', 'po.provincia_id = prov.id')
         ->where(['usuario_id' => $this->usuario_id])
         ->one();
        
         return $nombre;
        
    }
}
