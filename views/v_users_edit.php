<?php if(isset($user->token)){ ?>

<div id="content">

	<div id="formContent">

	<h1><?php echo "Update Your Profile"; ?></h1>

		<form method="POST" action="/users/p_edit">
			<label>First Name:</label><br>
			<?php $info = $user->first_name; ?>
			 <input type="text" name="first_name" size="30" value="<?php echo $info; ?>"><br><br>

			<label>Last Name:</label><br>
			<?php $info = $user->last_name; ?>
			<input type="text" name="last_name" size="30" value="<?php echo $info; ?>"><br><br>

			<label>Email:</label><br>
			<?php $info = $user->email; ?>
			<input type="text" name="email" size="30" value="<?php echo $info; ?>"><br><br>
		
		<br/>

	        <button type="submit" class="submit">Update</button>

		</form>
                                
    </div>

</div>

<?php } ?>