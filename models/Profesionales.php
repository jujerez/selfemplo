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
    private $_provincia = null;
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
            [['telefono'], 'match', 'pattern' =>'/(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/'],
            [['!provincia'], 'safe'],
            [['poblacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poblaciones::className(), 'targetAttribute' => ['poblacion_id' => 'id']],
            [['profesion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesiones::className(), 'targetAttribute' => ['profesion_id' => 'id']],
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
            'slogan' => 'Slogan',
            'created_at' => 'Created At',
            'poblacion_id' => 'Población',
            'profesion_id' => 'Profesion ID',
            'provincia' => 'Provincia'
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

   
    public function getNom() {

        $nombre = (new \yii\db\Query())
         ->select("prov.nombre")
         ->from('profesionales pr')
         ->join('left join', 'poblaciones po', 'pr.poblacion_id = po.id')
         ->join('left join', 'provincias prov', 'po.provincia_id = prov.id')
         ->where(['usuario_id' => $this->usuario_id])
         ->one();
        
         return $nombre;
        
    }

    
}
