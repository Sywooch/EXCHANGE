<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 12.12.16
 * Time: 5:13
 */
$this->title = $model->title;
?>

<div class="full-page">
	<div class="container">
		<h1><?=$this->title?></h1>
		<div class="text">
			<?=$model->content?>
		</div>
	</div>
</div><!-- /.full-page -->
