<?php
use yii\helpers\Html;

$this->title = 'Posts view page';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if($post): ?>
    <div class="panel panel-default">
	  <div class="panel-heading relative">
	    <h3 class="panel-title">
	    	<?= Html::encode("$post[title]"); ?>
	    </h3>
	    <?php if(!Yii::$app->user->isGuest): ?>
		    <?php if(Yii::$app->user->identity->username === "admin"): ?>
	    	<a href="index.php?r=admin/edit&p_id=<?= Html::encode("$post[id]"); ?>"><span class="label label-success editLabel"> edit </span></a>
	    	<?php endif; ?>
    	<?php endif; ?>
    	<span class="label label-default dateLabel"><?= Html::encode("$post[postdate]") ?></span>
	  </div>
	  <div class="panel-body">
	    <?= \yii\helpers\HtmlPurifier::process("$post[content]") ?>
	  </div>
	</div>
<?php endif; ?>