<?php
include("config.php");
require("FPDF/fpdf.php");
if(isset($_GET['logcount'])){
    $logcount=$_GET["logcount"];
}
$res = mysqli_query($mysqli, "select * from customertb");

if(isset($_POST['log'])){
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',20);
    $pdf->Cell(55,20,'');
    $pdf->Cell(10,20,'Customer Log Report');
    $pdf->Ln();

    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(10,10,'ID',1);
    $pdf->Cell(50,10,'Name',1);
    $pdf->Cell(50,10,'Email',1);
    $pdf->Cell(25,10,'Phone No.',1);
    $pdf->Cell(25,10,'Date of Birth',1);
    $pdf->Cell(30,10,'Rgistration Date',1);
    $pdf->Ln();

    $pdf->SetFont('Arial','',8);
    while($row = mysqli_fetch_array($res)){
        $pdf->Cell(10,8,$row['customer_id'],1);
        $pdf->Cell(50,8,$row['name'],1);
        $pdf->Cell(50,8,$row['email'],1);
        $pdf->Cell(25,8,$row['phone_no'],1);
        $pdf->Cell(25,8,$row['dob'],1);
        $pdf->Cell(30,8,$row['date'],1);
        $pdf->Ln();
    }
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-y h:i:s');
    $pdf->Ln();
    $pdf->Cell(155,8);
    $pdf->Cell(10,8,'Date : '.$date,);
    $pdf->Output();
}
?>
<html>
    <head>
        <title>Customer</title>
        <link rel="stylesheet" href="csms.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
        <h2 style="margin-top: 15px;">Customer</h2><br>
        <form action="" method="post" style="margin-top: 10px;">
    <input type="submit" value="Log Report" name="log" class="btn btn-outline-dark btn-lg">    
    </form>
    <table class="table table-striped table-dark">
        <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone No.</th>
      <th scope="col">Date of Birth</th>
      <th scope="col"></th>
    </tr>
  </thead>
    <?php
    while($row = mysqli_fetch_array($res)){
        echo "<tbody>";
        echo "<tr>";
        echo "<th scope='row'>".$row['customer_id']."</th>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['phone_no']."</td>";
        echo "<td>".$row['dob']."</td>";
        echo "<td><a href='customer_client_view.php?logcount=".$logcount."&customer_id=".$row['customer_id']."'><button class='btn btn-outline-light btn-sm' type='submit'>View</button></a></td>";
        echo "</tr>";
        echo"</tbody>";
    }
    ?>
    </table>            
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>