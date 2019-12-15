 <?php
include 'db.php';
$accountnumber=$_GET['accountnumber'];

$amount=$_GET['amount'];


 $stmt = $conn->prepare("SELECT accounttype FROM currentlyactive WHERE atmnumber=1 ");
 $stmt->execute();
 $stmt->bind_result($accounttype);
 
 if($stmt->fetch())
 {
     $accounttype=$accounttype;
 }
 $stmt->close();
 
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
 
 
 