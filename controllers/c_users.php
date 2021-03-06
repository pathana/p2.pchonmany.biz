<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {

        # Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = "BlogByte : Sign Up";

        # Render template
            echo $this->template;
    }

    public function p_signup() {

        # More data we want stored with the user
            $_POST['created']  = Time::now();
            $_POST['modified'] = Time::now();

        # Encrypt the password  
            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

        # Create an encrypted token via their email address and a random string
            $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

        # Insert this user into the database 
            $user_id = DB::instance(DB_NAME)->insert("users", $_POST);

        # For now, just confirm they've signed up - 
        # You should eventually make a proper View for this
            print '<script type="text/javascript">'; 
            print 'alert("You\'re signed up!")'; 
            print '</script>';

            echo "<a href='/users/login'>Click here to login</a>.";


            #$this->template->content = View::instance('v_users_registered');

            #echo $this->template;

    }

    public function login($error = NULL) {

        # Set up the view
            $this->template->content = View::instance("v_users_login");
            $this->template->title   = "BlogByte : Login";

         # Pass data to the view
            $this->template->content->error = $error;

        # Render template
            echo $this->template;
    }

    public function p_login() {

        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
            $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Retrieve the token if it's available
            $q = "SELECT token 
                FROM users 
                WHERE email = '".$_POST['email']."' 
                AND password = '".$_POST['password']."'";

            $token = DB::instance(DB_NAME)->select_field($q);   

        # If we didn't get a token back, it means login failed
            if($token == "") {

            # Send them back to the login page
            # Note the addition of the parameter "error"
                Router::redirect("/users/login/error"); 

        # But if we did, login succeeded! 
            } else {

            /* 
            Store this token in a cookie using setcookie()
            Important Note: *Nothing* else can echo to the page before setcookie is called
            Not even one single white space.
            param 1 = name of the cookie
            param 2 = the value of the cookie
            param 3 = when to expire
            param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
            */
                setcookie("token", $token, strtotime('+2 weeks'), '/');

            # Send them to the main page - or whever you want them to go
                Router::redirect("/");
    }

}

    public function logout() {

        # Generate and save a new token for next login
            $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
            $data = Array("token" => $new_token);

        # Do the update
            DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
            setcookie("token", "", strtotime('-1 year'), '/');

        # Send them back to the main index.
            Router::redirect("/");
    }

    public function profile() {

        # If user is blank, they're not logged in; redirect them to the login page
            if(!$this->user) {
                Router::redirect('/users/login');
        }

        # If they weren't redirected away, continue:

        # Setup view
            $this->template->content = View::instance('v_users_profile');
            $this->template->title   = "BlogByte : Profile of ".$this->user->first_name;

        # Render template
            echo $this->template;
    }

    public function edit() {

        # If user is blank, they're not logged in; redirect them to the login page
        if(!$this->user) 
            Router::redirect('/users/login');

        else{
            # Setup view
            $this->template->content = View::instance('v_users_edit');
            $this->template->title   = "BlogByte : Update Your Profile";

            # Render template
            echo $this->template;   
    }    
}


    public function p_edit() {

        # Sanitize the user entered data
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        $data = Array(
            "first_name" => $_POST['first_name'],
            "last_name"  => $_POST['last_name'],
            "email"      => $_POST['email'],
            "modified"   => Time::now()
            );

        DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = ".$this->user->user_id);


        # Redirect to user's profile
        Router::redirect('/users/profile');

    }


}