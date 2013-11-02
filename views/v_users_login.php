<div id="content">

    <h1>Login</h1><p>

    <div id="formContent">

        <form method='POST' action='/users/p_login'>

            Email:<br>
            <input type='text' name='email' size="30">

            <br><br>

            Password:<br>
            <input type='password' name='password' size="30">

            <br><br>

            <?php if(isset($error)): ?>
                <div class='error'>
                    Login failed. Please double check your email and password.
                </div>
                <br>
            <?php endif; ?>

            <button type='submit' class="submit">Log In</button>

        </form>

    </div>
</div>