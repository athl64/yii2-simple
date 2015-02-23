<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin page';
$baseUrl = "@web";
$this->registerJsFile($baseUrl.'/ckeditor/ckeditor.js',['position' => '1']);
?>

<div class="row">
	<div class="col-lg-12">
        <?php $form = ActiveForm::begin(['id' => 'Admin-Form']); ?>
            <?= $form->field($model, 'title') ?>
            <?= $form->field($model, 'content')->textArea(['rows' => 30]) ?>
            <div class="form-group">
                <?= Html::submitButton('Post', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
        <?php ActiveForm::end(); ?>
        <script>CKEDITOR.replace('adminform-content',{filebrowserBrowseUrl : 'index.php?r=admin/files-ckeditor', height : '500px'})</script>
	</div>
</div>