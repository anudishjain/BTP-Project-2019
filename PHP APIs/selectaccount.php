 <?php
include 'db.php';
$accounttype=$_GET['accounttype'];



 if($accounttype==='current')
 {
	$stmt = $conn->prepare("UPDATE currentlyactive SET accounttype='current' WHERE atmnumber=1"); 
 }
 else if($accounttype==='savings'){
	 
	 $stmt = $conn->prepare("UPDATE currentlyactive SET accounttype='savings' WHERE atmnumber=1"); 
 }
 else
 {
	$temp['success'] = 0; 
	$temp['error'] = 'not selected'; 
 echo json_encode($temp);
 exit;
 }

 //executing the query 
 
if($stmt->execute())
{
$temp['success'] = 1; 
}
else
{
	$temp['success'] = 0; 
	$temp['error'] = 'not selected'; 
	
}
 //traversing through all the result 

 
 //displaying the result in json format 
 echo json_encode($temp);
 
 
 