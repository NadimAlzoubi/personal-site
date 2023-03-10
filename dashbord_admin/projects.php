<!DOCTYPE html>
<?php 
    include('./conn.php'); 
?>
<?php
    // insert function
    function insertRow($table, $columns, $values, $cover_pic, $all_pics, $file_link) {
        include('./conn.php'); 
        $columnString = implode(",", $columns);
        $valueString = "'" . implode("','", $values) . "'";
        $query = "INSERT INTO $table ($columnString) VALUES ($valueString)";
        // Check if any cover file were uploaded
        if (!empty($cover_pic['name'])) {
            move_uploaded_file($cover_pic['tmp_name'], "./assets/projects_files/" . $cover_pic['name']);
        }
        // Check if any file were uploaded
        if (!empty($file_link['name'])) {
            move_uploaded_file($file_link['tmp_name'], "./assets/projects_files/" . $file_link['name']);
        }
        // Check if any files were uploaded
        if (!empty($all_pics['name'][0])) {
            // Loop through the uploaded files
            for ($i = 0; $i < count($all_pics['name']); $i++) {
                // Get the file name and temporary location
                $pic_name = $all_pics['name'][$i];
                $tmp_name = $all_pics['tmp_name'][$i];      
                move_uploaded_file($tmp_name, "./assets/projects_files/" . $pic_name);
            }
        }
        if (mysqli_query($connect, $query)) {
            ?>
             <script>
                    var pop_alert = document.getElementById("pop_alert");
                    pop_alert.style.display = "flex";
                    pop_alert.innerHTML = '<div class="custom-modal"><div class="succes succes-animation icon-top"><i class="fa fa-check"></i></div><div class="succes border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">Completed successfully</p><button onClick="window.location.href=window.location.href" id="alert_close_btn" class="btn btn-success" style="margin-bottom: 1rem;">Close</button></div></div>';
                </script>
            <?php
        }else{
            ?>
                <script>
                    var pop_alert = document.getElementById("pop_alert");
                    pop_alert.style.display = "flex";
                    pop_alert.innerHTML = '<div class="custom-modal"><div class="danger danger-animation icon-top"><i class="fa fa-times"></i></div><div class="danger border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">A Problem Occurred<br /><span class="type"><?php echo ''; ?></span></p><button onClick="window.location.href=window.location.href" id="alert_close_btn" class="btn btn-danger" style="margin-bottom: 1rem;">Close</button></div></div>';
                </script>
            <?php
        }
    }
    // Example usage
    // insertRow("home", ["name", "age", "gender"], ["John", "20", "male"], '', '');
?>
<!-- *************************************************************************** -->
<!-- *************************************************************************** -->
<!-- ****      ********   *************      ************                   **** -->
<!-- ****   *   *******   ************   *   **************************   ****** -->
<!-- ****   **   ******   ***********   ***   ***********************   ******** -->
<!-- ****   ***   *****   **********   *****   ********************   ********** -->
<!-- ****   ****   ****   *********   *******   *****************   ************ -->
<!-- ****   *****   ***   ********               **************   ************** -->
<!-- ****   ******   **   *******   ***********   ***********   **************** -->
<!-- ****   *******   *   ******   *************   ********   ****************** -->
<!-- ****   ********      *****   ***************   *****                   **** -->
<!-- *************************************************************************** -->
<!-- *************************************************************************** -->
<?php
    // update function
