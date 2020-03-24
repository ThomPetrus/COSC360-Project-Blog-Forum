<?php 

class PostModel extends Model{
    public function index(){
        $this->query('SELECT * FROM posts ORDER BY date ASC');
        $rows = $this->resultSet();
        return $rows;
    }

    public function add(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($post)){
            if($post['submit']){
                
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
                $this->query('INSERT INTO posts (uid, title, body, link, img) VALUES (:uid, :title, :body, :link, :img)');
                
                //Change when log in is available
                $this->bind(':uid', 1);
                $this->bind(':title', $post['title']);
                $this->bind(':body', $post['body']);
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
            return;
        }
    }

}

?>