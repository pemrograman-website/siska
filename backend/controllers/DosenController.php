<?php

namespace backend\controllers;

use Yii;
use backend\models\Dosen;
use backend\models\DosenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * DosenController implements the CRUD actions for Dosen model.
 */
class DosenController extends Controller
{
    // Definisikan semua parameter di sini.
    private static function setParams()
    {
        // Parameter 'imageUrl' untuk mengakses url dari foto dosen
        Yii::$app->params['imageUrl'] = Yii::getAlias('@web/uploads/img/');
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Dosen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DosenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Dosen model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Dosen #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Dosen model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        self::setParams();

        $request = Yii::$app->request;
        $model = new Dosen();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Dosen",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post())) {

                // Kontainer untuk isi files
                $fotoImage = $model->uploadFotoImage();

                if ($model->save()) {
                    if ($fotoImage !== false) {
                        // simpan foto
                        $path = $model->getFotoWeb();
                        $fotoImage->saveAs($path);
                    } else {
                        // Error jika foto tdk bs diupload
                    }


                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Dosen",
                        'content' => '<span class="text-success">' . Yii::t('yii2-ajaxcrud', 'Create') . ' Dosen ' . Yii::t('yii2-ajaxcrud', 'Success') . '</span>',
                        'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                    ];
                }

                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Dosen",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                return $this->redirect(['view', 'id' => $model->id]);

                // Kontainer untuk isi files
                $fotoImage = $model->uploadFotoImage();

                if ($model->save()) {
                    if ($fotoImage !== false) {
                        // simpan foto
                        $path = $model->getFotoWeb();
                        $fotoImage->saveAs($path);
                    } else {
                        // Error jika foto tdk bs diupload
                    }
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }


    /**
     * Updates an existing Dosen model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        self::setParams();

        $request = Yii::$app->request;
        $model = $this->findModel($id);

        $oldFotoImage = $model->getFotoWeb();
        $oldFotoSrc = $model->foto_src;
        $oldFotoWeb = $model->foto_web;

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Dosen",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post())) {

                // Kontainer untuk isi files
                $fotoImage = $model->uploadFotoImage();

                // Kembalikan isi basisdata ke foto lama jika tidak ada foto baru yang diunggah
                if ($fotoImage === false) {
                    $model->foto_src = $oldFotoSrc;
                    $model->foto_web = $oldFotoWeb;
                }

                if ($model->save()) {
                    if ($fotoImage !== false) {
                        // simpan foto baru
                        $path = $model->getFotoWeb();
                        $fotoImage->saveAs($path);

                        // Hapus foto lama 
                        if (!is_null($oldFotoImage) && file_exists($oldFotoImage)) {
                            unlink($oldFotoImage);
                        }
                    } else {
                        // Error jika foto tdk bs diupload
                    }


                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Dosen",
                        'content' => '<span class="text-success">' . Yii::t('yii2-ajaxcrud', 'Create') . ' Dosen ' . Yii::t('yii2-ajaxcrud', 'Success') . '</span>',
                        'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                    ];
                }

                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Dosen",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                return $this->redirect(['view', 'id' => $model->id]);

                // Kontainer untuk isi files
                $fotoImage = $model->uploadFotoImage();

                // Kembalikan isi basisdata ke foto lama jika tidak ada foto baru yang diunggah
                if ($fotoImage === false) {
                    $model->foto_src = $oldFotoSrc;
                    $model->foto_web = $oldFotoWeb;
                }

                if ($model->save()) {
                    if ($fotoImage !== false) {
                        // simpan foto
                        $path = $model->getFotoWeb();
                        $fotoImage->saveAs($path);
                    } else {
                        // Error jika foto tdk bs diupload
                    }
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Dosen model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->delete();

        // Hapus file foto
        if (!$model->deleteFotoWeb()) {
            Yii::$app->session->setFlash('error', 'Error deleting image');
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing Dosen model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Dosen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dosen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dosen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
