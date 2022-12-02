<?php 
 include "dbcon.php";

 try {
     if(isset($_POST['submit']))
     {
         $cust_id=$_POST['EventId'];
         $event_type=$_POST['EventType'];
         $event_date=$_POST['EventDate'];
         $event_start_time=$_POST['EventTime'];
         $event_attendees=$_POST['Attendees'];
         echo $cust_id;


         $update=$conn->prepare("update eventTable set eventtype = ?, eventdate=?, eventstarttime=?,
         attendees=? where eventTable.custid=?");

         $update->execute([$event_type,$event_date,$event_start_time,$event_attendees,$cust_id]);
        header("location:ViewEvent.php");
     }
 } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
 


?>