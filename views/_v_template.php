<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />   
    <!-- Common CSS/JSS -->
    <link rel="stylesheet" href="/css/app.css" type="text/css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

    <!-- Controller Specific CSS/JS -->
    <?php if(isset($client_files_head)) echo $client_files_head; ?>
    <link rel="stylesheet" href="/css/app.css" type="text/css">

</head>

<body>	
<!--Facebook Like Button for Posts-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div id="header">

    <ul>
        <li>
            <a href='/'>Home</a>
        </li>

            <!-- Menu for users who are logged in -->
            <?php if($user): ?>

                <li>
                    <a href='/users/logout'>Logout</a>
                </li>
                <li>
                    <a href='/users/profile'>Profile</a>
                </li>
                <li>
                    <a href='/posts'>Posts</a>
                </li>
                <li>
                    <a href='/posts/add'>New Post</a>
                </li>
                <li>
                    <a href='/posts/users'>Users</a>
                </li>

            <!-- Menu options for users who are not logged in -->
            <?php else: ?>
            <li>
                <a href='/users/signup'>Sign up</a>
            </li>
            <li>
                <a href='/users/login'>Log in</a>
            </li>

            <?php endif; ?>
    </ul>

    </div>

    <br>

		<?php if(isset($content)) echo $content; ?>

		<?php if(isset($client_files_body)) echo $client_files_body; ?>
		
</body>
</html>