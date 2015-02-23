<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AdminForm extends Model {
	public $title;
	public $content;
	public $postDate;
	
	public function rules()
    {
        return [
            [['title', 'content'], 'required']
        ];
    }
}

?>