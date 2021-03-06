<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $email
 * @property string $password
 * @property string $rol
 * @property string|null $token_acti
 * @property string|null $auth_key
 * @property string|null $banned_at
 *
 * @property Administradores $administradores
 
 * @property Empleadores $empleadores
 * @property Empleos[] $empleos
 * @property Presupuestos[] $presupuestos
 * @property Profesionales $profesionales
 * @property Valoraciones[] $valoraciones
 * @property Valoraciones[] $valoraciones0

 */
class Usuarios extends \yii\db\ActiveRecord implements IdentityInterface
{
    const SCENARIO_CREAR = 'crear';
    public $password_repeat;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'email', 'password', 'rol'], 'required'],
            [['nombre', 'email', 'password', 'rol', 'token_acti', 'auth_key'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['nombre'], 'unique'],
            [['password'], 'string', 'min' => 6],
            [['password_repeat'], 'required', 'on' => self::SCENARIO_CREAR],
            [['email'], 'required', 'on' => self::SCENARIO_CREAR],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password'],
            [['banned_at'], 'safe'], 
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
            'email' => 'Correo electronico',
            'password' => 'Contraseña',
            'password_repeat' => 'Repetir contraseña',
            'rol' => 'Rol',
            'token_acti' => 'Token Acti',
            'auth_key' => 'Auth Key',
            'banned_at' => 'Baneado',
        ]; 
    }

    /**
     * Gets query for [[Administradores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdministradores()
    {
        return $this->hasOne(Administradores::className(), ['usuario_id' => 'id'])->inverseOf('usuario');
    }

    

    /**
     * Gets query for [[Empleadores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleadores()
    {
        return $this->hasOne(Empleadores::className(), ['usuario_id' => 'id'])->inverseOf('usuario');
    }

    /**
     * Gets query for [[Empleos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleos()
    {
        return $this->hasMany(Empleos::className(), ['empleador_id' => 'id'])->inverseOf('empleador');
    }

    /**
     * Gets query for [[Presupuestos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresupuestos()
    {
        return $this->hasMany(Presupuestos::className(), ['profesional_id' => 'id'])->inverseOf('profesional');
    }

    /**
     * Gets query for [[Profesionales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesionales()
    {
        return $this->hasOne(Profesionales::className(), ['usuario_id' => 'id'])->inverseOf('usuario');
    }

    /**
     * Gets query for [[Valoraciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValoraciones()
    {
        return $this->hasMany(Valoraciones::className(), ['empleador_id' => 'id'])->inverseOf('profesional');
    }

    /**
     * Gets query for [[Valoraciones0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValoraciones0()
    {
        return $this->hasMany(Valoraciones::className(), ['profesional_id' => 'id'])->inverseOf('empleador');
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
     * Metodo para logueo de servicios 
    */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getId()
    {
        return $this->id;
    }
    /** Para logueo con cookies */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /** Para logueo con cookies */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function findPorNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }

    /**
     * Metodo que busca un usurio por email
     *
     * @param [type] $nombre
     * @return void
     */
    public static function findPorEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            if ($this->scenario === self::SCENARIO_CREAR) {
                $security = Yii::$app->security;
                $this->auth_key = $security->generateRandomString();
                $this->password = $security->generatePasswordHash($this->password);
                $this->token_acti = $security->generateRandomString();
            }
        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        
        if ($insert) {
            if ($this->rol == '0') {
                $q = (new Profesionales([
                    'usuario_id' => $this->id,
                    'nombre' => $this->nombre,
                    'apellidos' => 'xxx',
                    'telefono' => '666666666',
                    'poblacion_id' => 1,
                    'profesion_id' => 1,
                ]))->save();

            } elseif ($this->rol == '1') {
                (new Empleadores([
                    'usuario_id' => $this->id,
                    'nombre' => $this->nombre,
                    'apellidos' => 'xxx',
                    'telefono' => '666666666',
                    'poblacion_id' => 1,
                ]))->save();
                    
                } else {
                    (new Administradores([
                        'usuario_id' => $this->id,
                        'nombre' => $this->nombre,
                        'apellidos' => 'xxx',
                        'telefono' => '666666666',
                        'poblacion_id' => 1,
                    ]))->save();
                        
            }
        }
    }


   
    public function getCuentaActivada()
    {
        return $this->token_acti === null;
    }
}
