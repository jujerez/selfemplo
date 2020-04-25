<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $recordarme = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['recordarme', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['username', 'validateCuenta'],
        ];
    }

    /**
     * Comprueba si la cuenta del usuario está activada o no.
     * @param  string $attribute  El atributo que se está validando.
     * @param  array  $params     the additional name-value pairs given in the rule
     */
    public function validateCuenta($attribute, $params)
    {
        $usuario = Usuarios::findOne(['nombre'=>$this->username]);

        if ($usuario!==null) {
       
            if (!$usuario->cuentaActivada) {
                $this->addError(
                    $attribute,
                    'Para iniciar sesión deberá activar su cuenta por correo electronico '
        
                );
            }
        }
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Usuario o contraseña incorrecta.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if ($this->getUser()->banned_at === null) {
                
                return Yii::$app->user->login($this->getUser(), $this->recordarme ? 3600*24*30 : 0);
            } else {
                Yii::$app->session->setFlash('danger', 'Usuario banneado, solicite activación al administrador');
                    return false; 
            }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuarios::findPorNombre($this->username);
        }

        return $this->_user;
    }
}
