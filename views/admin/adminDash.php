<?php
use yii\helpers\Html;

$this->title = 'Admin dashboard';
$this->params['breadcrumbs'][] = $this->title;
$baseUrl = "@web";
?>

<div class="row">
	<div class="col-lg-12">
        <a href="index.php?r=admin/add-post"><button class="btn btn-default">Add post</button></a>
        <a href="index.php?r=admin/files"><button class="btn btn-default">List files</button></a>
	</div>
</div>