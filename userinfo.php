 <?php
include 'db.php';
$id=$_GET['accountnumber'];
 $stmt = $conn->prepare("SELECT accountnumber,firstname,middlename,lastname,savingsbalance,currentbalance,lasttransaction,profilephotourl,fingerprinturl FROM info WHERE accountnumber=$id");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($accountnumber,$firstname,$middlename,$lastname,$savingsbalance,$currentbalance,$lasttransaction,$profilephotourl,$fingerprinturl);
 
if($stmt->fetch())
{
	 
$temp['success'] = 1; 
 $temp['accountnumber'] = $accountnumber; 
  $temp['firstname'] = $firstname; 
   $temp['middlename'] = $middlename; 
    $temp['lastname'] = $lastname; 
	 $temp['savingsbalance'] = $savingsbalance; 
	  $temp['currentbalance'] = $currentbalance; 
	   $temp['lasttransaction'] = $lasttransaction; 
	    $temp['profilephotourl'] = $profilephotourl; 
		 $temp['fingerprinturl'] = $fingerprinturl; 

}
else
{
	$temp['success'] = 0; 
	$temp['error'] = 'account id error'; 
	
}
 //traversing through all the result 

 
 //displaying the result in json format 
 echo json_encode($temp);
 
 
 