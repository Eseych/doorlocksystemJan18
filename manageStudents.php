<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Manage Students</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/manageStudent.css">
        <script src="https://kit.fontawesome.com/1658d4fd0c.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
  	     <script src="https://code.jquery.com/jquery-3.3.1.js"
  	        integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  	        crossorigin="anonymous">
  	         </script>
      <script type="text/javascript" src="js/bootbox.min.js"></script>
  	<script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
</head>
<body >
  <?php include'header.php'; ?>
  <div style="
    margin-left: 10px;">
  <main>
  	<div class="form-style-5 slideInDown animated ">
  		<form method="POST" name="addStudentFrm" id="addStudentFrm">
  			<div class="alert_user"></div>
  			<fieldset>
  				<legend><span class="number">1</span> Student Info</legend>
  				<input type="hidden" name="studentID" id="studentID">
  				<input type="text" name="studentNumber"  placeholder="Student Number..." required>
  				<input type="text" name="firstName"  placeholder="First Name..." required>
  				<input type="text" name="lastName"  placeholder="Last Name..." required>
          <label for="Section"><b>Sections</b></label>

                      <select class="sectionSelect" name="sectionSelect"  style="color: #000;">
                        <option value="0">All Sections</option>
                        <?php
                          require'connectDB.php';
                          $sql = "SELECT * FROM section_tbl ORDER BY sectionID ASC";
                          $result = mysqli_stmt_init($conn);
                          if (!mysqli_stmt_prepare($result, $sql)) {
                              echo '<p class="error">SQL Error</p>';
                          }
                          else{
                              mysqli_stmt_execute($result);
                              $resultl = mysqli_stmt_get_result($result);
                              while ($row = mysqli_fetch_assoc($resultl)){
                        ?>
                                <option value="<?php echo $row['sectionName'];?>"><?php echo $row['sectionName']; ?></option>
                        <?php
                              }
                          }
                        ?>
                      </select>
  			</fieldset>
  			<fieldset>
  			<legend><span class="number">2</span> Additional Info (Optional)</legend>
  			<label>
          <label for="Section"><b>Organization</b></label>
                      <select class="orgSelect" name="orgSelect"  style="color: #000;">
                        <option value="0">All Organization </option>
                        <?php
                          require'connectDB.php';
                          $sql = "SELECT * FROM org_tbl ORDER BY orgID ASC";
                          $result = mysqli_stmt_init($conn);
                          if (!mysqli_stmt_prepare($result, $sql)) {
                              echo '<p class="error">SQL Error</p>';
                          }
                          else{
                              mysqli_stmt_execute($result);
                              $resultl = mysqli_stmt_get_result($result);
                              while ($row = mysqli_fetch_assoc($resultl)){
                        ?>
                                <option value="<?php echo $row['orgName'];?>"><?php echo $row['orgName']; ?></option>
                        <?php
                              }
                          }
                        ?>
                      </select>
          <label for="active"><b>Status</b></label>
  	      	</label >
  			</fieldset>
  			<button type="submit" id ="addStudentBtn" name="addStudentBtn" class="btn btn-primary">Add Student</button>
  		</form>
