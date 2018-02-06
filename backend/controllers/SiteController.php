<?php
namespace backend\controllers;

use app\models\AccountSearch;
use app\models\itemsSearch;
use common\models\AdminLoginForm;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'api', 'doc'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'doc' => [
                'class' => 'light\swagger\SwaggerAction',
                'restUrl' => Url::to(['/site/api'], true),
            ],
            'api' => [
                'class' => 'light\swagger\SwaggerApiAction',
                'scanDir' => [
                    Yii::getAlias('@app/../api/modules/swagger'),
                    Yii::getAlias('@app/../api/modules/catalog'),
                    Yii::getAlias('@app/../api/modules/user')
                ],
                'api_key' => ''
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $accountSearchModel = new AccountSearch();
        $accountSearchModel->status = 0;
        $accountDataProvider = $accountSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'accountDataProvider' => $accountDataProvider,
        ]);

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        /*$users = User::find()->all();

        foreach($users as $user) {
            $user->setPassword('admin123');
            $user->save();
        }*/

        $this->layout = 'before_login';

        if (!Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->user->getReturnUrl());
        }

        $model = new AdminLoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['/']);
    }
}
