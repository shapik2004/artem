<?php

namespace app\controllers;

use app\models\Albums;
use app\models\Foto;
use app\models\FotoForm;
use app\models\Fotos;
use app\models\Info;
use app\models\NewAlbum;
use app\models\UserForm;
use app\models\UserInfo;
use app\models\Users;
use Faker\Provider\DateTime;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use yii\imagine\Image;



class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
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
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionUserform()
    {
        $model = new UserForm();
        if ($model->load(Yii::$app->request->post())&& $model->validate()):
            if($users=$model->signup()):
                if($users->status===Users::STATUS_ACTIVE):
                    if(Yii::$app->getUser()->login($users)):
                        return $this->goHome();
                    endif;
                endif;
            else:
            Yii::$app->session->setFlash('error','Возникла ошибка при регистрации');
            Yii::error('Ошибка при регистрации');
                return $this->refresh();
            endif;
        endif;





        return $this->render('userform', ['model' => $model]);


    }
    public function actionFotoform()
    {
        $model = new FotoForm();
        $id_album=Yii::$app->request->get('id_album',0);
        if($model->load(Yii::$app->request->post()))
        {
            $model->id_album=$id_album;
            $model->file=UploadedFile::getInstance($model,'file');
            $name_foto=DateTime::date();
            $foto_path ='upload/'.$name_foto.'.'.$model->file->extension;

            $model->file->saveAs('upload/'.$name_foto.'.'.$model->file->extension);
            $model->foto_path=$foto_path.'small.jpg';

            $this->fotoResize($foto_path);
            if($fotos=$model->add());
            return $this->redirect(['album','id'=>$id_album]);

        }

        return $this->render('fotoform',['model'=>$model,'id_album'=>$id_album]);
    }

    private function fotoResize($foto_path){
        Image::thumbnail($foto_path,240,240)
            ->save(Yii::getAlias($foto_path.'small.jpg'), ['quality'=>50]);

   }

    public function actionUsers()
    {
        $users = Users::find()->all();
        return $this->render('users', ['users' => $users]);


    }
    public function actionAlbums()
    {   $id_user=Yii::$app->request->get('id_user',0);
        $albums=Albums::find()->where(['user_id'=>$id_user])->all();
        return $this->render('albums',['albums'=>$albums,'user_id'=>$id_user]);
    }

    public function actionInfo($id)
    {
        return $this->render('userinfo', [
            'model' => $this->findModel($id),
        ]);


    }
    public function actionNewAlbum(){
        $model=new NewAlbum();
        $id_user=Yii::$app->request->get('id_user',0);
        $model->user_id=$id_user;
        if($model->load(Yii::$app->request->post()) && $model->save())

        {
            //$model->user_id=$id_user;
         // $model->add(['user_id'=>$id_user]);
          //$model->save();
            return $this->redirect([ 'album','model'=>$model,'id'=>$model->id,'user_id'=>$id_user]);
        }

        return $this->render('newalbumform',['model'=>$model,'user_id'=>$id_user]);

    }
    public function actionUpdate($id){

        $model=$this->findAlbums($id);

        //$model=NewAlbum::findOne(['id'=>$id]);
            if($model->load(Yii::$app->request->post())&& $model->save())
            {

                return $this->redirect(['albums', 'id_user' => $model->user_id]);
            } else
            {
                return $this->render('updatealbum', [
                    'model' => $model,
                ]);
            }
    }
    public function actionDelete($id){
        $modelalbums=$this->findAlbums($id);
        $model=$this->beforeDelete($id);
        Yii::getLogger()->log('files:'.print_r($model, true), YII_DEBUG);
        if($model!==false) {
            foreach ($model as $foto)
                $foto->delete();
                unlink($foto->foto_path);
                unlink(substr($foto->foto_path, 0, -9));
            $this->findAlbums($id)->delete();
        }
        else
            $this->findAlbums($id)->delete();

        return $this->redirect(['albums','id_user'=>$modelalbums->user_id]);
    }
    public function actionAlbum($id)
    {  $query=Fotos::find()->where(['id_album'=>$id]);
       // $model=Fotos::findAll(['id_album'=>$id]);
        $pagination=new Pagination(
            [
                'defaultPageSize'=>9,
                'totalCount'=>$query->count()
            ]
        );
        $model=$query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('albumview',['model'=>$model,'id'=>$id,

            'pagination'=>$pagination]);

    }
        protected function beforeDelete($id)
        {
            if(($fotos=Fotos::findAll(['id_album'=>$id]))){
                Yii::getLogger()->log('files:'.print_r($fotos, true), YII_DEBUG);
                return $fotos;}

            else {
                return false;
               // throw new NotFoundHttpException('The requested page does not exist.');
            }
        }


    protected function findAlbums($id){
        if(($model = NewAlbum::findOne($id))!==null)

            return $model;
        else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
