<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Posts view page';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Posts</h1>
<?php foreach ($posts as $post): ?>
    <div class="panel panel-default">
	  <div class="panel-heading relative">
	    <h3 class="panel-title">
	    	<a href="index.php?r=site/post&p_id=<?= Html::encode("$post->id"); ?>"><?= Html::encode("{$post->title}") ?></a>
	    </h3>
	    <?php if(!Yii::$app->user->isGuest): ?>
		    <?php if(Yii::$app->user->identity->username === "admin"): ?>
	    	<a href="index.php?r=admin/edit&p_id=<?= Html::encode("$post[id]"); ?>"><span class="label label-success editLabel"> edit </span></a>
	    	<?php endif; ?>
    	<?php endif; ?>
    	<span class="label label-default dateLabel"><?= Html::encode("{$post->postdate}") ?></span>
	  </div>
	  <div class="panel-body">
	    <?= \yii\helpers\HtmlPurifier::process("$post->content") ?>
	  </div>
	</div>
<?php endforeach; ?>

<div class="block-center center"><?= LinkPager::widget(['pagination' => $pagination]) ?></div>