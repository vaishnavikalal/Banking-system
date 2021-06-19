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
if(isset($_POST['submit']))
{
 
$from = $_GET['id'];
$to = $_POST['to'];
$amount = $_POST['amount'];

$sql = "SELECT * FROM bankinfo.customers where Customer_id=$from "; 
$result = $mysqli->query($sql);
$rows=$result->fetch_assoc();


$sql = "SELECT * from bankinfo.customers where Customer_id=$to";
$result = $mysqli->query($sql);
$rows1=$result->fetch_assoc();



if (($amount)<0)
{
     echo '<script type="text/javascript">';
     echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
     echo '</script>';
 }

 else if($amount >$rows['Balance']) 
 {
     
     echo '<script type="text/javascript">';
      echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
      echo '</script>';
 }
 

 else if($amount == 0){

  echo "<script type='text/javascript'>";
    echo "alert('Oops! Zero value cannot be transferred')";
    echo "</script>";
}





else {
        
  // deducting amount from sender's account
  $newbalance = $rows['Balance'] - $amount;
  $sql = "UPDATE bankinfo.customers set Balance=$newbalance where id=$from";
  mysqli_query($mysqli,$sql);


  // adding amount to reciever's account
  $newbalance = $rows1['Balance'] + $amount;
  $sql = "UPDATE bankinfo.customers set Balance=$newbalance where id=$to";
  mysqli_query($mysqli,$sql);
  
  $sender = $rows['Customer_name'];
  $receiver = $rows1['Customer_name'];
  $sql = "INSERT INTO bankinfo.transaction(`sender`, `receiver`, `amount`) VALUES ('$sender','$receiver','$amount')";
  $query=mysqli_query($mysqli,$sql);

  if($query){
       echo "<script> alert('Transaction Successful');
        window.location = 'transactionhistory.php';
      </script>";
      
  }

  $newbalance= 0;
  $amount =0;
}
}
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
          
          <div class="container">
    <h2 class="text-center pt-4">Transaction</h2>
    <?php
                $server  = "localhost:3360";
                $username = "root";
                $password = "";
              
                
                $mysqli = mysqli_connect($server,$username,$password);
                if ($mysqli->connect_error) { 
                    die('Connect Error (' .  
                    $mysqli->connect_errno . ') '.  
                    $mysqli->connect_error); 
                } 
                
                 
               
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  bankinfo.customers where Customer_id = $sid";
                $result = $mysqli->query($sql); 
              
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($mysqli);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
    <form method="post" name="tcredit" class="tabletext"><br>
      <div>
        <table class="table table-striped table-condensed table-bordered">
          <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Balance</th>
          </tr>
          <tr>
            <td class="py-2">
              <?php echo $rows['Customer_id'] ?>
            </td>
            <td class="py-2">
              <?php echo $rows['Customer_name'] ?>
            </td>
            <td class="py-2">
              <?php echo $rows['Email_id'] ?>
            </td>
            <td class="py-2">
              <?php echo $rows['Balance'] ?>
            </td>
          </tr>
        </table>
      </div>
      <br>
      <label>Transfer To:</label>
      <select name="to" class="form-control" required>
        <option value="" disabled selected>Choose</option>
        <?php
                $server  = "localhost:3360";
                $username = "root";
                $password = "";
                $mysqli = mysqli_connect($server,$username,$password);
                if ($mysqli->connect_error) { 
                    die('Connect Error (' .  
                    $mysqli->connect_errno . ') '.  
                    $mysqli->connect_error); 
                } 
                
                $sid=$_GET['id'];
                $sql = "SELECT * FROM bankinfo.customers where Customer_id!=$sid";
                 $result = $mysqli->query($sql);
                 
              
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($mysqli);
                } 
               
                   // LOOP TILL END OF DATA  
                   while($rows=$result->fetch_assoc()) {
                
             
            ?>
        <option class="table" value="<?php echo $rows['Customer_id'];?>">

          <?php echo $rows['Customer_name'] ;?> (Balance:
          <?php echo $rows['Balance'] ;?> )

        </option>
        <?php 
                } 
            ?>
        <div>
      </select>
      <br>
      <br>
      <label>Amount:</label>
      <input type="number" class="form-control" name="amount" required>
      <br><br>
      <div class="text-center">
        <button class="btn btn-dark" name="submit" type="submit">Make Payment</button>

      </div>
    </form>
  </div> 
    <section class= "row">
        <!-- TABLE CONSTRUCTION--> 
        
     </section>
         
</div>
 <footer>
    <p>&copy;2020-2023 STJV co-operative bank ltd</p>
  </footer>
</body>
</html>
