<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Files extends Model
{
	public $file;
	
	public function listFiles() {
		return \yii\helpers\FileHelper::findFiles('uploads',['except'=>['*.php','*.htaccess']]);
	}
	
	public function listFilesFull() {
		$files = [];
		$fList = \yii\helpers\FileHelper::findFiles('uploads',['except'=>['*.php','*.htaccess']]);
		foreach ($fList as $file) {
			$mime = \yii\helpers\FileHelper::getMimeType($file);
			$size = round(filesize($file) / 1024 , 2, PHP_ROUND_HALF_UP) . " KB";
			$isImage = (strpos($mime, 'image') !== false) ? true : false;
			$extension = pathinfo($file, PATHINFO_EXTENSION);
			$files[] = ['fname' => $file, 'ext' => $extension, 'size' => $size, 'mime' => $mime, 'image' => $isImage];
		}
		return $files;
	}
	
	public function removeFile($f) {
		return unlink($f);
	}
	
	public function rules() {
		return [
			[['file'], 'file', 'maxFiles' => 30]
		];
	}
}