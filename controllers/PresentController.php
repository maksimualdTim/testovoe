<?php

namespace app\controllers;

use app\models\BaseModel;
use app\models\Category;
use app\models\Present;
use app\models\PresentSearch;
use app\models\Wishlist;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PresentController implements the CRUD actions for Present model.
 */
class PresentController extends BaseController
{
    /**
     * Creates a new Present model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Present();
        $wishlists = BaseModel::getAllWishlists();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $model->setUploadedImage();
                $model->save();
                return $this->redirect(['view', 'slug' => $model->slug]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'wishlists' => $wishlists,
        ]);
    }

    /**
     * Updates an existing Present model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $slug
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        $model = $this->findModel($slug);
        $wishlists = BaseModel::getAllWishlists();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {
            $model->setUploadedImage();
            $model->save();
            return $this->redirect(['view', 'slug' => $model->slug]);
        }

        return $this->render('update', [
            'model' => $model,
            'wishlists' => $wishlists,
        ]);
    }
}
