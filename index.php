<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                     <?php
                     include './admin/config.php';
                  
                     if(isset($_GET['page'])){

                        $pag=$_GET['page'];
                     }
                     else{
                    $pag= 1;
                     }
                         
                  
                     $Limit=5;
                     $Offset= ($pag-1) * $Limit;
                     $slct= "SELECT * From post LEFT JOIN category on post.category=category.category_id
                     LEFT JOIN user on post.author=user.user_id order by post_id desc Limit {$Offset},{$Limit}";
                     $rsltou=mysqli_query($conn,$slct);
                     if(mysqli_num_rows($rsltou)> 0){
                    
                    while($row = mysqli_fetch_array($rsltou)){
                     ?>
                    <div class="post-container">
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php"><img src="admin/upload/<?php
                                     echo $row['post_img']?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php'><?php echo $row['title'];?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php'><?php echo $row['category_name']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php'>
                                                    <?php
                                                  echo $row['first_name']   ; 
                                                  if($row['role']==1){
                                                    echo '    Admin';

                                                  }else{
                                                    echo '   Normal user';
                                                }

                                                    ?>
                                                </a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                             <?php
                                             echo $row['post_date'] ;
                                             ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php
                                        echo $row['description'];
                                        ?>                   </p>
                                        <a class='read-more pull-right' href='single.php'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        
                    
                
                    </div>
               
                    <?php
                    }
                }
                    ?>
                        <?php
                    
                    include "./admin/config.php";
                                                $USR="SELECT * From post";
                                                $coury=mysqli_query($conn,$USR);
                                                if( mysqli_num_rows($coury)> 0) {
                                                $totl=mysqli_num_rows($coury);
                                                
                                                $pgination=ceil($totl/$Limit);
                                                
                    
                                                echo "<ul class='pagination'>";
                                                
                                                for($i=1;$i<=$pgination;$i++){
                                    
                                                    echo  "<li><a href='index.php?page={$i}''>{$i}</a></li>";
                                            
                                                }
                                                echo  " </ul>";
                                                }
                                                ?>
                                                   <!-- /post-container -->
                </div>
                
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
