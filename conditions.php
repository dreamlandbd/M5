<?php

class UserRoles{
    private $username;
    private $roles=[];
    public function __construct($username,$role){
        $this->username = $username;
        $this->roles[] = $role;
    }
}

function authentication( $email, $password ) {
    $contents = file('data.txt');  
    foreach($contents as $content) {
        $data = explode(',', $content);
        if(($data[1] == trim($email)) && ($data[2] == md5(trim($password)))){      
            $_SESSION['username'] = $data[0];
            $_SESSION['role'] = $data[3];
            return true;
        }
    }
    return false;
}
function logout() {
    session_destroy();
    header("Location: http://localhost/php/login.php",true,301);
    exit();
}
function isAdmin(){
    if(trim($_SESSION['role']) === 'admin'){
        return true;
    }
    else{
        return false;
    }
}
function isUser(){
    if(trim($_SESSION["role"]) === "user"){
        return true;
    }
    else{
        return false;
    }
}
function isEditor(){
    if(trim($_SESSION["role"]) === "editor"){
        return true;
    }
    else{
        return false;
    }
}
function checkRole($rolename){
    $roles = file('roles.txt');        
        foreach($roles as $role) {
            if(trim($role) === trim($rolename)){
                return true;
            }
            else{
                return false;
            }
        }
}
function checkUser($username,$email ,$password){
    $contents = file('data.txt');
    foreach($contents as $content) {
        $data = explode(',', $content);
        if($data[0] === (trim($username)) || ($data[1] === (trim($email)))){
            return true;
        }
    }
    return false;
}
function findUser($username){
    $filedata = file("data.txt");
    foreach($filedata as $d) {
        $data = explode(',', $d);
        if(($data[0] == trim($username))){                    
          return $data;          
        }
    }
    return false;
}

function roles(){
    $filedata = file("roles.txt");
    return $filedata;
}
function add_roles_to_user($username,$role){
    $filedata = file("data.txt");
    $userFound = false;
    $role = trim($role);

    foreach($filedata as $index=>$d) {
        $data = explode(',', $d);
        if(($data[0] == trim($username))){
            $userFound = true;
            $data[3] = $role;
            $password = $data[2];
            $email = $data[1];
            $newdata = "$username".","."$email".","."$password".","."$role"."\n";
            unset($filedata[$index]);
            $filedata = array_values($filedata);
            array_push($filedata, $newdata);
        }
    }
    if(!$userFound){
        return false;
    }else{
        file_put_contents('data.txt', $filedata);
        return true;
    }
}
function delete_role($username,$role){
    $filedata = file("data.txt");
    $userFound = false;
    $role = trim($role);
    
    foreach($filedata as $index=>$d) {
        $data = explode(',', $d);
        if(($data[0] == trim($username))){
            $userFound = true;

            $data[3] = $role;
            $password = $data[2];
            $email = $data[1];
            $newdata = "$username".","."$email".","."$password".","."\n";
            
            unset($filedata[$index]);
            $filedata = array_values($filedata);            
            array_push($filedata, $newdata);
        }
    }
    if(!$userFound){
        return false;
    }else{
        file_put_contents('data.txt', $filedata);
        return true;
    }
}
?>