<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Files browser';
$baseUrl = "@web";
$this->registerJsFile($baseUrl.'/js/ajax.js', ['depends' => ['yii\web\JqueryAsset']]);
$n = 0;
?>

<div class="row">
	<div class="col-lg-9">
		ckeditor
		<table class="table table-hover" id="fTable">
			<tr>
				<th>#</th>
				<th>preview</th>
				<th>file name</th>
				<th>size</th>
				<th>actions</th>
			</tr>
			<?php foreach($files as $file): ?>
				<tr>
					<td><?php echo ++$n; ?></td>
					<td class="td-pic-ico">
						<?php if($file['image']): ?>
						    <a href="<?php echo $file['fname']; ?>" class="thumbnail">
						    	<img src="<?= $file['fname'] ?>" />
						    </a>
						<?php endif; ?>
						<?php if(!$file['image']): ?>
						    <a href="<?php echo $file['fname']; ?>" class="thumbnail">
						    	<div class="relative overflow-hidden">
						    		<img src="pics/file.png" />
						    		<span class="file-ext"><?= $file['ext'] ?></span>
						    	</div>
						    </a>
						<?php endif; ?>
					</td>
					<td>
						<a href="javascript:void(0);" onclick="getFileLink('<?=  $ckeditorFunc; ?>', '<?= $file['fname']; ?>', '');"><?= $file['fname']; ?></a>
					</td>
					<td>
						<?php echo $file['size']; ?>
					</td>
					<td>
						<button class="btn btn-danger btn-xs" f="<?php echo $file['fname']; ?>">delete</button>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div class="col-lg-3">
		<div class="panel panel-primary overflow-hidden">
			<div class="panel-heading">Upload files (up to 30)</div>
			<div class="panel-body" id="fi">
				<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
				<?= $form->field($model, 'file[]')->fileInput(['multiple' => true])->label(false) ?>
				<!-- <button class="btn btn-primary">Upload</button> -->
				<?php ActiveForm::end(); ?>
				<button class="btn btn-default" id="btn-send">Upload</button>
				<div id="fi-state"></div>
			</div>
		</div>
	</div>
</div>