function updateRow($table, $data, $new_cover_pic, $new_all_pics_files, $new_file_link, $id, $errore_msg) {
    include('./conn.php'); 
    $query = "UPDATE $table SET ";
    foreach ($data as $key => $value) {
        $query .= "$key = '$value',";
    }
    // Remove trailing comma
    $query = rtrim($query, ",");
    $query .= " WHERE ID = $id";
    if (mysqli_query($connect, $query)) {
        if (!empty($new_cover_pic['name'])) {
            $pic_name = $new_cover_pic['name'];
            $tmp_name = $new_cover_pic['tmp_name'];      
            move_uploaded_file($tmp_name, "./assets/projects_files/" . $pic_name);
        }
        if (!empty($new_all_pics_files['name'][0])) {
            // Loop through the uploaded files
            for ($i = 0; $i < count($new_all_pics_files['name']); $i++) {
                // Get the file name and temporary location
                $pic_name = $new_all_pics_files['name'][$i];
                $tmp_name = $new_all_pics_files['tmp_name'][$i];      
                move_uploaded_file($tmp_name, "./assets/projects_files/" . $pic_name);
            }
        }
        if (!empty($new_file_link['name'])) {
            $pic_name = $new_file_link['name'];
            $tmp_name = $new_file_link['tmp_name'];      
            move_uploaded_file($tmp_name, "./assets/projects_files/" . $pic_name);
        }
        ?>
            <script>
                var pop_alert = document.getElementById("pop_alert");
                pop_alert.style.display = "flex";
                pop_alert.innerHTML = '<div class="custom-modal"><div class="succes succes-animation icon-top"><i class="fa fa-check"></i></div><div class="succes border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">Completed successfully</p><button onClick="window.location.href=window.location.href" id="alert_close_btn" class="btn btn-success" style="margin-bottom: 1rem;">Close</button></div></div>';
            </script>
        <?php
    }else{
        ?>
            <script>
                var pop_alert = document.getElementById("pop_alert");
                pop_alert.style.display = "flex";
                pop_alert.innerHTML = '<div class="custom-modal"><div class="danger danger-animation icon-top"><i class="fa fa-times"></i></div><div class="danger border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">A Problem Occurred<br /><span class="type"><?php echo $errore_msg ?></span></p><button onClick="window.location.href=window.location.href" id="alert_close_btn" class="btn btn-danger" style="margin-bottom: 1rem;">Close</button></div></div>';
            </script>
        <?php
    }
}
// Example usage
// updateRow("users", ["name" => "John", "age" => 30, "location" => "New York"], '', '', $id);
?>
<!-- *************************************************************************** -->
<!-- *************************************************************************** -->
<!-- ****      ********   *************      ************                   **** -->
<!-- ****   *   *******   ************   *   **************************   ****** -->
<!-- ****   **   ******   ***********   ***   ***********************   ******** -->
<!-- ****   ***   *****   **********   *****   ********************   ********** -->
<!-- ****   ****   ****   *********   *******   *****************   ************ -->
<!-- ****   *****   ***   ********               **************   ************** -->
<!-- ****   ******   **   *******   ***********   ***********   **************** -->
<!-- ****   *******   *   ******   *************   ********   ****************** -->
<!-- ****   ********      *****   ***************   *****                   **** -->
<!-- *************************************************************************** -->
<!-- *************************************************************************** -->

<?php
    // delete function
    function deleteRow($table, $row_id, $pro_imgs) {
        include('./conn.php');
        $query = "DELETE FROM " . $table . " WHERE ID = " . $row_id;
        if (mysqli_query($connect, $query)) {
            $pro_imgs_to_arr = json_decode($pro_imgs);
            for($i = 0; $i < count($pro_imgs_to_arr); $i++){
                unlink("./assets/projects_files/" . $pro_imgs_to_arr[$i]);
            }
            ?>
                <script>
                    var pop_alert = document.getElementById("pop_alert");
                    pop_alert.style.display = "flex";
                    pop_alert.innerHTML = '<div class="custom-modal"><div class="succes succes-animation icon-top"><i class="fa fa-check"></i></div><div class="succes border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">Completed successfully</p><button onClick="window.location.href=window.location.href" id="alert_close_btn" class="btn btn-success" style="margin-bottom: 1rem;">Close</button></div></div>';
                </script>
            <?php
        }else{
            ?>
                <script>
                    var pop_alert = document.getElementById("pop_alert");
                    pop_alert.style.display = "flex";
                    pop_alert.innerHTML = '<div class="custom-modal"><div class="danger danger-animation icon-top"><i class="fa fa-times"></i></div><div class="danger border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">A Problem Occurred</p><button onClick="window.location.href=window.location.href" id="alert_close_btn" class="btn btn-danger" style="margin-bottom: 1rem;">Close</button></div></div>';
                </script>
            <?php
        }
    }
