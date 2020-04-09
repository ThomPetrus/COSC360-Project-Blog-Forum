<?php
class Users extends Controller {
    protected function register(){
        $viewmodel = new UserModel();

        // Retrieve appropriate view and true for main layout template
        $this->returnView($viewmodel->register(), true);
    }

    protected function login(){
        $viewmodel = new UserModel();

        // Retrieve appropriate view and true for main layout template
        $this->returnView($viewmodel->login(), true);
    }

    protected function forgotPass(){
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->forgotPass(), true);
    }

    protected function logout(){
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();
        header('Location: '.ROOT_PATH);
    }

    protected function deleteUser(){
        $viewmodel= new UserModel();
        $this->returnView($viewmodel->deleteUser(), true);
    }

    protected function changeLogPrivilege(){
        $viewmodel= new UserModel();
        $this->returnView($viewmodel->changeLogPrivilege(), true);
    }

    protected function changeAdminPrivilege(){
        $viewmodel= new UserModel();
        $this->returnView($viewmodel->changeAdminPrivilege(), true);
    }

    protected function changePostPrivilege(){
        $viewmodel= new UserModel();
        $this->returnView($viewmodel->changePostPrivilege(), true);
    }
}
?>

