<?php
include 'db.php';
$cardnumber=$_GET['cardnumber'];
 $stmt = $conn->prepare("SELECT accountnumber,firstname,middlename,lastname FROM info WHERE cardnumber=$cardnumber");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($accountnumber,$firstname,$middlename,$lastname);
 
if($stmt->fetch())
{
    $stmt->close();
    $stmt2 = $conn->prepare("UPDATE currentlyactive SET accountnumber=$accountnumber WHERE atmnumber=1"); 
    $stmt2->execute();
	 
$temp['success'] = 1; 
 $temp['accountnumber'] = $accountnumber; 
  $temp['firstname'] = $firstname; 
   $temp['middlename'] = $middlename; 
    $temp['lastname'] = $lastname; 
	 


}
else
{
	$temp['success'] = 0; 
	$temp['error'] = 'card number error'; 
	
}
 //traversing through all the result 

 
 //displaying the result in json format 
 echo json_encode($temp);
 
 
 