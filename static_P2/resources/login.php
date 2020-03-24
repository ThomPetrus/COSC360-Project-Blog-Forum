<?php

    // Using the database class
    require 'classes/Database.php';
    $database = new Database;

    // Sanitize string from $_POST
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    if($post['submit']){

        // Retrieve User Input
        $given_email   = $post['email'];
        $given_pw      = $post['password'];
        $valid_email   = FALSE;
        $valid_pw      = FALSE;
        
        
        // Set up prepared statement
        $database->query('SELECT email, pw FROM user');
        $database->bind(':email', $given_email);
        $database->execute();

        $rows = $database->resultSet();
        echo ''.print_r($rows);

        // Result set contains any results - As long as DB is not empty.
        if(null !== ($rows[0]['email'])){    

            // Check for each user in DB
            foreach($rows as $user){

                // Using PHP hash verification method that email exists
                if(password_verify($given_email, $user['email'])){ 
                        echo 'email valid';
                        $valid_email = TRUE;

                        if(password_verify($given_pw, $user['pw'])){
                            echo 'valid pw';
                            $valid_pw =  TRUE;
                        }
                }
            }
        }

        if($valid_email && $valid_pw){
            redirect('../webcontent/forum_example.html');
        } else if($valid_email){
            redirect('../webcontent/landingPage.html?valid_pw=false');
        } else {
            redirect('../webcontent/landingPage.html?valid_pw=false&valid_email=false');
        }
    }   

    function redirect($url, $statusCode = 303){
       header('Location: ' . $url, true, $statusCode);
       die();
    }   

?>