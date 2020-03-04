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
 *
 * @property Administradores $administradores
 * @property Comentarios[] $comentarios
 * @property Comentarios[] $comentarios0
 * @property Empleadores $empleadores
 * @property Empleos[] $empleos
 * @property Presupuestos[] $presupuestos
 * @property Profesionales $profesionales
 * @property Votos[] $votos
 * @property Votos[] $votos0
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
            [['password_repeat'], 'required', 'on' => self::SCENARIO_CREAR],
            [['email'], 'required', 'on' => self::SCENARIO_CREAR],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password'],
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
        ];
    }

    /**
     * Gets query for [[Administradores]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getAdministradores()
    {
        return $this->hasOne(Administradores::className(), ['usuario_id' => 'id']);
    }*/

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['empleador_id' => 'id']);
    }*/

    /**
     * Gets query for [[Comentarios0]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getComentarios0()
    {
        return $this->hasMany(Comentarios::className(), ['profesional_id' => 'id']);
    }*/

    /**
     * Gets query for [[Empleadores]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getEmpleadores()
    {
        return $this->hasOne(Empleadores::className(), ['usuario_id' => 'id']);
    }*/

    /**
     * Gets query for [[Empleos]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getEmpleos()
    {
        return $this->hasMany(Empleos::className(), ['empleador_id' => 'id']);
    }*/

    /**
     * Gets query for [[Presupuestos]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getPresupuestos()
    {
        return $this->hasMany(Presupuestos::className(), ['profesional_id' => 'id']);
    }*/

    /**
     * Gets query for [[Profesionales]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getProfesionales()
    {
        return $this->hasOne(Profesionales::className(), ['usuario_id' => 'id']);
    }*/

    /**
     * Gets query for [[Votos]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getVotos()
    {
        return $this->hasMany(Votos::className(), ['empleador_id' => 'id']);
    }*/

    /**
     * Gets query for [[Votos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getVotos0()
    {
        return $this->hasMany(Votos::className(), ['profesional_id' => 'id']);
    }*/

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
            }
        }

        return true;
    }


}
