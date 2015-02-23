<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Posts extends ActiveRecord
{
	public function insertPost($title, $content) {
		Yii::$app->db->createCommand()->insert('posts', [
			'id' => '',
			'pagename' => $title,
		    'title' => $title,
		    'content' => $content,
		    'postdate' => ''
		])->execute();
	}
	
	public function updatePost($id, $title, $content) {
		Yii::$app->db->createCommand()->update('posts', [
			'pagename' => $title,
			'title' => $title,
			'content' => $content,
		],'id = :ID')->bindValue(':ID', $id)->execute();
	}
	
	public function getAllPosts() {
		$sql = Yii::$app->db->createCommand('select id, pagename, title, content, postdate from posts order by id desc');
		return $sql;
	}
	
	public function getPostById($id) {
		$sql = Yii::$app->db->createCommand('select id, pagename, title, content, postdate from posts where id=:ID');
		$request = $sql->bindValue(':ID',$id)->queryOne();
		return $request;
	}
	
	public function getLastPosts() {
		$sql = Yii::$app->db->createCommand('select id, pagename, title, content, postdate from posts order by id desc limit 5')->queryAll();
		return $sql;
	}
}