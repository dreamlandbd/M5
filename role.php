<?php
require 'session.php';
require 'conditions.php';

if($_SESSION['username']){
  if(!isAdmin()){
    header("Location: http://localhost/php/login.php",true,301);
    exit();
  }
  elseif(isset($_GET['username'])){
    $filedata = file("data.txt");
    foreach($filedata as $index=>$d) {
        $data = explode(',', $d);
        if(($data[0] == $_GET['username'])){                    
          unset($filedata[$index]);        
          file_put_contents('data.txt',$filedata);
          break;
        }
      }
  }
  elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['delete'])){
      delete_role($_POST['username'],$_POST['role']);
    }
    elseif(add_roles_to_user($_POST['username'],$_POST['role'])){
      echo 'User Role Assigned';
    }
  }
}
else{
    header("Location: http://localhost/php/login.php",true,301);
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Crew Project-Role Management</title>
    <h1>Role Management (<?php echo $_SESSION['username'].'/'.$_SESSION['role'] ?>) | 
    <a class="btn btn-primary" href="/php/create_roles.php">New Role</a> |
    <a href="/php/login.php?logout=true">Logout<a></h1>
  </head>
  <body>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php if($_SESSION['username']){
        if(isAdmin()){
            $contents = file('data.txt');
            foreach($contents as $index=>$content){
                $data = explode(',', $content);
                echo '<tr>
                <th scope="row">'.($index+1).'</th>
                <td>'.$data[0].'</td>
                <td>'.$data[1].'</td>
                <td>'.$data[3];              
                echo '</td>';
                echo '<td><a href="/php/edit.php?username='.$data[0].'">Edit</a> | 
                <a href="/php/delete.php?username='.$data[0].'">Delete</a></td>
                </tr>
                <tr>'; 
            }
        }
    }
    ?>
    </tbody>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>