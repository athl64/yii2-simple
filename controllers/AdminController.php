<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
//use yii\data\Pagination;
use app\models\LoginForm;
use app\models\AdminForm;
use app\models\Posts;
use app\models\Files;

class AdminController extends Controller
{
	public function actionIndex() {
		if(Yii::$app->user->isGuest) {
			return Yii::$app->user->loginRequired();
		} else if(Yii::$app->user->identity->username === "admin") {
			/* continue */
			return $this->render('adminDash');
		} else {
			return $this->render('unautorised');
		}
	}
	
	/* add post page */
	public function actionAddPost() {
		if(Yii::$app->user->isGuest) {
			return Yii::$app->user->loginRequired();
		} else if(Yii::$app->user->identity->username === "admin") {
			/* continue */
		} else {
			return $this->render('unautorised');
		}
		
		$model = new AdminForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        	Posts::insertPost($model->title, $model->content);
            return $this->render('adminPre', ['model' => $model]);
        } else {
            return $this->render('addPost', ['model' => $model]);
        }
	}
	
	/* edit existing post */
	public function actionEdit() {
		if(Yii::$app->user->identity->username === "admin") {
			$id = Yii::$app->getRequest()->getQueryParam('p_id');
			$model = new AdminForm();
			if($id != null) {
				if($model->load(Yii::$app->request->post()) && $model->validate()) {
					Posts::updatePost($id,$model->title,$model->content);
					return $this->render('adminPre', ['model' => $model]);
				} else {
					$post = Posts::getPostById($id);
					$model->title = $post['title'];
					$model->content = $post['content'];
					return $this->render('addPost',['model' => $model]);
				}
			} else {
				return "page does'n selected";
			}
		} else {
			return $this->render('unautorised');
		}
	}
	
	/* web-page filebrowser */
	public function actionFiles() {
		if(Yii::$app->user->isGuest) {
			return Yii::$app->user->loginRequired();
		} else if(Yii::$app->user->identity->username === "admin") {
			/* continue */
			$filesModel = new Files();
			if(Yii::$app->request->isPost) {
				/* upload file */
				$filesModel->file = UploadedFile::getInstances($filesModel,'file');
				if ($filesModel->file && $filesModel->validate()) {
					foreach ($filesModel->file as $file) {
					    $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
					}
				}
				//return "is post";
			}
			$list = Files::listFilesFull();
			return $this->render('filesBrowser', ['files' => $list, 'model' => $filesModel]);
		} else {
			return $this->render('unautorised');
		}
	}
	
	/* ckeditor files browser */
	public function actionFilesCkeditor() {
		if(Yii::$app->user->isGuest) {
			return Yii::$app->user->loginRequired();
		} else if(Yii::$app->user->identity->username === "admin") {
			/* continue */
			$filesModel = new Files();
			if(Yii::$app->request->isPost) {
				/* upload file */
				$filesModel->file = UploadedFile::getInstances($filesModel,'file');
				if ($filesModel->file && $filesModel->validate()) {
					foreach ($filesModel->file as $file) {
					    $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
					}
				}
				//return "is post";
			} else if(Yii::$app->request->isGet) {
				$ckedFunc = Yii::$app->request->get('CKEditorFuncNum');
				$list = Files::listFilesFull();
				return $this->render('ckeditorFiles', ['files' => $list, 'model' => $filesModel, 'ckeditorFunc' => $ckedFunc]);
			}
			$list = Files::listFilesFull();
			return $this->render('filesBrowser', ['files' => $list, 'model' => $filesModel]);
		} else {
			return $this->render('unautorised');
		}
	}
	
	/* ajax files upload (multiple) */
	public function actionSilentUpload() {
		if(!Yii::$app->user->isGuest) {
			if(Yii::$app->user->identity->username === "admin") {
				/* uploading proccess */
				$model = new Files();
				if(Yii::$app->request->isPost) {
					$model->file = UploadedFile::getInstances($model,'file');
					if ($model->file && $model->validate()) {
						foreach ($model->file as $file) {
							$file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
						}
						return "OK";
					}
				}
				return "OK_EMPTY";
			} else {
				return "GTFO";
			}
		} else {
			return "GTFO";
		}
	}
	
	/* ajax file remove (single) */
	public function actionSilentRemove() {
		if(!Yii::$app->user->isGuest) {
			if(Yii::$app->user->identity->username === "admin") {
				/* removing */
				$fPath = Yii::$app->request->post('f_path');
				if(Yii::$app->request->isPost && $fPath) {
					Files::removeFile($fPath);
					return "OK_REMOVED " . $fPath;
				}
				return "OK_WRONG_COMMAND";
			} else {
				return "GTFO";
			}
		} else {
			return "GTFO";
		}
	}
}