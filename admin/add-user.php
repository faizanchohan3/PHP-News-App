<?php include "header.php";
if(isset($_POST["save"])){
    include_once  "config.php";

    $nam=mysqli_real_escape_string($conn,$_POST["fname"]);  
    $lastnm=mysqli_real_escape_string($conn,$_POST['lname']);
    $usrnm=mysqli_real_escape_string($conn,$_POST['user']); 
    $pwd=mysqli_real_escape_string($conn,md5($_POST['password']));
   
    $usrrol=mysqli_real_escape_string($conn,$_POST['role']);
    
    $chckusr="SELECT username From user where username =  {$usrnm}";
  
    $rslt=mysqli_query($conn,$chckusr);
   if(($rslt) && mysqli_num_rows($rslt)> 0){
   $row=mysqli_fetch_array($rslt);
        echo "usrnam is already exists";
    }else{
   $insrt="insert into user(first_name,last_name,username,password,role) values('{$nam}','{$lastnm}','{$usrnm}','{$pwd}','{$usrrol}')";
   
   if(mysqli_query( $conn, $insrt)){
  
    
    header("Location:{$hostnam}/admin/users.php");
   }
}

};




?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER["PHP_SELF"]; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
