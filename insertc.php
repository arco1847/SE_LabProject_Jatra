<?php

$hostname='localhost';
$username='root';
$password='';
$dbname='project';
$con=mysqli_connect($hostname,$username,$password,$dbname);
if($con)
{
	echo"conn true";
}
else
{
	echo"co/nn false";
}