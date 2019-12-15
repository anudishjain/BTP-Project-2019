<?php
include 'db.php';

 $stmt = $conn->prepare("SELECT accountnumber FROM currentlyactive ");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($accountnumber);
 
if($stmt->fetch())
{
	 
$temp['success'] = 1; 
 $temp['accountnumber'] = $accountnumber; 


}
else
{
	$temp['success'] = 0; 
	$temp['error'] = 'no one is active'; 
	
}
 
 echo json_encode($temp);
 
 
 