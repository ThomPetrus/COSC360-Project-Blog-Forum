<?php


class UserModel extends Model {
    
    public function register() {
        
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
            if ($post['submit']) {
                
                // INSERT post to DB
                $this->query('INSERT INTO user (pw, fname, lname, email, edu, job) VALUES (:pw, :fname, :lname, :email, :edu, :job)');

                // encrypt with php 5.5 native hashing 
                $pw = password_hash($_POST['pw'], PASSWORD_BCRYPT, ['cost' => 13]);
                $this->bind(':pw', $pw);
                $this->bind(':fname', $post['fname']);
                $this->bind(':lname', $post['lname']);
                $this->bind(':email', $post['email']);
                $this->bind(':edu', $post['edu']);
                $this->bind(':job', $post['job']);

                $this->execute();

                // If successful add default portfolio into the database as well
                if ($this->last_insert_id()) {
                    
                    $userId = $this->last_insert_id();
                    
                    $this->query('INSERT INTO portfolio (userid, profile, profilePic, website, resume) VALUES (:uid, :profile, :profilePic, :website, :resume)');
                    $this->bind(':uid', $userId);
                    $this->bind(':profilePic', DEFAULT_PROFILE_IMG);
                    $this->bind(':profile', 'Insert Profile!');
                    $this->bind(':website', DEFAULT_LINK);
                    $this->bind(':resume', 'Insert Resume!');
                    
                    $this->execute();

                    $this->query('INSERT INTO portfoliopost (userid, img, title, description, link) VALUES (:uid, :img, :title,:description, :link)');                        
                    $this->bind(':uid', $userId);
                    $this->bind(':img', DEFAULT_PORTFOLIO_IMG);
                    $this->bind(':title', 'Insert Title!');
                    $this->bind(':description', 'Insert Description!');
                    $this->bind(':link', DEFAULT_LINK);
                
                    $this->execute();


                    /**
                     * Dirty / hacky - fix - Look into alternatives .. 3 default images 
                     * Explanation - I want to use the carousel, couldn't just use a foreach loop to instantiate the images
                     * into the carousel, needed to be loaded prior to creating the carousel I suppose. I settled on having 
                     * a maximum of 3 pictures in the carousel, so three defaults, and 3 latest images loaded. 
                     * */ 

                    for($i = 0; $i < 3; $i++){
                        $this->query('INSERT INTO carouselimg (userid, img, title, description) VALUES (:uid, :img, :title, :description)');
                        $this->bind(':uid', $userId);
                        $this->bind(':img', DEFAULT_PORTFOLIO_IMG);
                        $this->bind(':title', 'Insert Title!');
                        $this->bind(':description', 'Insert Description!');

                        $this->execute();
                    }

                    header('Location: '.ROOT_PATH.'users/login');
                }
            }
        }
        return;
    }

    public function forgotPass(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);        
        
        if (isset($post)) {
            if ($post['submit']) {

                $this->query("SELECT email FROM user WHERE email = :email");
                $this->bind(':email', $post['email']);
                $rows = $this->singleResult();

                echo print_r($rows);

                /*
                    NOT FUNCTIONAL -- Tried adding this last minute - did not realize it was part of base functionality, 
                    and now I am out of time.

                    Due to to hashing of passwords I can't just send them their old one.
                    I've opted to just reset the password to a random hash - from there the user can reset the password once
                    logged in.

                */

                // If email in db -> email the user
            

                    $to = $post['email'];
                    $subject = 'Recovery of your Password';
                    $txt = 'Your pass will be reset to: '.md5(uniqid(rand(), true)).'\nReset it once logged in.';
                    $headers = 'From: bagoftricks.moderator@gmail.com';
                    $x=mail($to,$subject,$txt,$headers);

                    if ($x) {
                        echo "Email sent successfully";
                    } else {
                        echo "Couldn't send email. Check your error log";
                    }   
            }
        }
        header('Location: ' . '/users/login');
    }


    public function login(){
         // Sanitize POST
         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


         if (isset($post)) {
            if ($post['submit']) {

                $this->query('SELECT * FROM user WHERE email = :email');
                $this->bind(':email', $post['email']);

                // Method in base Model class to return single result
                $row = $this->singleResult();
                
                if($row){
                    
                    if(password_verify($post['pw'], $row['pw'])){
                        echo 'pw valid 2';
                        $_SESSION['is_logged_in'] = true;
                        $_SESSION['user_data'] = array(
                            "id"        =>  $row['userid'],
                            "fname"     =>  $row['fname'],
                            "lname"     =>  $row['lname'],
                            "email"     =>  $row['email'],
                            "edu"       =>  $row['edu'],
                            "job"       =>  $row['job'],
                            "canPost"   =>  $row['canPost'],
                            "canLogIn"  =>  $row['canLogIn'],
                            "isAdmin"   =>  $row['isAdmin']
                        );

                        if($row['canLogIn'] == 0){
                            header('Location: /users/logout');
                        } else {
                            header('Location: '.ROOT_PATH.'posts');
                        }
                    } else {
                        Messages::setMsg('Invalid Email and Password Combination. Try Again.', 'error_msg');
                    }
                } else {
                    Messages::setMsg('Invalid Email and Password Combination. Try Again.', 'error_msg');
                }
                return;
             }
        }
    }

    public function changePostPrivilege(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
           if (isset($post['postPrivilege-TRUE'])) {
                $this->query('UPDATE user SET canPost = FALSE WHERE userid = :uid;');
                $this->bind(':uid', $post['uid']);
                $this->execute();
           } 
           if (isset($post['postPrivilege-FALSE'])) {
                $this->query('UPDATE user SET canPost = TRUE WHERE userid = :uid;');
                $this->bind(':uid', $post['uid']);
                $this->execute();
           }
           header('Location: ' . '/portfolio');
        }
    }

    public function changeLogPrivilege(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
            if (isset($post['logPrivilege-TRUE'])) {
                $this->query('UPDATE user SET canLogIn = FALSE WHERE userid = :uid;');
                $this->bind(':uid', $post['uid']);
                $this->execute();
           } 
           if (isset($post['logPrivilege-FALSE'])) {
                $this->query('UPDATE user SET canLogIn = TRUE WHERE userid = :uid;');
                $this->bind(':uid', $post['uid']);
                $this->execute();
           }
           header('Location: ' . '/portfolio');
        }
    }

    public function changeAdminPrivilege(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
            if (isset($post['adminPrivilege-TRUE'])) {
                $this->query('UPDATE user SET isAdmin = FALSE WHERE userid = :uid;');
                $this->bind(':uid', $post['uid']);
                $this->execute();
           } 
           if (isset($post['adminPrivilege-FALSE'])) {
                $this->query('UPDATE user SET isAdmin = TRUE WHERE userid = :uid;');
                $this->bind(':uid', $post['uid']);
                $this->execute();
           }
           header('Location: ' . '/portfolio');
        }
    }

    public function deleteUser(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
            if (isset($post['delete'])) {
                $this->query('DELETE FROM user WHERE userid = :uid');
                $this->bind(':uid', $post['uid']);
                $this->execute();
            }
        }
        header('Location: ' . '/portfolio');
    }
}

?>