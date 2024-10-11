<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
                 <?php
include "config.php";
if(isset($_FILES["fileToUpload"])){
$errors=array();
    $flnm=$_FILES["fileToUpload"]["name"];
    $flsz= $_FILES['fileToUpload']['size'];
    $fltmp= $_FILES['fileToUpload']['tmp_name'];
    $filtyp=$_FILES['fileToUpload']['type'];
    $flxtnt=explode('.',$flnm);
     $xtnt=array("jpg","png","jpeg");
     if(in_array($flxtnt,$xtnt)){
        $errors[]="not allov";
}
if($flsz>2097152)   {
$errors[]="filz siz";
}
if(empty($errors)==true){
move_uploaded_file($fltmp,"upload/".$flnm);
}   else{
print_r($errors($errors));

}
}
if(isset($_POST['submit'])){

$D1=mysqli_real_escape_string($conn,$_POST["post_title"]);

$D2=mysqli_real_escape_string($conn,$_POST["postdesc"]);

$D3=mysqli_real_escape_string($conn,$_POST["category"]);
$date=date("d M,Y");



$at=$_SESSION["user_id"];

$slo="INSERT INTO post(title,description,category,post_date,author,post_img) values('{$D1}','{$D2}','{$D3}','{$date}','{$at}','{$flnm}');";

$slo.="UPDATE  category SET post=post+1 where category_id={$D3}";

if($rslt=mysqli_multi_query($conn,$slo)){

   header("Location:{$hostnam}/admin/post.php");
} else {
print_r(mysqli_error($conn));
}
}
?>

             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="<?php $_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                         
                          <select name="category" class="form-control">
                          <?php
                          include "config.php";
                          $chckusr="SELECT category_name,category_id  From category ";
  
                          $rslt=mysqli_query($conn,$chckusr);
                         if(($rslt) && mysqli_num_rows($rslt)> 0){
                       
                         while($row=mysqli_fetch_array($rslt)){
                            echo "<option value='{$row['category_id']}' > {$row['category_name']}</option>";

                         }
                        }
                          ?>
                             
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; 
?>

