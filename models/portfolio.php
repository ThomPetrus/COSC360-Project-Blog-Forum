<?php
class PortfolioModel extends Model{
    public function Index(){
        return;
    } 
    
    public function search(){ 
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
           if ($post['submit']) {

               $this->query('SELECT * FROM user 
                            WHERE (fname LIKE :query
                                OR lname LIKE :query
                                OR job LIKE :query
                                OR email LIKE :query
                                OR edu LIKE :query)');                                

               $this->bind(':query', '%'.$post['query'].'%');
               
               $this->execute();

               return $this->resultSet();
        
           }
        }
    }
    
    public function portfolioPage(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
           if ($post['submit']) {
               $uid = $post['userId'];       

               // Once again kind of a dirty fix for the carousel but it works...
               $this->query('SELECT * FROM carouselimg 
                                WHERE userid = :uid 
                                ORDER BY datePosted DESC 
                                LIMIT 3');
               $this->bind(':uid', $uid);
               $this->execute();
               $carouselImages = $this->resultSet();

               $this->query('SELECT * FROM portfoliopost 
                                WHERE userid=:uid 
                                ORDER BY datePosted ASC');
               $this->bind(':uid', $uid);
               $this->execute();
               $portfolioPosts = $this->resultSet();

               $this->query('SELECT * FROM portfolio AS P
                                JOIN user AS U 
                                ON U.userid = P.userid
                                WHERE P.userid =:uid');
               $this->bind(':uid', $uid);
               $this->execute();
               $portfolio = $this->resultSet();

               return array('portfolio'=>$portfolio, 'posts'=>$portfolioPosts, 'carousel'=>$carouselImages);
            }
        } else {
            header('Location: ' . ROOT_PATH);
        }
    }

    public function addPost(){
         // Sanitize POST
         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

         if (isset($post)) {
            if($post['submit']) {

                $img=null; 
                $target = "uploads_posts/"; 
                $msg="";

                if(isset($_FILES['img'])){
                    
                    if(getImagesize($_FILES['img']['tmp_name'])){
                        $img = $_FILES['img']['name'];
                        $target = $target.basename($img);
                    }
                }

                // INSERT post into DB
                $this->query('INSERT INTO portfoliopost (userid, title, description, link, img) 
                                        VALUES (:uid, :title, :description, :link, :img)');
                
                //Change when log in is available
                $this->bind(':uid', $_SESSION['user_data']['id']);
                $this->bind(':title', $post['title']);
                $this->bind(':description', $post['description']);
                $this->bind(':link', $post['link']);
                
                if(isset($img)){
                    $this->bind(':img', '/uploads_posts/'.$img);
                } 

                $this->execute();

                if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){
                    $msg = "Upload Successful!";
                    echo $msg;
                } else {
                    $msg = "Failed to Upload Image";
                    echo $msg;
                }
            }
        }
        // FIGURE OUT AJAX - slides? 
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


    public function editPortfolioCarousel(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
           if($post['submit']) {

               $img=null; 
               $target = "uploads_posts/"; 
               $msg="";

               if(isset($_FILES['carousel-img'])){
                   
                   if(getImagesize($_FILES['carousel-img']['tmp_name'])){
                       $img = $_FILES['carousel-img']['name'];
                       $target = $target.basename($img);
                   }
               }
            

                $this->query('INSERT INTO carouselImg (userid, img) VaLUES (:userid, :img);');
                //Change when log in is available
                $this->bind(':userid', $_SESSION['user_data']['id']); 

                if(isset($img)){
                    $this->bind(':img', '/uploads_posts/'.$img);
                } 

                $this->execute();

                if(move_uploaded_file($_FILES['carousel-img']['tmp_name'], $target)){
                    $msg = "Upload Successful!";
                    echo $msg;
                } else {
                    $msg = "Failed to Upload Image";
                    echo $msg;
                }
            }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function editPortfolioProfile(){
         // Sanitize POST
         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

         if (isset($post)) {
            if($post['submit']) {
                

                // Each field is updated by itself - account for empty fields 
                // profile pic
            
               if(isset($_FILES['profilepic'])){
            
                    $img=null; 
                    $target = "uploads_posts/"; 
                    $msg="";
    
                        
                    if(getImagesize($_FILES['profilepic']['tmp_name'])){
                        $img = $_FILES['profilepic']['name'];
                        $target = $target.basename($img);
                     }
                    
                    
                    $this->query('UPDATE portfolio SET profilePic = :img WHERE userid=:userid;');
                    
                    $this->bind(':userid', $_SESSION['user_data']['id']); 
                    
                    if(isset($img)){
                    
                        $this->bind(':img', '/uploads_posts/'.$img);
                    } 

                    $this->execute();

                    if(move_uploaded_file($_FILES['profilepic']['tmp_name'], $target)){
                        $msg = "Upload Successful!";
                        echo $msg;
                    } else {
                        $msg = "Failed to Upload Image";
                        echo $msg;
                    }
                }
            

                // First Name
                if(isset($post['fname']) && $post['fname']!=""){
                    $this->query("UPDATE user SET fname = :fname WHERE userid = :userid;");

                    $this->bind(':userid', $post['userId']);
                    $this->bind(':fname', $post['fname']);
                    $this->execute();
                }

                // Last Name
                if(isset($post['lname']) && $post['lname']!=""){
                    $this->query("UPDATE user SET lname = :lname WHERE userid = :userid;");

                    $this->bind(':userid', $post['userId']);
                    $this->bind(':lname', $post['lname']);
                    $this->execute();
                }
                
                // Bio
                if(isset($post['profile']) && $post['profile']!=""){
                $this->query("UPDATE portfolio SET profile = :profile WHERE userid = :userid;");

                $this->bind(':userid', $post['userId']);
                $this->bind(':profile', $post['profile']);
                $this->execute();
                }

                //Education
                if(isset($post['education']) && $post['education']!=""){
                    $this->query("UPDATE user SET edu = :education WHERE userid = :userid;");
    
                    $this->bind(':userid', $post['userId']);
                    $this->bind(':education', $post['education']);
                    $this->execute();
                }

                // Occupation
                if(isset($post['job']) && $post['job']!=""){
                    $this->query("UPDATE user SET job = :job WHERE userid = :userid;");
    
                    $this->bind(':userid', $post['userId']);
                    $this->bind(':job', $post['job']);
                    $this->execute();
                }

                // Website
                if(isset($post['website']) && $post['website']!=""){
                    $this->query("UPDATE portfolio SET website = :website WHERE userid = :userid;");
    
                    $this->bind(':userid', $post['userId']);
                    $this->bind(':website', $post['website']);
                    $this->execute();
                }

            }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function editPortfolioPost(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
            if($post['submit']) {
                
                // Each field is updated by itself - accounts for empty fields - innefficient though
                if(isset($_FILES['postImg'])){
                
                    $img=null; 
                    $target = "uploads_posts/"; 
                    $msg="";

                        
                    if(getImagesize($_FILES['postImg']['tmp_name'])){
                        $img = $_FILES['postImg']['name'];
                        $target = $target.basename($img);
                    }
                    
                    
                    $this->query('UPDATE portfolioPost SET img = :img WHERE userid=:userid AND postId = :postId;');
                    
                    $this->bind(':userid', $_SESSION['user_data']['id']); 
                    $this->bind(':postId', $post['postId']);
                    
                    if(isset($img)){
                        $this->bind(':img', '/uploads_posts/'.$img);
                    } 

                    $this->execute();

                    if(move_uploaded_file($_FILES['postImg']['tmp_name'], $target)){
                        $msg = "Upload Successful!";
                        echo $msg;
                    } else {
                        $msg = "Failed to Upload Image";
                        echo $msg;
                    }
                }

                // Title
                if(isset($post['title']) && $post['title']!=""){
                    $this->query("UPDATE portfoliopost SET title = :title WHERE userid = :userid AND postId = :postId;");

                    $this->bind(':userid', $_SESSION['user_data']['id']); 
                    $this->bind(':postId', $post['postId']);
                    $this->bind(':title', $post['title']);
                    $this->execute();
                }

                // Body
                if(isset($post['body']) && $post['body']!=""){
                    $this->query("UPDATE portfoliopost SET description = :description WHERE userid = :userid AND postId = :postId;");
                    
                    $this->bind(':userid', $_SESSION['user_data']['id']); 
                    $this->bind(':postId', $post['postId']);
                    $this->bind(':description', $post['body']);
                    $this->execute();
                }

                // Link
                if(isset($post['link']) && $post['link']!=""){
                    $this->query("UPDATE portfoliopost SET link = :link WHERE userid = :userid AND postId = :postId;");
                    
                    $this->bind(':userid', $_SESSION['user_data']['id']); 
                    $this->bind(':postId', $post['postId']);
                    $this->bind(':link', $post['link']);
                    $this->execute();
                }
            }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function deletePortfolioPost(){
         // Sanitize POST
         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
            if($post['submit']) {
                if(isset($post['postId'])){
                    $this->query('DELETE FROM portfoliopost WHERE postId= :postId');
                    $this->bind(':postId', $post['postId']);
                    $this->execute();
                }
            }
        } 
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

?>



                       