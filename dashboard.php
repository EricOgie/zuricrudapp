<?php
  include_once('includes/header.php');
 ?>



 <h1>Hello, <?php echo ''.$_SESSION["name"] ?></h1>
 <p>Welcome to your study</p>
 <h3>Enrolled Course List</h3>

 <ul>
   <li>Basic HTML</li>
   <li>CSS For All Developers</li>
   <li>Basics of UI and UX Desgns</li>
 </ul>

 <div class="">

 </div>

 <form action="/action_page.php">
   <div class="">
     <label >Select and Add Courses:</label>
   </div>
   <div class="">
     <select name="cars" id="cars">
       <option value="volvo">--Select--</option>
       <option value="volvo">PHP Backend With Laravel</option>
       <option value="saab">Javascrip & NodeJs</option>
       <option value="opel">Python Backend</option>
       <option value="audi">Audi</option>
     </select>
     <button  type="submit" name="add">Add Course</button>
   </div>

  <div class="">

  </div>

</form>



<?php
  include_once('includes/footer.php')
 ?>
