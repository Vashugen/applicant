<?php

namespace frontend\models\administratorEngine;

use backend\models\Kafe;
use common\models\User;
use common\models\UserProfile;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Create user form
 */
class UserForm extends Model
{
    public $username;
    public $kafe_id;
    public $email;
    public $password;
    public $status;
    public $roles;

    private $model;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'filter' => function ($query) {
                if (!$this->getModel()->isNewRecord) {
                    $query->andWhere(['not', ['id' => $this->getModel()->id]]);
                }
            }],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['city_id', 'string', 'min' => 1, 'max' => 255],
            ['kafe_id', 'string', 'min' => 1],
            ['password', 'required', 'on' => 'create'],
            ['password', 'string', 'min' => 6],

            [['status'], 'boolean'],
            [['roles'], 'each',
                'rule' => ['in', 'range' => ArrayHelper::getColumn(
                    Yii::$app->authManager->getRoles(),
                    'name'
                )]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('frontend', 'Username'),
            'city_id' => Yii::t('frontend', 'city_id'),
            'kafe_id' => Yii::t('frontend', 'kafe_id'),
            'email' => Yii::t('frontend', 'Email'),
            'password' => Yii::t('frontend', 'Password'),
            'roles' => Yii::t('frontend', 'Roles')
        ];
    }

    public function setModel($model)
    {

        $this->username = $model->username;
        $this->email = $model->email;
        $this->city_id = $model->city_id;
        $this->city_id = $model->cityin;
        $this->kafe_id = $model->kafe_id;
        $this->kafe_array = $model->kafe_array;
        $this->status = $model->status;
        $this->model = $model;
        $this->roles = ArrayHelper::getColumn(
            Yii::$app->authManager->getRolesByUser($model->getId()),
            'name'
        );
        return $this->model;
    }

    public function getModel()
    {
        if (!$this->model) {
            $this->model = new User();
        }
        return $this->model;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save()
    {
        if ($this->validate()) {
            $model = $this->getModel();

            $model->kafe_id = $this->kafe_id;
            $isNewRecord = $model->getIsNewRecord();
            $model->username = $this->username;
            $model->status = $this->status;
            //print_r($model); exit;
            if ($this->password) {
                $model->setPassword($this->password);
            }

            if ($model->save() && $isNewRecord) {
                $model->afterSignup();
            }

            $auth = Yii::$app->authManager;
            $auth->revokeAll($model->getId());

            if ($this->roles && is_array($this->roles)) {
                foreach ($this->roles as $role) {
                    $auth->assign($auth->getRole($role), $model->getId());
                }
            }

            return !$model->hasErrors();
        }

        return null;
    }
}
