<?php
use yii\helpers\Html;

?>

<?php
/* @var $this yii\web\View */
$this->title = 'Dvixi';
?>
<div class="site-index">

    <div class="body-content">
    	<h1 class="center">DVIXI</h1>
        <div class="row">
        	<div class="col-lg-3">
    			<?php foreach ($news as $newi): ?>
    				<article class="alert alert-info relative">
    					<a href="index.php?r=site/post&p_id=<?= Html::encode("$newi[id]"); ?>"><?= Html::encode("$newi[title]") ?></a>
    					<span class="label label-default dateLabelBottom"><?= Html::encode("$newi[postdate]") ?></span>
    				</article>
    			<?php endforeach; ?>
    			<p class="right"><a href="?r=site/posts"><button type="button" class="btn btn-default btn-xs">View all posts <span class="badge"><?= Html::encode("$count") ?></span></button></a></p>
        	</div>
        	<div class="col-lg-7">
        		some content
        	</div>
        </div>

    </div>
</div>
