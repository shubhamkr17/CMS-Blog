<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php 
    if(isset($_POST["Submit"])) {
        $category = mysqli_real_escape_string($conn,$_POST["Category"]);
        $dateTime = date_time();
        $admin = "Admin";
        if(empty($category)) {
            $_SESSION['errorMessage']= "All field must be filled!";
            redirect_to("categories.php");
            exit(1);
        }
        else if(strlen($category)>99) {
            $_SESSION['errorMessage']= "Name too long!";
            redirect_to("categories.php");
            exit(1);
        }
        else {
            global $conn;
            $query = "INSERT into category(dateTime,name,creatorName) VALUES ('$dateTime','$category','$admin')";
            $execute = mysqli_query($conn,$query);
            
            if($execute) {
                $_SESSION['successMessage']="Category added successfully!";
                redirect_to("categories.php");
                exit(1);
            }
            else {
                $_SESSION['errorMessage']= "Something went wrong!";
                redirect_to("categories.php");
                exit(1);
            }
        }
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/admin_styles.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                
                <ul id="side-menu" class="nav nav-pills nav-stacked">
                    <li> <a href="dashboard.php">
                    <span class="glyphicon glyphicon-th"></span>&nbsp; Dashboard</a> </li>

                    <li> <a href="dashboard.php">
                    <span class="glyphicon glyphicon-list-alt"></span>&nbsp; Add New Post</a> </li>

                    <li class="active"> <a href="categories.php">
                    <span class="glyphicon glyphicon-tags"></span>&nbsp; Categories</a> </li>

                    <li> <a href="dashboard.php">
                    <span class="glyphicon glyphicon-user"></span>&nbsp; Manage Admins</a> </li>

                    <li> <a href="dashboard.php">
                    <span class="glyphicon glyphicon-comment"></span>&nbsp; Comments</a> </li>

                    <li> <a href="dashboard.php">
                    <span class="glyphicon glyphicon-equalizer"></span>&nbsp; Live Blog</a> </li>
                    
                    <li> <a href="#">
                    <span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a> </li>
                </ul>
            </div>
            <!-- End of side nav -->
            
            <div class="col-sm-10">
                <h1>Manage Categories</h1>
                <div><?php 
                        echo ErrorMessage();
                        echo SuccessMessage(); 
                        ?>
                </div>
                <div> 
                <form action="categories.php" method="post">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" name="Category" placeholder="Name">
                    </div>

                    <button type="submit" name="Submit" class="btn btn-success">Add new category</button>
                    
                </form> 
                </div> 
                <br>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Serial No.</th>
                            <th>Category Name</th>
                            <th>Creator Name</th>
                            <th>Time</th>
                        </thead>
                        <tbody>
                        <?php
                            $viewQuery = "SELECT * from category ORDER BY dateTime DESC";
                            $execute = mysqli_query($conn,$viewQuery);
                            $SNo = 0;
                            while($data=mysqli_fetch_array($execute)) {
                                $name = $data['name'];
                                $time = $data['dateTime'];
                                $creator = $data['creatorName'];
                                $SNo++;
                        ?>
                        <tr>
                            <td><?php echo $SNo ?></td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $creator ?></td>
                            <td><?php echo $time ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End of main area    -->
        </div>
        <!-- End of row -->
        
    </div>
    <!-- End of container -->
    <div id="footer">
        <p>Footer</p>
    
    
    </div>
</body>
</html>