// Example usage
//deleteRow("users", 3); // deletes the row with id 3 from the "users" table
?>
<!-- ///////////////////////////////////////////// -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="" name="description" />
    <meta content="webthemez" name="author" />
    <title>Projects - Admin</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
	
    <link href="assets/css/select2.min.css" rel="stylesheet" >
	<link href="assets/css/checkbox3.min.css" rel="stylesheet" >
        <!-- Custom Styles-->
        <link href="assets/css/custom-styles.css" rel="stylesheet" />
        <link href="../css/resp-grid.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <style>
            .succes {
                background-color: #4BB543;
              }
              .succes-animation {
                box-shadow: 0px 0px 30px 20px rgba(75, 181, 67, .4);
              }
              .danger {
                background-color: #CA0B00;
              }
              .danger-animation {
                box-shadow: 0px 0px 30px 20px rgba(202, 11, 0, .4);
              }
              .custom-modal {
                z-index: 99999999;
                position: absolute;
                width: 350px;
                min-height: 250px;
                background-color: #fff;
                border-radius: 30px;
                margin: 40px 10px;
                animation: succes-div 0.4s ease-out;
              }
              .custom-modal .content { 
                position: absolute;
                width: 100%;
                text-align: center;
                bottom: 0;
              }
              .custom-modal .content .type {
                font-size: 18px;
                color: #999;
              }
              .custom-modal .content .message-type {
                font-size: 24px;
                color: #000;
              }
              .custom-modal .border-bottom {
                position: absolute;
                width: 300px;
                height: 20px;
                border-radius: 0 0 30px 30px;
                bottom: -20px;
                margin: 0 25px;
              }
              .custom-modal .icon-top {
                position: absolute;
                width: 100px;
                height: 100px;
                border-radius: 50%;
                top: -30px;
                margin: 0 125px;
                font-size: 30px;
                color: #fff;
                line-height: 100px;
                text-align: center;
              }
              .page-wrapper-alt {
                position: fixed;
                height: 100vh;
                background-color: #111;
                display: none;
                align-items: center;
                justify-content: center;
                padding: 80px 0;
                width: 100%;
                z-index: 99999;
                opacity: 0.8;
              }
              @keyframes succes-div { 
                0% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
              }

              </style>

</head>
<div class="page-wrapper-alt" id="pop_alert">
</div>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand text-capitalize" href="index.php"><strong><i class="icon fa fa-sitemap"></i> <?php $result_name = mysqli_query($connect, 'SELECT FIRST_NAME FROM home'); echo mysqli_fetch_assoc($result_name)['FIRST_NAME']; ?>.</strong></a>
				<div id="sideNav" href="">
			<i class="fa fa-bars icon"></i> 
			</div>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Doe</strong>
                                    <span class="pull-right text-muted">
                                        <em>Today</em>
                                    </span>
                                </div>
                                <div>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem Ipsum has been the industry's standard dummy text ever since an kwilnw...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem Ipsum has been the industry's standard dummy text ever since the...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">28% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100" style="width: 28%">
                                            <span class="sr-only">28% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">85% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%">
                                            <span class="sr-only">85% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a href="index.php"><i class="fa fa-table"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="home.php"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li>
                        <a href="about.php"><i class="fa fa-info"></i> About</a>
                    </li> 
					 
					 <li>
                        <a href="skills.php"><i class="fa fa-star"></i> Skills<span class="fa arrow"></span></a>
                        <!-- <ul class="nav nav-second-level">
                            <li>
                                <a href="chart.php">Basic skills</a>
                            </li>
                            <li>
                                <a href="morris-chart.php">programming skills</a>
                            </li>
							</ul> -->
					 </li>	
							
                    <li>
                        <a href="resume.php"><i class="fa fa-file-text"></i> Resume</a>
                    </li>
                    
                    <li>
                        <a class="active-menu" href="projects.php"><i class="fa fa-tasks"></i> Projects</a>
                    </li>


                    <li>
                        <a href="contact.php"><i class="fa fa-comments"></i> Contact<span class="fa arrow"></span></a>
                    </li>
                    <li>
                        <a href="footer.php"><i class="fa fa-fw fa-file"></i> Footer & Social media</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
