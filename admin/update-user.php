<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                   
               
                   <?php
                   
                   include "config.php";
if(isset($_POST["submit"])){
    $usrid=mysqli_real_escape_string($conn,$_POST["user_id"]);  
    $nam=mysqli_real_escape_string($conn,$_POST["f_name"]);  
    $lastnm=mysqli_real_escape_string($conn,$_POST['l_name']);
    $usrnm=mysqli_real_escape_string($conn,$_POST['username']);

   
    $usrrol=mysqli_real_escape_string($conn,$_POST['role']);
    $rslt=mysqli_query($conn,$usrrol);
   if(($rslt) && mysqli_num_rows($rslt)> 0){
   $row=mysqli_fetch_array($rslt);
        echo "usrnam is already exists";
    }else{
    $insrt="UPDATE user SET first_name='{$nam}',last_name='{$lastnm}',username='{$usrnm}', role='{$usrrol}' where user_id =  '{$usrid}'";
  
   
    if(mysqli_query( $conn, $insrt)){
   
     
     header("Location:{$hostnam}/admin/users.php");
    }
}

}

                   $USROD= $_GET['id'];
                   $SOL="SELECT * From user where user_id =  {$USROD}";
               $RSLT=mysqli_query($conn,$SOL);
       if(mysqli_num_rows($RSLT)>0){
        while($row=mysqli_fetch_array($RSLT)) {
                   
                   ?>
                   
                   
                  <form  action="<?php $_SERVER["PHP_SELF"]?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                          <?php
                              if($row['role']==1){
                                echo "<option value='0'>normal User</option>
                              <option value='1' selected>Admin</option>";
                              }
                              else     {                         
                                echo "<option value='0' selected>normal User</option>
                                <option value='1' >Admin</option>";
                            
                            }?>  
                        
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
                   <?php
       }

    }
                   ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
