<?php
  include_once('includes/header.php');
  include_once('includes/dbhandler.inc.php');
 ?>
 <div class="row greeting">
   <div class="col-md-4">
     <h2>Hello, <?php echo ''.$_SESSION["name"] ?></h2>
   </div>
 </div>

 <hr>

 <!---Alart------------------>
    <?php if (isset($_SESSION['res-add'])) { ?>
    <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
     <?= $_SESSION['res-add']; ?>
   </div>
 <?php } unset($_SESSION['res-add']); unset($_SESSION['res_type']); ?>

 <div class="container-fluid">
   <div class="row justify-content-center">
   </div>
   <div class="row">
     <div class="col-md-4">
       <?php
       $addCourseTitle = "Add Course To Portfolio";
       $durationDisplay = "--Select Course Duration--";
       $display1 = "--Select Course --";
       $display2 = "--Select Instructor--";

       $courseName = "default";
       $instruct = "default";
       $duration = "default";
       $text_type = "info";
       $btn_type = "primary";
       $btn_action_name = "add";
       $btn_label = "Add Course To Portfolio";
       $ABBITIARY_CONSTANT = 0000000;
       $id = $ABBITIARY_CONSTANT;


       if (isset($_GET['edit'])) {
         $addCourseTitle = "Edit Course Details";
         $courseName = $_GET['name'];
         $display1 = $_GET['name'];

         $instruct = $_GET['instructor'];
         $display2 = $_GET['instructor'];

         $duration = $_GET['duration'];
         $durationDisplay = $_GET['duration'];

         $btn_type = "success";
         $btn_action_name = "update";
         $btn_label = "Save Changes Made";
         $text_type = "success";
         $_SESSION['courseId'] = $_GET['edit'];


       }

        ?>
       <h3 class="text-center text-<?= $text_type ?>"><?= $addCourseTitle ?></h3>
       <form action="includes/signup.inc.php" method="post">
         <div class="form-group">

           <select class="form-control text-center" name="course">

             <option value=<?= $courseName ?>><?= $display1 ?></option>
             <option value="Java Backend Fundermentals">Java Backend Fundermentals</option>
             <option value="Java Backend Advanced Learners">Java Backend Advanced Learners</option>
             <option value="Javascript For FrontEnd">Javascript For FrontEnd</option>
             <option value="Javascript For BackEnd">Javascript For BackEnd</option>
             <option value="PHP Fundermentals">PHP Fundermentals</option>
             <option value="PHP Plus Laravel">PHP Plus Laravel</option>
             <option value="Complete Bootstrap Course">Complete Bootstrap Course</option>
             <option value="Node.js Plus Express">Node.js Plus Express</option>
             <option value="Python BackEnd plus Django">Python BackEnd plus Django</option>
           </select>
         </div>

         <div class="form-group">
           <select class="form-control text-center" name="instructor">

             <option value=<?= $instruct ?>><?= $display2 ?></option>
             <option value="Damilola Ige">Damilola Ige</option>
             <option value="Abbasikwere">Abbasikwere</option>
             <option value="Seun Xylus">Seun Xylus</option>
             <option value="Tumosun">Tumosun</option>
             <option value="Tomiwa Ajayi">Tomiwa Ajayi</option>
           </select>
         </div>
         <div class="form-group">
           <select class="form-control text-center" name="duration">
             <option value=<?= $duration ?>><?= $durationDisplay ?></option>
             <option value="3-Months">3-Months</option>
             <option value="6-Months">6-Months</option>
             <option value="9-Months">9-Months</option>
             <option value="12-Months">12-Months</option>
           </select>
         </div>
         <div class="form-group">
           <button class="btn btn-<?= $btn_type ?> btn-block" type="submit" name=<?= $btn_action_name ?>><?= $btn_label ?></button>
         </div>

       </form>

     </div>
     <div class="col-md-8">

       <?php
       // Query All courses registered by the current user using an inner join query
           $activeUserId = $_SESSION['id'];
           $sql = "SELECT DISTINCT usercourses.courseId, usercourses.coursName, usercourses.courseInstructor, usercourses.courseDuration
                    FROM usercourses
                    INNER JOIN users
                    ON usercourses.courseUserId =?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $activeUserId );
            $stmt->execute();
            $qResult = $stmt->get_result();

        ?>


       <h3 class="text-center text-info">My Course Portfolio</h3>
       <table class="table table-striped">
    <thead>
      <tr>
        <th>Course Id</th>
        <th>Course Name</th>
        <th>Course Instructor</th>
        <th>Duration</th>
        <th>Action</th>

      </tr>
    </thead>
    <tbody>
    <?php while ($courseRow = $qResult->fetch_assoc()) { ?>
      <tr>
        <td> <?= $courseRow['courseId'] ?> </td>
        <td><?= $courseRow['coursName'] ?></td>
        <td><?= $courseRow['courseInstructor'] ?></td>
        <td><?= $courseRow['courseDuration'] ?></td>
        <td>
          <a href="dashboard.php?edit=<?= $courseRow['courseId'] ?>&name=<?= $courseRow['coursName'] ?>&instructor=<?= $courseRow['courseInstructor'] ?>&duration=<?= $courseRow['courseDuration'] ?>" class="btn btn-sm btn-success">Edit</a> &nbsp;
          <a href="includes/signup.inc.php?delete=<?= $courseRow['courseId'] ?></a>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
         </td>
      </tr>
    <?php } ?>

    </tbody>
  </table>

     </div>
   </div>
 </div>


<?php
  include_once('includes/footer.php')
 ?>
