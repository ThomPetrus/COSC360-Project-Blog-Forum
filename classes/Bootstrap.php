<?php
class Bootstrap{
    private $controller;
    private $action;
    private $request;

    public function __construct($request){
        $this->request = $request;

        // If no controller sepcified - i.e at root then set controller to home
        if($this->request['controller'] == ""){
            $this->controller = 'home';
        } else{

            // Otherwise set to specified controller 
            $this->controller = $this->request['controller'];
        }

        // Same thing for action
        if($this->request['action']==""){
            $this->action='index';
        }else{
            $this->action = $this->request['action'];
        }
    }

    public function createController(){
        //ensure it exists
        if(class_exists($this->controller)){
            $parents = class_parents($this->controller);
            // check if it is extended
            if(in_array("Controller", $parents)){
                if(method_exists($this->controller, $this->action)){
                    return new $this->controller($this->action, $this->request);
                } else {
                    echo '<h1>Method does not exist.</h1>';
                    return;
                }
            } else {
                echo '<h1>Base Controller not found.</h1>';
                return;
            }
        } else {
            echo '<h1>Controller class not found.</h1>';
            return;
        }
    }
}
?>