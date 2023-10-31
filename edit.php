<?php
require 'session.php';
require 'conditions.php';

if($_SESSION['username']){
  if(!isAdmin()){    
    header("Location: http://localhost/php/login.php",true,301);
    exit();
  }
  elseif(isset($_GET["username"])){}
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

    <title>Crew Project-Edit User</title>
    <h1>Role Management (<?php echo $_SESSION['username'].'/'.$_SESSION['role'] ?>) | 
    <a href="/php/login.php?logout=true">Logout<a></h1>
  </head>
  <body>
  <form method="POST" action='/php/role.php'>
    <?php if($_SESSION['username']){
        if(isAdmin()){
          $userdetail = findUser($_GET['username']);       
            echo '<input name="username" type="text" class="form-control" 
              id="username" value='.$userdetail[0].' hidden>';                        
            
            echo '<label for="email">Email</label><br/> 
              <input name="username" type="text" class="form-control" 
              id="username" value='.$userdetail[1].' disabled>';
            
            echo '<label for="presentrole">Present Role</label><br/>
              <input name="presentrole" type="text" class="form-control" 
              id="presentrole" value='.$userdetail[3].'>';
            
            echo '<label for="role">Roles</label><br/>
                  <select name="role" id="role">';
            
            foreach(roles() as $role){            
              echo '<option value="'.$role.'">'.$role.'</option>';               
            }
            echo '</select>';
        }
    }
    ?>
    <br/>
    <br/>
    <button type="submit" class="btn btn-primary">Submit</button>    
  </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>