<br>
      <legend><span class="number">3</span> Batch Upload (Optional)</legend>

          <form class="" action="" method="post" enctype="multipart/form-data">
          <input type="file" name="excel" required value="">
          <button type="submit" name="import">Import</button>
        </form>
  	</div>
    <!--############################################################################# -->
    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->

    <div class="modal fade" id="editStudentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id_Student" id="update_id_Student">

                        <div class="form-group">
                            <label> Student Number </label>
                            <input type="text" name="studentNumber" id="studentNumber" class="form-control"
                                placeholder="Enter Student Name">
                        </div>
                        <div class="form-group">
                            <label> Student First Name </label>
                            <input type="text" name="firstName" id="firstName" class="form-control"
                                placeholder="Enter Student's First Name">
                        </div>
                        <div class="form-group">
                            <label> Student Last Name </label>
                            <input type="text" name="lastName" id="lastName" class="form-control"
                                placeholder="Enter Student's Last Name">
                        </div>
                        <label for="Section"><b>Sections</b></label>

                                    <select class="sectionSelect" name="sectionSelect" id="sectionSelect" style="color: #000;">
                                      <option value="0">All Sections</option>
                                      <?php
                                        require'connectDB.php';
                                        $sql = "SELECT * FROM section_tbl ORDER BY sectionID ASC";
                                        $result = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($result, $sql)) {
                                            echo '<p class="error">SQL Error</p>';
                                        }
                                        else{
                                            mysqli_stmt_execute($result);
                                            $resultl = mysqli_stmt_get_result($result);
                                            while ($row = mysqli_fetch_assoc($resultl)){
                                      ?>
                                              <option value="<?php echo $row['sectionName'];?>"><?php echo $row['sectionName']; ?></option>
                                      <?php
                                            }
                                        }
                                      ?>
                                    </select>
                			</fieldset>
                			<fieldset>
                			<legend><span class="number">2</span> Additional Info (Optional)</legend>
                			<label>
                        <label for="Section"><b>Organization</b></label>
                                    <select class="orgSelect" name="orgSelect" id="orgSelect"  style="color: #000;">
                                      <option value="0">All Organization </option>
                                      <?php
                                        require'connectDB.php';
                                        $sql = "SELECT * FROM org_tbl ORDER BY orgID ASC";
                                        $result = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($result, $sql)) {
                                            echo '<p class="error">SQL Error</p>';
                                        }
                                        else{
                                            mysqli_stmt_execute($result);
                                            $resultl = mysqli_stmt_get_result($result);
                                            while ($row = mysqli_fetch_assoc($resultl)){
                                      ?>
                                              <option value="<?php echo $row['orgName'];?>"><?php echo $row['orgName']; ?></option>
                                      <?php
                                            }
                                        }
                                      ?>
                                    </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatestudentdata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

  <!--############################################################################# -->

  <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deleteStudentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id_student" id="delete_id_student">

                        <h4> Do you want to Delete this Data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletestudentdata" class="btn btn-primary"> YES </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

  <!--############################################################################# -->



    <div class="section">
        <!--User table-->
        <div class="table-responsive-md-6 table slideInRight animated" style="max-height: 37.5rem">
          <table class="table" id="datatableid">
            <thead>
              <tr>

                <th>Card UID</th>
                <th>Student Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Section</th>
                <th>Organization</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="table-secondary">
              <br>
           <?php
                //Connect to database
                require'connectDB.php';
                  $sql = "SELECT * FROM student_tbl ORDER BY studentID DESC";
                  $result = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_assoc($result))
                  {
                ?>
                            <TR>
                              <td><?php
                              		if ($row['studentID'] == 1) {
                              			echo "<span><i class='glyphicon glyphicon-ok' title='The selected UID'></i></span>";
                              		}
                                  $card_uid = $row['card_uid'];
                              	?>
                              	<form>
                              		<button type="button" class="select_btn" id="<?php echo $card_uid;?>" title="select this UID"><?php echo $card_uid;?></button>
                              	</form></td>
                            <TD><?php echo $row['studentNumber'];?></TD>
                            <TD><?php echo $row['firstName'];?></TD>
                            <TD><?php echo $row['lastName'];?></TD>
                            <TD><?php echo $row['sectionID'];?></TD>
                            <TD><?php echo $row['orgName'];?></TD>
                            <td>
                              <button type="button" class="btn btn-success editbtn"> EDIT</button>
                              <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                            </td>
                          </TR>

              <?php
                      }
              ?>
            </tbody>
          </table>
        </div>
    </div>

        <script>
             $(document).ready(function () {

                 $('.deletebtn').on('click', function () {

                     $('#deleteStudentmodal').modal('show');

                     $tr = $(this).closest('tr');

                     var data = $tr.children("td").map(function () {
                         return $(this).text();
                     }).get();

                     console.log(data);

                     $('#delete_id_student').val(data[0]);

                 });
             });
         </script>

         <script>
              $(document).ready(function () {

                  $('.editbtn').on('click', function () {

                      $('#editStudentmodal').modal('show');

                      $tr = $(this).closest('tr');

                      var data = $tr.children("td").map(function () {
                          return $(this).text();
                      }).get();

                      console.log(data);

                      $('#update_id_Student').val(data[0]);
                      $('#studentNumber').val(data[1]);
                      $('#firstName').val(data[2]);
                      $('#lastName').val(data[3]);
                      $('#sectionSelect').val(data[4]);
                      $('#orgSelect').val(data[5]);

                  });
              });
          </script>

      </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
   <script>
       $(document).ready(function () {

           $('#datatableid').DataTable({
               "pagingType": "full_numbers",
               "lengthMenu": [
                   [10, 25, 50, -1],
                   [10, 25, 50, "All"]
               ],
               responsive: true,
               language: {
                   search: "_INPUT_",
                   searchPlaceholder: "Search Your Data",
               }
           });
       });
   </script>

