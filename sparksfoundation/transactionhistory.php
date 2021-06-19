<?php
$server  = "localhost:3360";
$username = "root";
$password = "";

$mysqli = new mysqli($server,$username,$password);
if ($mysqli->connect_error) { 
    die('Connect Error (' .  
    $mysqli->connect_errno . ') '.  
    $mysqli->connect_error); 
} 

$sql = "SELECT * FROM bankinfo.transaction "; 
$result = $mysqli->query($sql); 
$mysqli->close();  
?>


<!DOCTYPE html>
<html>
<head>
    <title>banking system</title>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <div class="cover">
           <nav class="zone  sticky">
         <div class="logo"><a href="#"><img src="logo_small.png"></a>
          </div>
            <ul class="menubar">
             <li><a href="#"><strong>STJV bank</strong></a></li>  
               <li class="push"><a href="index.html"><strong>Home</strong></a></li>
               <li><a href="about.html"><strong>About us</strong></a></li>
               <li><a href="about.html"><strong>Contact us</strong></a></li>

            </ul>
          </nav>
          <section class="row">
    <h1 class="text-center">Past Transaction</h1>
    <!-- TABLE CONSTRUCTION-->
    <table>
      <tr>
        <th>ID</th>
        <th>Sender</th>
        <th>Receiver</th>
        <th>Amount</th>
        <th>Date</th>

      </tr>
      <!-- PHP CODE TO FETCH DATA FROM ROWS-->
      <?php   // LOOP TILL END OF DATA  
                while($rows=$result->fetch_assoc()) 
                { 
             ?>
      <tr>
        <!--FETCHING DATA FROM EACH  
                    ROW OF EVERY COLUMN-->
        <td>
          <?php echo $rows['sno'];?>
        </td>
        <td>
          <?php echo $rows['sender'];?>
        </td>
        <td>
          <?php echo $rows['receiver'];?>
        </td>
        <td>
          <?php echo $rows['amount'];?>
        </td>
        <td>
          <?php echo $rows['datetime'];?>
        </td>

      </tr>
      <?php 
                } 
             ?>
    </table>

  </section>
 </div>
      <footer>
    <p>&copy;2020-2023 STJV co-operative bank ltd</p>
  </footer>
  
</body>
</html>