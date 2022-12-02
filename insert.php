<?php
   include "dbcon.php";
   try 
   {
       if(isset($_POST['submit']))
        { 

            


            // if (empty($_POST['CustID']) || empty($_POST['CustName']) || empty($_POST['CustMobile']) ||
            // empty($_POST['CustEmail']) || empty($_POST['EventID']) || empty($_POST['EventType']) || 
            // empty($_POST['EventDate']) || empty($_POST['EventTime']) || empty($_POST['Attendees'])) 
            // {
            //     echo <<<HTML
            //      <label> All fields are required </label>
            //      HTML;
            // } 

        //    else
        //      {        
                
                $custid = $_POST['CustId'];
                $custname = $_POST['CustName'];
                $custmobile = $_POST['CustMobile'];
                $custemail = $_POST['CustEmail'];
                $insert=$conn->prepare("insert into customer(custid, custname, custmobile, custemail) values 
                 (?, ?, ?, ?);");
                $insert->execute([$custid,$custname,$custmobile,$custemail]);

              $eventid = $_POST['EventId'];
              $eventtype = $_POST['EventType'];
              $eventdate =($_POST['EventDate']);
              $eventtime = $_POST['EventTime'];
              $status = $_POST['Status'];
              $eventattendees = $_POST['Attendees'];

              $insert2=$conn->prepare("insert into eventTable(eventid,custid, eventtype, eventdate, eventstarttime, status, attendees) values 
                 (?, ?, ?, ?, ?, ?,?);");
              $insert2->execute([$eventid,$custid,$eventtype,$eventdate,$eventtime, $status, $eventattendees]);

            //   }

            header("location:ViewEvent.php");
        }
    }  
  
    catch (PDOException $e) 
    { 
         echo "Connection failed: " . $e->getMessage();
    }


?>
