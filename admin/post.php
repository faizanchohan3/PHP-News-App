<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                    <?php
                    include "config.php";
                    $limit=10;
                    if(isset($_GET['page'])){

                        $pag=$_GET['page'];
                     }
                     else{
                    $pag= 1;
                     }
                     $offst=($pag-1)*$limit;

                $usr=$_SESSION['user_id'];
                if( $_SESSION["role"]==0){
           
                    $us="SELECT * FROM post LEFT JOIN user on post.author=user.user_id  where post.author='{$usr}' Limit {$offst},{$limit}";
                
                  
                  
                }
                else if( $_SESSION["role"]== 1){
                    $us="SELECT * FROM post LEFT JOIN user on post.author=user.user_id   Limit {$offst},{$limit}";
                
                
                }
                $rslt=mysqli_query( $conn, $us );
                if( mysqli_num_rows($rslt)> 0){
                
                
                    
                    ?>
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php while($row=mysqli_fetch_array($rslt)) 
                          
                        
                          {?>    
                      <tr>

                              <td class='id'><?php
                             echo $row['post_id'];?></td>
                              <td><?php
                             echo $row['title'];?></td>
                              <td><?php

                              $ro="SELECT * FROM category where category_id='{$row["category"]}'";
                              
                              $rslts=mysqli_query($conn,$ro);
                              if( mysqli_num_rows($rslts)> 0){
                                while($rows=mysqli_fetch_array($rslts)){
                             echo strtoupper($rows['category_name']);
                                }
                              }?></td>
                              <td><?php echo $row['post_date'];?></p></td>
                              <td><?php echo $row['username']; ?></td>
                              <td class='edit'><a href='update-post.php'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                  }
                }

                  ?>
                      </tbody>

                  </table>
               
                  <?php
                  if($_SESSION['role']==0){
                  $slp="SELECT * FROM post where author='{$usr}'";
            }
            else if($_SESSION["role"]== 1){
                $slp="SELECT * FROM post ";

            }
                  $rslt1=mysqli_query( $conn, $slp );
                  if( mysqli_num_rows($rslt1)> 0) {
                    $totalrcrd=  mysqli_num_rows($rslt1);
                   
              
                  $totlpf=ceil($totalrcrd/$limit);
               
                  echo "<ul class='pagination admin-pagination'>";
                  for($i=1;$i<=$totlpf;$i++){
                
                      echo  "<li><a href='post.php?page={$i}''>{$i}</a></li>";
              
                  }
                  echo  " </ul>";
                  }
                 ?>
                
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; 



?>