<!--PHPPPPP-->
  <?php

    include ('connectDB.php');

    if(isset($_POST['addStudentBtn'])){
      $studNum = $_POST['studentNumber'];
      $fname = $_POST['firstName'];
      $lname = $_POST['lastName'];
      $secID =$_POST['sectionSelect'];
      $org =$_POST['orgSelect'];
      // echo $nameTxt;
      $check_student_number = "SELECT * FROM student_tbl WHERE studentNumber='$studNum'";
      $result = $conn->query($check_student_number);
      if ($result->num_rows > 0) {
        // student number already exists in the database
        echo  "<script>alert('Student number is already taken. Please use a different one.'); setTimeout(function(){ window.location.href='manageStudents.php'; }, 200);</script>";
      } else {
        // student number is available
        $addStudentQuery = "INSERT INTO `student_tbl`(`studentNumber`, `firstName`, `lastName`, `sectionID`,`orgName`)
        VALUES ('$studNum','$fname','$lname','$secID','$org')";

        // update student count in section_tbl
        $updateStudentCountQuery = "UPDATE section_tbl SET student_count = student_count + 1 WHERE sectionName = '$secID'";
        $updateStudentCountResult = mysqli_query($conn, $updateStudentCountQuery);
        $updateOrgCountQuery = "UPDATE org_tbl SET org_count = org_count + 1 WHERE orgName = '$org'";
        $updateOrgCountResult = mysqli_query($conn, $updateOrgCountQuery);
        $result = $conn->query($addStudentQuery);
        if($result)
        {
          echo "Data inserted";
        }
        else {
          echo "Error";
        }
        echo "<script>window.location.replace('manageStudents.php')</script>";
        exit();
      }

    }
  ?>
  </script>
  <?php
  		if(isset($_POST["import"])){
  			$fileName = $_FILES["excel"]["name"];
  			$fileExtension = explode('.', $fileName);
        $fileExtension = strtolower(end($fileExtension));
  			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

  			$targetDirectory = "uploads/" . $newFileName;
  			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

  			error_reporting(0);
  			ini_set('display_errors', 0);

  			require 'excelReader/excel_reader2.php';
  			require 'excelReader/SpreadsheetReader.php';

  			$reader = new SpreadsheetReader($targetDirectory);
  			foreach($reader as $key => $row){
  				$studNum = $row[0];
  				$fname = $row[1];
  				$lname = $row[2];
  				$section = $row[3];
  				$orgName = $row[4];
  				mysqli_query($conn, "INSERT INTO student_tbl VALUES('', '$fname', '$lname', '$studNum','','','','','','$orgName','$section')");


  			}
  			echo
  			"
  			<script>
  			alert('Succesfully Imported');
  			document.location.href = '';
  			</script>
  			";
  		}
  		?>
      </div>
</body>

<!--############################################################################# -->
<!--Update Adviser php-->
<?php
include ('connectDB.php');

if(isset($_POST['updatestudentdata']))
    {
        $studentID = $_POST['update_id_Student'];
        $studentNumber = $_POST['studentNumber'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $sectionID = $_POST['sectionSelect'];
        $orgName = $_POST['orgSelect'];

        $query = "UPDATE student_tbl SET studentNumber='$studentNumber', firstName='$firstName', lastName='$lastName', sectionID='$sectionID', orgName='$orgName'  WHERE studentID='$studentID' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo "<script>window.location.replace('manageStudents.php')</script>";
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
  ?>
<!--############################################################################# -->
<!--Delete Adviser php-->
<?php
include ('connectDB.php');

if(isset($_POST['deletestudentdata']))
{
    $studentID = $_POST['delete_id_student'];

    $query = "DELETE FROM student_tbl WHERE studentID='$studentID'";
    $query_run = mysqli_query($connn, $query);

    if($query_run)
    {
        echo "<script>window.location.replace('manageStudents.php')</script>";
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}

?>


</html>
