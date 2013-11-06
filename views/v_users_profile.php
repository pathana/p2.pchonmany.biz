<div id="profileContent">

    <h1>Profile of <?=$user->first_name?></h1>

    <form method="POST" action="/users/edit">

        <b>User ID:</b> <?=$user->user_id?><br>
        <b>First Name:</b> <?=$user->first_name?><br>
        <b>Last Name:</b> <?=$user->last_name?><br>
        <b>Email:</b> <?=$user->email?><br>

    <button type="submit" class="submit2">Edit Information</button>

</div>