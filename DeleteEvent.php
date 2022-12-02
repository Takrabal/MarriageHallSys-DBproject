<?php 
 include "dbcon.php";

 try {
         $cust_id=$_GET['custid'];
         $delete=$conn->prepare("Delete from eventTable where custid = ? ");
         $delete->execute([$cust_id]);
         
         $deleteCus=$conn->prepare("Delete from customer where custid = ?");
         $deleteCus->execute([$cust_id]);


        header("location:ViewEvent.php");
 } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
 


?>