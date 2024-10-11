<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
<?php
      include './admin/config.php';
$cn = $_GET['cid'];

$usd = "SELECT * FROM category where category_id='{$cn}'";


$rslt31 = mysqli_query($conn, $usd);
$cnm=mysqli_fetch_array($rslt31);
?>
              
                <!-- post-container -->
                <div class="post-container">
                    <h2 class="page-heading"><?php echo $cnm['category_name']; ?></h2>

                    <?php
           
          
                $us = "SELECT * FROM post LEFT JOIN category on post.category=category.category_id  where post.category='{$cn}'";


                $rslt3 = mysqli_query($conn, $us);
         if(mysqli_num_rows($rslt3) > 0){

            
             
          
            

                ?>
                    <?php 
                                       
                                       while( $row = mysqli_fetch_array($rslt3)){           
                                                   ?>
                    <div class="post-content">
                 
                        <div class="row">
                    
                            <div class="col-md-4">
                                <a class="post-img" href="single.php"><img src="images/post-format.jpg" alt="" /></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php'><?php echo $row['title']; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php'>PHP</a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php'>Admin</a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            01 Nov, 2019
                                        </span>
                                    </div>
                                    <p class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua....
                                    </p>
                                    <a class='read-more pull-right' href='single.php'>read more</a>
                                </div>
                            </div>
                        </div>

                    </div>
<?php } 
         }     
?>
                    <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>