<div id="page-wrapper" >	
    <div id="page-inner"> 


        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <!-- البيانات الظاهرة للمستخدم -->
                    <div class="panel-heading bg-secondary" style="background-color: #bbb;">
                        Data Form / Add Somthig
                    </div> 
                    <div class="panel-body">
                    <form action="./projects.php" method="POST" enctype="multipart/form-data">
                        <div class="sub-title">
                            Choose a project cover photo
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="cover_pic" />
                        </div>
                        <div class="sub-title">
                            Write a simple description of the project
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="simple_des" />
                        </div>
                        <div class="sub-title">
                            Select all project images
                        </div>
                        <div class="form-group">
                            <input id="allFiles" type="file" class="form-control" name="all_pics[]" multiple>
                        </div>
                        <div class="sub-title">
                        Write a full project description. (You can use brackets, dashes, and underscores, and to make text bold, put it in double brackets)
                        </div>
                        <div class="form-group">
                            <textarea id="textarea" onkeydown="handleKeyDown(event)" class="form-control" rows="4" name="full_des"></textarea>
                        </div>
                        <div class="sub-title">
                            Choose file link
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="file_link" />
                        </div>
                        <button type="submit" class="btn btn-primary" name="project_send">Submit</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>


<?php
//how to know lenght of array in php?
// insert
// insert
// insert
if (isset($_POST['project_send'])) {
    $cover_pic = $_FILES['cover_pic'];
    $cover_pic_name = $cover_pic['name'];
    $simple_des = $_POST['simple_des'];
    $full_des = nl2br($_POST['full_des']);
    $all_pics = $_FILES['all_pics'];
    $all_pics_names = ($all_pics['name']);
    $file_link = $_FILES['file_link'];
    $file_link_name = $file_link['name'];
    insertRow("projects", ["COVER_IMG" ,"TITLE", "FULL_DES", "ATTACH"], [$cover_pic_name, $simple_des, $full_des, $file_link_name], $cover_pic, $all_pics, $file_link);
    
    $project_id = mysqli_query($connect, "SELECT ID FROM projects ORDER BY ID DESC LIMIT 1");
    $row = mysqli_fetch_assoc($project_id);

   for($i = 0; $i < count($all_pics_names); $i++){
       insertRow("projects_img", ["PROJECT_ID", "IMG"], [$row['ID'], $all_pics_names[$i]], '', $all_pics, '');
   }
}
?>
<script>
    var kkk = document.getElementById("allFiles");
    kkk.onchange = () => {
        console.log(kkk);
    }
  
