<?php foreach($posts as $post): ?>

	<div id="content">

	    <h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>

	    <p><?=$post['content']?></p>

	    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
	    	<br>
	        <?=Time::display($post['created'])?>
	    </time>

	</div>

<?php endforeach; ?>