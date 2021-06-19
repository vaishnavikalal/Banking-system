<?php
$server  = "localhost";
$username = "root";
$password = "";

$mysqli = new mysqli($server,$username,$password);
if ($mysqli->connect_error) { 
    die('Connect Error (' .  
    $mysqli->connect_errno . ') '.  
    $mysqli->connect_error); 
} 

$sql = "SELECT * FROM bankinfo.customers "; 
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
               <li class="push"><a href="#"><strong>Home</strong></a></li>
               <li><a href="#"><strong>About us</strong></a></li>
               <li><a href="#"><strong>Contact us</strong></a></li>

            </ul>
          </nav>
          <section class= "row">
    <h1>Customer List</h1> 
        <!-- TABLE CONSTRUCTION--> 
        <table > 
            <tr>
                <th>Customer_id</th> 
                <th>Customer_name</th> 
                <th>Email_id</th> 
                <th>Balance</th> 
                <th>action</th> 
                
            </tr> 
            <!-- fetching data code-->
            <?php
          while($rows=$result->fetch_assoc())
          {
          ?>
          <tr>
            <td><?php echo $rows['Customer_id'];?></td>
            <td><?php echo $rows['Customer_name'];?></td> 
            <td><?php echo $rows['Email_id'];?></td> 
            <td><?php echo $rows['Balance'];?></td>
            <td><button type="button" class="btn btn-dark"><a href="selectedUser.php?id= <?php echo $rows['Customer_id'] ;?>"> Transfer Money</a></button></td> 
                
            </tr> 
             <?php 
                } 
             ?> 
         </table>
     </section>
          <footer>
    <p>&copy;2020-2023 STJV co-operative bank ltd</p>
  </footer>
</div>
</body>
</html>