</script>
<!-- /////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////  جدول قاعدة البيانات  ////////// -->
<!-- /////////////////////////////////////////////////////////////////// -->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Database Table
            </div> 
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%;">No.</th>
                                <th>Cover pic</th>
                                <th>Title</th>
                                <th>All pics</th>
                                <th>Descriotion</th>
                                <th>File</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql_s = 'SELECT * FROM projects';
                            $result = mysqli_query($connect, $sql_s);
                            $id_num = 1;
                            if(isset($result)){
                                while($row = mysqli_fetch_assoc($result)){
                                    $proId = $row['ID'];
                        ?>
                            <tr>
                                <td style=" padding: 10px;"><?php echo $id_num++ ?></td>
                                <td style=" padding: 10px;"><?php echo $row['COVER_IMG'] ?></td>
                                <td style=" padding: 10px;"><?php echo $row['TITLE'] ?></td>
                                <td style=" padding: 10px;">
                                    <?php
                                        $sql_img = 'SELECT * FROM projects_img WHERE PROJECT_ID = ' . $proId;
                                        $result_img = mysqli_query($connect, $sql_img);
                                        if(isset($result_img)){
                                            $imgs_array = array();
                                            $imgs_ids = array();
                                            while($row_img = mysqli_fetch_assoc($result_img)){
                                                echo '<span><img style="width:40px; margin: 3px" src="../dashbord_admin/assets/projects_files/' . $row_img['IMG'] . '" /></span>';
                                                array_push($imgs_array, $row_img['IMG']);
                                                array_push($imgs_ids, $row_img['ID']);
                                            }
                                            $imgs_arr_to_text = json_encode($imgs_array);
                                            $imgs_ids_to_text = json_encode($imgs_ids);
                                        }      
                                    ?>
                                </td>
                                <td style=" padding: 10px;"><?php echo $row['FULL_DES'] ?></td>
                                <td style=" padding: 10px;"><?php echo $row['ATTACH'] ?></td>
                                <td style=" padding: 10px;">
                                    <form action="./projects.php" method="POST">
                                        <input type="submit" name="delete_project" value="Delete" class="btn btn-danger">
                                        <input type="hidden" name="del_pro_imgs" value="<?php echo htmlspecialchars($imgs_arr_to_text); ?>">
                                        <input type="hidden" name="pro_imgs_ids" value="<?php echo htmlspecialchars($imgs_ids_to_text); ?>">
                                        <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                                        <button type="submit" style="margin-left: 15px;" name="edit_proj_btn" id="edit_proj_btn" class="btn btn-primary">Edit</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>                                     
<!-- /. ROW  -->

<?php
    $delete_project = $_POST['delete_project'];
    if(isset($delete_project)){
        $id = $_POST['id'];
        $del_pro_imgs = $_POST['del_pro_imgs'];
        deleteRow("projects", $id, $del_pro_imgs);
    }
?>

<!-- /////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////  فورم التعديل  ////////////////// -->
<!-- /////////////////////////////////////////////////////////////////// -->
<?php
    $edit_proj_btn = $_POST['edit_proj_btn'];
    if(isset($edit_proj_btn)){
        $id = $_POST['id'];
        $pro_imgs_ids = $_POST['pro_imgs_ids'];
        $sql_update = 'SELECT * FROM projects WHERE ID = ' . $id;
        $result = mysqli_query($connect, $sql_update);
        if(isset($result)){
            while($row = mysqli_fetch_assoc($result)){
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading bg-secondary" style="background-color: #bbb;">
                <span>Edit Form</span>
            </div> 
            <div class="panel-body">
                <div class="table-responsive">
                    <form action="./projects.php" method="POST" enctype="multipart/form-data" id="editForm">
                        <div class="form-group">
                            <label for="">project cover photo</label><br />
                            <label for="">The old file was: <?php echo $row['COVER_IMG']; ?></label><br />
                            <label for="">choose new file</label>
                            <input type="file" class="form-control" name="cover_pic" id="cover_pic"/>                            
                            <input type="hidden" name="old_cover_pic" value="<?php echo $row['COVER_IMG']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Write new simple description for the project</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $row['TITLE']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">choose new images</label>
                            <input id="input_to_disable" type="file" class="form-control" name="new_all_pics[]" multiple/>        
                        </div>
                        <div class="form-group" id="select_box_div">
                            <input type="checkbox" name="select_box" class="form-check-input" id="select_box">
                            <label for="select_box" class="form-check-label">Or select this box to show & modify project images</label>
                        </div>
                        <div class="form-group" id="div_to_hide" style="display:none;">
                            <label for="">This is old files, check images that you want to delete it: </label><br />
                            <div class="parent-custom" style="align-items: flex-end; justify-content: center;">
                            <?php 
                                $imgs_ids_to_arr = json_decode($pro_imgs_ids);
                                $img_index = 0;
                                $sql_img = 'SELECT * FROM projects_img WHERE PROJECT_ID = ' . $id;
                                $result_img = mysqli_query($connect, $sql_img);
                                if(isset($result_img)){
                                    while($row_img = mysqli_fetch_assoc($result_img)){
                                        // Generate the img element
                                        $img = '<img style="width: 60px" src="./assets/projects_files/' . $row_img['IMG'] . '">';
                                        // Generate the input element
                                        $box_name = "delete_" . $imgs_ids_to_arr[$img_index];
                                        $input = '<input type="checkbox" name="' . $box_name . '">';
                                        $img_index++;
                                        // Output the img and input elements
                                        echo '<div style="margin: 0 10px; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 1rem">' . $img . $input . '</div>';
                                    }
                                }      
                            ?>
                            </div>
                                                
                        </div>
                        <div class="form-group">
                            <label for="">Write new full project description. (You can use brackets, dashes, and underscores, and to make text bold, put it in double brackets)</label>
                            <textarea style="height: 100px;" class="form-control" name="new_full_des"><?php echo $row['FULL_DES'] ?></textarea>
                        </div>
                        <div class="form-group" id="checkdiv">
                            <label for="">The old file was: <?php echo $row['ATTACH'] ?></label><br />
                            <input type="checkbox" name="checkbox_to_del" id="checkbox_to_del" class="form-check-input"/>
                            <label for="checkbox_to_del" class="form-check-label">Check this box if you want to delete it</label><br />
                        </div>
                        <div class="form-group" id="file_div">
                            <label for="">Or choose new file</label>
                            <input type="file" class="form-control" name="new_file_link" id="new_file_link">
                            <input type="hidden" name="old_file_link" value="<?php echo $row['ATTACH'] ?>">
                        </div>
                        <input type="hidden" name="imgs_ids_text" value="<?php echo htmlspecialchars($pro_imgs_ids); ?>">
                        <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                        <button type="submit" class="btn btn-primary" name="pro_update_btn">Update</button>
                        <button class="btn btn-primary" style="margin-left: 10px;">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
        }
    }
}
?>
<script>  
    let div_to_hide = document.getElementById("div_to_hide");
    let input_to_disable = document.getElementById("input_to_disable");
    let select_box = document.getElementById("select_box");
    let select_box_div = document.getElementById("select_box_div");
    let checkbox_to_del = document.getElementById("checkbox_to_del");
    let checkdiv = document.getElementById("checkdiv");
    let file_div = document.getElementById("file_div");
    let new_file_link = document.getElementById("new_file_link");
    let isSele = false;
    let isHide = true;
    let file_div_hide = false;
    new_file_link.onchange = () => {
        checkdiv.style.display = 'none';
    }
    checkbox_to_del.onclick = () => {
        if (!file_div_hide) {
            file_div.style.display = 'none';
            file_div_hide = true;
        }else{
            file_div.style.display = 'block';
            file_div_hide = false;
        }

    }
    input_to_disable.onchange = () => {
        select_box_div.style.display = 'none';
    }
    select_box.onclick = () => {
        if(isHide == true){
            div_to_hide.style.display = 'block';
            input_to_disable.style.display = 'none';
            isHide = false;
        } else {
            div_to_hide.style.display = 'none';
            input_to_disable.style.display = 'block';
            isHide = true;
        }
    }
</script>

<?php
    $pro_update_btn = $_POST['pro_update_btn'];
    if(isset($pro_update_btn)){
        $id = $_POST['id'];
        $cover_pic = $_FILES['cover_pic'];
        if(!empty($_FILES['cover_pic']['name'])){
            $new_cover_pic_name = $_FILES['cover_pic']['name'];
        } else {
            $new_cover_pic_name = $_POST['old_cover_pic'];
        }
        $new_all_pics_files = $_FILES['new_all_pics'];
        $title = str_replace("'", "\'", $_POST['title']);
        $select_box = $_POST['select_box'];
        $imgs_ids_text = $_POST['imgs_ids_text'];
        $imgs_ids_arr = json_decode($imgs_ids_text);
        if(isset($select_box)){
            for($i = 0; $i < count($imgs_ids_arr); $i++) {
                $box_name = "delete_" . $imgs_ids_arr[$i];
                $checkbox = $_POST[$box_name];
                if(isset($checkbox)) {
                    $sql_img = 'SELECT * FROM projects_img WHERE ID = ' . $imgs_ids_arr[$i];
                    $result_img = mysqli_query($connect, $sql_img);
                    if(isset($result_img)){
                        while($row_img = mysqli_fetch_assoc($result_img)){
                            // The checkbox was checked
                            unlink("./assets/projects_files/" . $row_img['IMG']);
                            deleteRow("projects_img", $imgs_ids_arr[$i], null);
                        }
                    }
                }
            }
        }
        $new_full_des = nl2br($_POST['new_full_des']);

        $new_file_link = $_FILES['new_file_link'];
        $old_file_link = $_POST['old_file_link'];

        $checkbox_to_del = $_POST['checkbox_to_del'];
        
        if(empty($_FILES['new_file_link']['name'])){ 
            $new_file_name = $old_file_link;
            if($checkbox_to_del == true){
                unlink("./assets/projects_files/" . $new_file_name);
                $new_file_name = "No file selected";
            }
        }else{
            $new_file_name = $_FILES['new_file_link']['name'];
            unlink("./assets/projects_files/" . $old_file_link);
        }    
        updateRow("projects", ["COVER_IMG" => $new_cover_pic_name, "TITLE" => $title, "FULL_DES" => $new_full_des, "ATTACH" => $new_file_name], $cover_pic, $new_all_pics_files, $new_file_link, $id, '');
        if(!empty($new_all_pics_files['name'][0])){
            for($i = 0; $i < count($new_all_pics_files['name']); $i++){
                insertRow("projects_img", ["PROJECT_ID", "IMG"], [$id, $new_all_pics_files['name'][$i]], '', '', '');
            }
        }
    }
?>

               
			<footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez.com</a></p></footer>
			</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
	<script src="assets/js/select2.full.min.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>    
</body>
</html>

