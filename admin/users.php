<?php include "header.php"; 

if(isset($_SESSION["role"])==0){
    header("Location:{$hostnam}/admin/post.php");
}
?>
<?php


             include "config.php";
           
             $limit=3;
          
             if(isset($_GET['page'])){

                $pag=$_GET['page'];
             }
             else{
            $pag=1; 
            }
             $offst=($pag-1)*$limit;
             $chckusr="SELECT * From user Limit {$offst},{$limit}";

             $rslt=mysqli_query( $conn, $chckusr );    
       if( mysqli_num_rows($rslt)> 0) {
         
       }
               
               # code...
             
             ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
        
                  <table class="content-table">
                      <thead>
                     
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                 
                          <tr>
                          <?php while($row=mysqli_fetch_array($rslt)) 
                          
                          
                          {?>
                              <td class='id'><?php echo $row['user_id'];?></td>
                              <td><?php echo $row['first_name']." ".$row['last_name'];?></td>
                              <td><?php echo $row['username'];?></td>
                              <td><?php
                              if($row['role']==1){
                                echo 'Admin';
                              }
                              else     {                         
                              
                              echo 'No';
                            
                            }?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"]?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"]?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                  }
                  ?>
                      </tbody>
                  
                  </table>
                  <?php
                  
                  $slp="SELECT * From user";
                  $rslt1=mysqli_query( $conn, $slp );
                  if( mysqli_num_rows($rslt1)> 0) {
                $totalrcrd=  mysqli_num_rows($rslt1);
              
                $totlpg=ceil($totalrcrd/$limit);
                echo "<ul class='pagination admin-pagination'>";
                for($i=1;$i<=$totlpg;$i++){
                    // <li class="active"><a>1</a></li>
                    echo  "<li><a href='users.php?page={$i}''>{$i}</a></li>";
            
                }
                echo  " </ul>";
                
            
            }
 ?>
                  
                      
                 
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
