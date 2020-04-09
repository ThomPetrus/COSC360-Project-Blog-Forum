<?php 

class PostModel extends Model{
    public function index(){

        // This can probably be done in an easier way as well, but it works.
        $this->query('SELECT id, uid, title, body, link, date, img, fname, lname, categoryId, categoryTitle, canPost, canLogIn, isAdmin 
                        FROM posts AS P 
                        JOIN user AS U ON P.uid = U.userid 
                        JOIN categories AS C ON P.category = C.categoryId 
                        ORDER BY date ASC ');

        $posts = $this->resultSet();

        $this->query('SELECT commentId, fname, lname, postId, uid, comment, link, img, datePosted 
                        FROM comments AS C 
                        JOIN user AS U ON C.uid = U.userid
                        ORDER BY datePosted ASC ');
                        
        $comments = $this->resultSet();

        // This does not pass it as an associative array? 
        //$results = array("posts"=>$posts,"comments"=>$comments);

        $this->query('SELECT * FROM categories');
        $categories = $this->resultSet();

        $results = array("posts"=>$posts,"comments"=>$comments, "categories"=>$categories);

        return $results;
    }

    public function add(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // For categories in submit post form
        $this->query('SELECT * FROM categories');
        $rows = $this->resultSet();

        if(isset($post)){
            if($post['submit']){
                
                if($post['title'] == '' || $post['body'] == '' || $post['link']==''){
                    Messages::setMsg('Please fill in all fields!', 'error_msg');
                    return;
                }

                $img=null; 
                $target = "uploads_posts/"; 
                $msg="";

                if(isset($_FILES['img'])){
                    
                    if(getImagesize($_FILES['img']['tmp_name'])){
                        $img = $_FILES['img']['name'];
                        $target = $target.basename($img);
                    }
                }
                
                // INSERT post to DB
                $this->query('INSERT INTO posts (uid, title, body, link, img, category) VALUES (:uid, :title, :body, :link, :img, :category)');
                
                //Change when log in is available
                $this->bind(':uid', $_SESSION['user_data']['id']);
                $this->bind(':title', $post['title']);
                $this->bind(':body', $post['body']);
                $this->bind(':link', $post['link']);
                $this->bind(':category', $post['category']);
                
                if(isset($img)){
                    $this->bind(':img', $img);
                }

                $this->execute();

                if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){
                    $msg = "Upload Successful!";
                    echo $msg;
                } else {
                    $msg = "Failed to Upload Image";
                    echo $msg;
                }

                if($this->last_insert_id()){
                    header('Location: '.ROOT_PATH.'posts');
                }
            }
            return $rows;
        }
    }

    public function addComment(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        if(isset($post)){
            if($post['submit']){
                
                if($post['comment'] == '' || $post['link'] == ''){
                    Messages::setMsg('Please fill in all fields!', 'error_msg');
                    return;
                }

                $img=null; 
                $target = "uploads_posts/"; 
                $msg="";

                if(isset($_FILES['img'])){
                    
                    if(getImagesize($_FILES['img']['tmp_name'])){
                        $img = $_FILES['img']['name'];
                        $target = $target.basename($img);
                    }
                }
                
                // INSERT comment to DB
                $this->query('INSERT INTO comments (uid, postId, comment, link, img) VALUES (:uid, :postId, :comment, :link, :img)');
                
                //Change when log in is available
                $this->bind(':uid', $_SESSION['user_data']['id']);
                $this->bind(':postId', $post['post-id']);
                $this->bind(':comment', $post['comment']);
                $this->bind(':link', $post['link']);
                
                if(isset($img)){
                    $this->bind(':img', $img);
                }

                $this->execute();

                if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){
                    $msg = "Upload Successful!";
                    echo $msg;
                } else {
                    $msg = "Failed to Upload Image";
                    echo $msg;
                }

                if($this->last_insert_id()){
                    header('Location: '.ROOT_PATH.'posts');
                }
            }
            return $rows;
        }
    }

    public function deleteForumPost(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post)) {
            if($post['submit']) {
                if(isset($post['postId'])){
                    $this->query('DELETE FROM posts WHERE id = :postId');
                    $this->bind(':postId', $post['postId']);
                    $this->execute();
                }
            }
        } 
       header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
   
    public function deletePostComment(){
        
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

       if (isset($post)) {
           if($post['submit']) {
               if(isset($post['commentId'])){
                   echo $post['commentId'];
                   $this->query('DELETE FROM comments WHERE commentId = :commentId');
                   $this->bind(':commentId', $post['commentId']);
                   $this->execute();
               }
           }
       } 
       header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

}

?>