<?php
include("config.php");
require("FPDF/fpdf.php");
if(isset($_GET['logcount'])){
  $logcount=$_GET["logcount"];
}

if(isset($_POST['search'])){
    $employee_id = $_POST['employeeid'];
    $sql = "SELECT * FROM employeetb WHERE employee_id='".$employee_id."'";
    $res = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($res);
}

if(isset($_POST['save'])){
  $employeeid = $_POST['employeeid'];
  $employee_name = $_POST['employee_name'];
  $designation = $_POST['designation'];
  $attendance = $_POST['attendance'];
  $sql = "insert into employee_attendancetb(employeeid, employee_name, designation, attendance)
  values('$employeeid', '$employee_name','$designation', '$attendance')";
    if(mysqli_query($mysqli, $sql)){
      echo"<script>alert('Saved Succesfully')</script>";
    }
    else{
      echo"<script>alert('Faild to Save')</script>";
    }
}



if(isset($_POST['log'])){
  $employeeid = $_POST['employeeid'];
  $employee_name = $_POST['employee_name'];
  $designation = $_POST['designation'];
  $res = mysqli_query($mysqli, "select * from employee_attendancetb where employeeid='".$employeeid."'");
  
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',20);
  $pdf->Cell(55,20,'');
  $pdf->Cell(50,20,'Attendance Log Report');
  $pdf->Ln();
  $pdf->SetFont('Arial','B',18);
  $pdf->Cell(115,10,$employee_name);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(10,8,"Employee ID : ".$employeeid);
  $pdf->Ln();
  $pdf->Cell(115,10,'');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(10,8,"Designation : ".$designation);
  $pdf->Ln();

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(10,10,'ID',1);
  $pdf->Cell(10,10,'E ID',1);
  $pdf->Cell(60,10,'Name',1);
  $pdf->Cell(40,10,'Designation',1);
  $pdf->Cell(30,10,'Attendance',1);
  $pdf->Cell(40,10,'Date',1);
  $pdf->Ln();

  $pdf->SetFont('Arial','',10);
  while($row = mysqli_fetch_array($res)){
      $pdf->Cell(10,8,$row['attendance_id'],1);
      $pdf->Cell(10,8,$row['employeeid'],1);
      $pdf->Cell(60,8,$row['employee_name'],1);
      $pdf->Cell(40,8,$row['designation'],1);
      $pdf->Cell(30,8,$row['attendance'],1);
      $pdf->Cell(40,8,$row['date'],1);
      $pdf->Ln();
  }
  date_default_timezone_set('Asia/Kolkata');
  $date = date('d-m-y h:i:s');
  $pdf->Ln();
  $pdf->Cell(140,8);
  $pdf->Cell(10,8,'Date : '.$date,);
  $pdf->Output();
}
?>
<html>
    <head>
        <title>Employee Attendance</title>
        <link rel="stylesheet" href="csms.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="csms.css">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <i class="material-icons" style="font-size:48px;color:white;text-shadow:2px 2px 4px #000000;">local_taxi</i>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php?logcount=<?php echo $logcount?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="cabs.php?logcount=<?php echo $logcount?>">Cabs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="driver.php?logcount=<?php echo $logcount?>">Drivers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="employee.php?logcount=<?php echo $logcount?>">Employees</a>
                    </li>
                </ul>
                <?php
                if ($logcount==1){
                    echo "<a href='index.php'><button class='btn btn-outline-light' type='submit'>Log Out</button></a>";
                }
                else{
                    echo "<a href='signin.php'><button class='btn btn-outline-light' type='submit'>Sign In</button></a>";
                    echo "<a href='signup.php'><button class='btn btn-outline-light' type='submit'>Sign Up</button></a>";
                }
                ?>
            </div>
        </div>
    </nav>
    <div class="container">
    
    <section class="vh-100 gradient-custom" style="align-content: center; margin-right: 550px;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-4 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem; height: 600px; width: 800px;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">
            <form action="" method="post" enctype="multipart/form-data">

            <div class="row">
              <div class="col-md-9 mb-4">
              <h1 class="fw-bold mb-2 text-uppercase">Employee Attendance</h1><br>
                </div>
                </div>

                <div class="row">
              <div class="col-md-3 mb-4">
                  <div class="form-outline">
                    <h4 class="fw-bold mb-2">Employee ID:</h4>
                  </div>
                </div>
                <div class="col-md-2 mb-4">
                  <div class="form-outline">
                    <input type="text" class="form-control form-control" placeholder="ID" value="<?php if(isset($_POST['search'])){echo $row['employee_id'];}?>" name="employeeid"/>
                  </div>
                </div>
                <div class="col-md-4 mb-4">
                  <div class="form-outline">
                  </div>
                </div>
                <div class="col-md-3 mb-4">
                  <div class="form-outline">
                  <input type="submit" value="Search" name="search" class="btn btn-outline-light btn-lg px-5">
                  </div>
                </div>
                </div>

                <div class="row">
              <div class="col-md-3 mb-4">
                  <div class="form-outline">
                  <h4 class="fw-bold mb-2">Employee Name:</h4>
                  </div>
                </div>
                <div class="col-md-9 mb-4">
                  <div class="form-outline">
                  <input type="text" class="form-control form-control" placeholder="Name" value="<?php if(isset($_POST['search'])){echo $row['name'];}?>" name="employee_name"/>
                  </div>
                </div>
                </div>

                <div class="row">
              <div class="col-md-3 mb-4">
                  <div class="form-outline">
                  <h4 class="fw-bold mb-2">Designation:</h4>
                  </div>
                </div>
                <div class="col-md-9 mb-4">
                  <div class="form-outline">
                  <input type="text" class="form-control form-control" placeholder="Designation" value="<?php if(isset($_POST['search'])){echo $row['designation'];}?>" name="designation"/>
                  </div>
                </div>
                </div>

                <div class="row">
                <div class="col-md-3 mb-4">
                  <div class="form-outline">
                  <h4 class="fw-bold mb-2">Attendance:</h4>
                  </div>
                </div>
                <div class="col-md-2 mb-4">
                  <div class="form-outline">
                  <input class="form-check-input" type="radio" name="attendance" id="flexRadioDefault1" value="Present">
                  <label class="form-check-label" for="flexRadioDefault1">
                    Present
                  </label>
                  </div>
                </div>
                <div class="col-md-2 mb-4">
                  <div class="form-outline">
                  <input class="form-check-input" type="radio" name="attendance" id="flexRadioDefault1" value="Absent">
                  <label class="form-check-label" for="flexRadioDefault1">
                    Absent
                  </label>
                  </div>
                </div>
                </div>

                <br><br><div class="row">
              <div class="col-md-3 mb-4">
              <div class="form-outline">
              <input type="submit" value="Log Report" name="log" class="btn btn-outline-light btn-lg px-5"> 
                  </div>
                </div>
                <div class="col-md-3 mb-4">
              <div class="form-outline">
                  </div>
                </div>
                <div class="col-md-3 mb-4">
              <div class="form-outline">
                  </div>
                </div>
                <div class="col-md-3 mb-4">
              <div class="form-outline">
              <input type="submit" value="Save" name="save" class="btn btn-outline-light btn-lg px-5"><br><br>
                  </div>
                </div>
                </div>
              
            </form>       
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>