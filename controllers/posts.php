<?php
class Posts extends Controller {
    protected function Index(){
        $viewmodel = new PostModel();
        $this->ReturnView($viewmodel->index(), true);
    }

    protected function add(){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'posts');
        }
        $viewmodel = new PostModel();
        $this->ReturnView($viewmodel->add(), true);
    }

    protected function addComment(){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'posts');
        }
        $viewmodel = new PostModel();
        $this->ReturnView($viewmodel->addComment(), true);
    }

    protected function deleteForumPost(){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'posts');
        }
        $viewmodel = new PostModel();
        $this->ReturnView($viewmodel->deleteForumPost(), true);
    }

    protected function deletePostComment(){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'posts');
        }
        $viewmodel = new PostModel();
        $this->ReturnView($viewmodel->deletePostComment(), true);
    }
}
?>