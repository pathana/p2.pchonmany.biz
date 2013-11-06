<?php foreach($posts as $post): ?>

	<div id="content">

	    <h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>

	    <p><?=$post['content']?></p>

	    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
	    	<br>
	        <?=Time::display($post['created'])?>
	        <br><br>
	        <!--Social Media Links-->
	        	<!--Google+-->
		        <g:plusone></g:plusone>

		        <!--Facebook-->
		        <div class="fb-like" data-href="http://p2.pchonmany.biz" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false"></div>

		       	<!--Twitter-->
		        <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="YourSite">Tweet</a>

		        <!--Reddit-->
		        <a href="http://www.reddit.com/submit" onclick="window.location = 'http://www.reddit.com/submit?url=' + encodeURIComponent(window.location); return false"> <img src="http://www.reddit.com/static/spreddit7.gif" alt="submit to reddit" border="0" /> </a>
	    </time>

	</div>
<br>
<?php endforeach; ?>