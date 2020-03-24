<?php
class Posts extends Controller {
    protected function Index(){
        $viewmodel = new PostModel();
        $this->ReturnView($viewmodel->index(), true);
    }

    protected function add(){
        $viewmodel = new PostModel();
        $this->ReturnView($viewmodel->add(), true);
    }
}
?>