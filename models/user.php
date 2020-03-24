<?php

class UserModel extends Model {
    public function register() {
        
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
            if ($post['submit']) {
                
                // INSERT post to DB
                $this->query('INSERT INTO users (pw, fname, lname, email, edu, job) VALUES (:pw, :fname, :lname, :email, :edu, :job)');

                // encrypt with php 5.5 native hashing 
                $pw = password_hash($_POST['pw'], PASSWORD_BCRYPT, ['cost' => 13]);
                $this->bind(':pw', $pw);
                $this->bind(':fname', $post['fname']);
                $this->bind(':lname', $post['lname']);
                $this->bind(':email', $post['email']);
                $this->bind(':edu', $post['edu']);
                $this->bind(':job', $post['job']);

                $this->execute();

                if ($this->last_insert_id()) {
                    header('Location: '.ROOT_PATH.'users/login');
                }
            }
            return;
        }
    }
}
/*
 
    if($post['submit']){
        $email   = $post['inputEmail'];
        $email_hash = password_hash($email, PASSWORD_BCRYPT, ['cost' => 13]);
        $pw      = $post['inputPassword'];
        $pw_hash = password_hash($pw, PASSWORD_BCRYPT, ['cost' => 13]);
        $fname   = $post['inputFirstName'];
        $fname_hash = password_hash($fname, PASSWORD_BCRYPT, ['cost' => 13]);
        $lname   = $post['inputLastName'];
        $lname_hash = password_hash($lname, PASSWORD_BCRYPT, ['cost' => 13]);
        $edu     = $post['inputEducation'];
        $edu_hash = password_hash($edu, PASSWORD_BCRYPT, ['cost' => 13]);
        $job     = $post['inputJob'];
        $job_hash = password_hash($job_hash, PASSWORD_BCRYPT, ['cost' => 13]);

        $database->query('INSERT INTO user (pw,fname, lname, email, edu, job) VALUES (:pw, :fname, :lname, :email, :edu, :job)');
        $database->bind(':pw', $pw_hash);
        $database->bind(':fname', $fname_hash);
        $database->bind(':lname', $lname_hash);
        $database->bind(':email', $email_hash);
        $database->bind(':edu', $edu_hash);
        $database->bind(':job', $job_hash);
        $database->execute();
        
        redirect('../webcontent/landingPage.html');         
    }

   

    function redirect($url, $statusCode = 303){
        header('Location: ' . $url, true, $statusCode);
        die();
     }
 
 
 */



?>