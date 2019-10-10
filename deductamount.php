 <?php
include 'db.php';
$accountnumber=$_GET['accountnumber'];
$accounttype=$_GET['accounttype'];
$amount=$_GET['amount'];
 
 if($accounttype==='savings')
 {
	$stmt = $conn->prepare("UPDATE info SET savingsbalance=savingsbalance-$amount,lasttransaction=now() WHERE accountnumber=$accountnumber"); 
 }
 else if($accounttype==='current'){
	 
	 $stmt = $conn->prepare("UPDATE info SET currentbalance=currentbalance-$amount,lasttransaction=now() WHERE accountnumber=$accountnumber"); 
 }
 else
 {
	$temp['success'] = 0; 
	$temp['error'] = 'accouttype error'; 
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
	$temp['error'] = 'transaction failed'; 
	
}
 //traversing through all the result 

 
 //displaying the result in json format 
 echo json_encode($temp);
 
 
 