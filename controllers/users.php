<?php
class Users extends Controller {
    protected function register(){
        $viewmodel = new UserModel();

        // Retrieve appropriate view and true for main layout template
        $this->returnView($viewmodel->register(), true);
    }
}
?>