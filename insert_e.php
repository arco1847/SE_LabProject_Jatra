<?php
session_start();
$email = $_SESSION['email'];
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'jatra';
$con = mysqli_connect($hostname,$username,$password,$dbname);

if($con)
{
	echo"conn true";
}
else
{
	echo"conn false";
}
$sr = "SELECT * FROM customer_details_e ORDER BY p_id DESC";
$rr = mysqli_query($con,$sr);
$data = mysqli_fetch_assoc($rr);

if(mysqli_num_rows($rr)==0)
{
    $p_id=1;
}  
else{
  $p_id=$data['p_id']+1;
  if($p_id==6)
  {
    header("Location:not.php?");
  }
}


$Number_PLate = $_GET['Number_PLate'];
$Price=$_GET['Price'];
$sr="SELECT * FROM customer_details_c where Number_PLate='$Number_PLate'";
$rr=mysqli_query($con,$sr);
$data=mysqli_fetch_array($rr);
if($data){
  header("Location:not.php?");
}


$sr="SELECT * FROM customer_details_e where Number_PLate='$Number_PLate'";
$rr=mysqli_query($con,$sr);
$data=mysqli_fetch_array($rr);
if($data){
  header("Location:not.php?");
}


$qr="SELECT * FROM register WHERE email='$email'";
$rq=mysqli_query($con,$qr);

  $data=mysqli_fetch_assoc($rq);
    $name=$data['name'];
$email=$data['email'];
$contactno=$data['contactno'];
if(isset($_POST['pickup_address']) && isset($_POST['price'])){
  $contactno=$data['contactno']; 
  $pickup_address=$_POST['pickup_address'];

    $price=2*$_POST['price']+10000;
    

$q="INSERT INTO customer_details_e(name,email,contactno,pickup_address,Number_PLate,price,p_id)VALUES('$name','$email','$contactno','$pickup_address','$Number_PLate','$price','$p_id')";
$r=mysqli_query($con,$q);
if($r)
{
echo"<h1 style='color:white;'>ordered succesfull</h1>";
}
else
{
    echo"please try again";
}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
  background:Black;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>

<h2>Customer details Form</h2>

<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="" method="POST">
      
        <div class="row">
          <div class="col-50">
            
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" value="<?php echo $name?>" name="name" placeholder="name">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email"value="<?php echo $email?>" name="email" placeholder="email">
            <label for="text"><i class="fa fa-phone"></i> contact_no.</label>
            <input type="text" value="<?php echo $contactno?>" name="contactno" placeholder="880-01xxxxxxxxx">
            <label for="adr"><i class="fa fa-address-card-o"></i> pick_up Address</label>
            <input type="text" id="adr" name="pickup_address" placeholder="road-building">

<br>
            <label for="Price"><i class="fa fa-dollar"></i>per day price</label>
            <input type="text" value="<?php echo $Price?>" name="price" placeholder="Price">
            <label for="Price"><i class="fa fa-dollar"></i> p_id</label>
            <input type="text" value="<?php echo $p_id?>" name="p_id" placeholder="p_id">
            <label for="text">Number_PLate</label>
            <input type="text" value="<?php echo $Number_PLate?>" name="Number_PLate">
           

            
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text"   placeholder="cardname">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum"  placeholder="xxxx-xxxx-xxxx-xxxx">
            <label for="expmonth">Exp Date</label>
            <input type="text" id="expdate">
            <label for="expmonth">Exp Month</label>
            
                <input type="text" id="expmonth" >
              
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv"  placeholder="cvv">
              </div>
              </div>
            </div>
          </div>
          
        </div>
    
        <input type="submit" value="submit" class="btn">
      </form>
    </div>
  </div>
  
</div>

</body>
</html>
