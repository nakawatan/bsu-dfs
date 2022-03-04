<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $root = dirname(__FILE__, 2);
    include $root.'/classes/user.php';
    include $root.'/classes/department.php';
    include_once $root.'/classes/course.php';
    $result["status"] = "ok";

    if (isset($_REQUEST['method'])){
        $method = $_REQUEST['method'];
        switch ($method) {
            case "get_users":
                $user = new User();
                $users = $user->get_users();
                $result=array();
        
                $result["status"] = "ok";
                $result["users"]=$users;
                break;
            case "update_user":
                $user = new User();
                if (isset($_REQUEST["id"])) {
                    $user->id = $_REQUEST["id"];
        
                    // check if user exist
                    $user->get_user();
        
                    if ($user->id > 0){
                        if (isset($_REQUEST["password"])) {
                            $user->password = $_REQUEST["password"];
                        }
                        if (isset($_REQUEST["email"])) {
                            $user->email = $_REQUEST["email"];
                        }
                        if (isset($_REQUEST["user_level_id"])) {
                            $user->user_level_id = $_REQUEST["user_level_id"];
                        }
            
                        if (isset($_REQUEST["google_id"])) {
                            $user->google_id = $_REQUEST["google_id"];
                        }
            
                        if (isset($_REQUEST["image"])) {
                            $user->image = $_REQUEST["image"];
                        }
                
                        $user->Update();
                
                        $result["status"] = "ok";
                        $result["user"]=$user;
                    }else {
                        $result["status"]="error";
                        $result["msg"]="Record Does not exist";
                    }
        
                    
                }else {
                    $result["status"]="error";
                    $result["msg"]="No valid id";
                }
                break;
            case "new_user":
                $user = new User();
    
                if (isset($_REQUEST["username"])) {
                    $user->username = $_REQUEST["username"];
                    $user->checkUsername();
        
                    if ($user->id == 0){
                        if (isset($_REQUEST["username"])) {
                            $user->username = $_REQUEST["username"];
                        }
                        if (isset($_REQUEST["password"])) {
                            $user->password = $_REQUEST["password"];
                        }
                        if (isset($_REQUEST["email"])) {
                            $user->email = $_REQUEST["email"];
                        }
                        if (isset($_REQUEST["user_level_id"])) {
                            $user->user_level_id = $_REQUEST["user_level_id"];
                        }
                
                        if (isset($_REQUEST["google_id"])) {
                            $user->google_id = $_REQUEST["google_id"];
                        }
                
                        if (isset($_REQUEST["image"])) {
                            $user->image = $_REQUEST["image"];
                        }
                
                        $user->Save();
                
                        $result["status"] = "ok";
                        $result["user"]=$user;
                    }else {
                        $result["status"]="error";
                        $result["msg"] ="Username already exist";
                    }
                    
                }else {
                    $result["status"]="error";
                    $result["msg"] ="Username is required";
                }
                break;
            case "delete_user":
                if (isset($_REQUEST["id"])){
                    $user = new User();
                    $user->id = $_REQUEST["id"];
                    // check if user exist
                    $user->get_user();
                    
                    if ($user->id >0){
                        $user->delete();
                    }else {
                        $result["status"]="error";
                        $result["msg"]="Record Does not exist";
                    }
                    
                
                }else {
                    $result["status"]="err";
                    $result["msg"]="User ID must be set";
                }
                break;
            // department API
            case "update_department":
                $obj = new Department();
                if (isset($_REQUEST["id"])) {
                    $obj->id = $_REQUEST["id"];
        
                    // check if department exist
                    $obj->get_department();
        
                    if ($obj->id > 0){
                        if (isset($_REQUEST["name"])) {
                            $obj->name = $_REQUEST["name"];
                        }
                
                        $obj->Update();
                
                        $result["status"] = "ok";
                        $result["user"]=$obj;
                    }else {
                        $result["status"]="error";
                        $result["msg"]="Record Does not exist";
                    }
        
                    
                }else {
                    $result["status"]="error";
                    $result["msg"]="No valid id";
                }
                break;
            case "new_department":
                $obj = new Department();
    
                if (isset($_REQUEST["name"])) {
                    $obj->name = $_REQUEST["name"];
                }
                $obj->Save();
                break;
            case "delete_department":
                if (isset($_REQUEST["id"])){
                    $obj = new Department();
                    $obj->id = $_REQUEST["id"];
                    // check if user exist
                    $obj->get_department();
                    
                    if ($obj->id >0){
                        $obj->delete();
                    }else {
                        $result["status"]="error";
                        $result["msg"]="Record Does not exist";
                    }
                    
                
                }else {
                    $result["status"]="err";
                    $result["msg"]="ID must be set";
                }
                break;
            
            // courses API
            case "update_course":
                $obj = new Course();
                if (isset($_REQUEST["id"])) {
                    $obj->id = $_REQUEST["id"];
        
                    // check if department exist
                    $obj->get_course();
        
                    if ($obj->id > 0){
                        if (isset($_REQUEST["name"])) {
                            $obj->name = $_REQUEST["name"];
                        }

                        if (isset($_REQUEST["department_id"])) {
                            $obj->department_id = $_REQUEST["department_id"];
                        }
                
                        $obj->Update();
                
                        $result["status"] = "ok";
                        $result["user"]=$obj;
                    }else {
                        $result["status"]="error";
                        $result["msg"]="Record Does not exist";
                    }
        
                    
                }else {
                    $result["status"]="error";
                    $result["msg"]="No valid id";
                }
                break;
            case "new_course":
                $obj = new Course();
    
                if (isset($_REQUEST["name"])) {
                    $obj->name = $_REQUEST["name"];
                }

                if (isset($_REQUEST["department_id"])) {
                    $obj->department_id = $_REQUEST["department_id"];
                }
                $obj->Save();
                break;
            case "delete_course":
                if (isset($_REQUEST["id"])){
                    $obj = new Course();
                    $obj->id = $_REQUEST["id"];
                    // check if user exist
                    $obj->get_course();
                    
                    if ($obj->id >0){
                        $obj->delete();
                    }else {
                        $result["status"]="error";
                        $result["msg"]="Record Does not exist";
                    }
                    
                
                }else {
                    $result["status"]="err";
                    $result["msg"]="ID must be set";
                }
                break;

            default:
                $result["status"]="error";
                $result["msg"]="Invalid method";
        }
    }else {
        $result["status"]="error";
        $result["msg"]="Method not set.";
    }

    echo json_encode($result);

?>