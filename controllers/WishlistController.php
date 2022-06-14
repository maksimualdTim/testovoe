<?php

namespace app\controllers;

use app\models\BaseModel;
use app\models\Category;
use app\models\Wishlist;
use app\models\WishlistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WishlistController implements the CRUD actions for Wishlist model.
 */
class WishlistController extends BaseController
{
    /**
     * Creates a new Wishlist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Wishlist();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'slug' => $model->slug]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $categories = BaseModel::getAllCategories();
        return $this->render('create', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    /**
     * Updates an existing Wishlist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $slug ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        $model = $this->findModel($slug);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'slug' => $model->slug]);
        }

        $categories = BaseModel::getAllCategories();
        $selected = $model->getSelectedCategories();
        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
            'selected' => $selected,
        ]);
    }
}
