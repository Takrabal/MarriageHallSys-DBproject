<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="Dashboard.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/07571c48a4.js" crossorigin="anonymous"></script>
    <title>Login</title>
  </head>
  <body>
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-sm-3 col-5 px-1 bg-dark position-fixed" style="height: 100% !important;background-color:white !important;">
            <div class="nav flex-column flex-nowrap" >
                    <div id="Admin-name">
                        <img src="../marriagehall_MS/images/AdminPic.svg" width="60px" height="60px" style="border-radius:50%;margin-top:30px;">
                        <p style="margin-top:60px;margin-left: 5px;">Admin</p>
                    </div>
                    <br>
                    <a href="#" class="nav-link active"  id="Dash-a"><i class="fa-solid fa-gauge"></i>  Dashboard</a><br><br>
                    <a href="AddEvent.php" class="nav-link"  id="Dash-a"><i class="bi bi-plus-circle"></i>  Add Event</a><br>
                    <a href="ViewEvent.php" class="nav-link"  id="Dash-a"><i class="bi bi-eye"></i> View Event Deatils</a><br>
                    
                    <br>
            </div>
        </div>
        <div class="col-10 offset-md-2 offset-sm-3 offset-6" >
            <div class="row">
                <div class="col-12" id="heading">
                    <h3>Dashboard</h3>
                </div>

                <div class="col-12" id="Total_events">
                  <!-- php code for total events from event table -->
                     <?php
                        include "dbcon.php";

                        try {
                          $sql=$conn->prepare("SELECT count(eventid) from eventTable");
                          $sql->execute();
                          $count=$sql->fetchColumn();
                          
                         echo <<<HTML
                         <div>
                          <h3> $count </h3>
                          <div>Total Events</div>
                         </div>
                         <!-- <div> -->
                         HTML;

                      //<h3> $count </h3>
                      //<p>Total Events</p>

                      } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                      }  

                   ?>
                    
                </div>

                <div class="col-12" id="Total_events">
                  <!-- php code for status = booked -->
                <?php
                        include "dbcon.php";
                        $status="booked";
                        try {
                          $sql=$conn->prepare("SELECT count(eventid) from eventTable where status = ?");
                          $sql->bindParam(1,  $status, PDO::PARAM_STR);
                          $sql->execute();
                          $count=$sql->fetchColumn();
                          
                         
                    
                          echo <<<HTML
                         <div>
                          <h3> $count </h3>
                          <div>Booked events</div>
                         </div>
                         <!-- <div> -->
                         HTML;

                         //<!-- <h3>10</h3>
                         //<p>Booked</p> -->

                      } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                      }  
                   ?>
                </div>

                
                <div class="col-12" id="Total_events">
                  <!-- php code for status = pending -->
                <?php
                        include "dbcon.php";
                        $status="pending ";
                        try {
                          $sql=$conn->prepare("SELECT count(eventid) from eventTable where status = ?");
                          $sql->bindParam(1,  $status, PDO::PARAM_STR);
                          $sql->execute();
                          $count=$sql->fetchColumn();
                          
                         
                    
                        echo <<<HTML
                         <div>
                          <h3> $count </h3>
                          <div>Pending Events</div>
                         </div>
                         <!-- <div> -->
                         HTML;

                      //<h3> $count </h3>
                      //<p>pending</p>

                      } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                      }  

                   ?>
                </div>
                
                <div class="col-12" >
                    <h3 id="Up-h3">Upcoming Events</h3>  
                    <br>
                    
                    
        <table class="table table-striped">
           <!-- php code for upcoming events -->
           <?php
              include "dbcon.php";
             try
             {  
                $query = $conn->prepare('select customer.custid, custname, custmobile, eventtype, eventdate, eventstarttime, attendees from eventTable join customer on eventTable.custid=customer.custid where eventdate >= CURRENT_DATE order by 
                eventdate asc');
                //$query->bindParam();
                $query->execute();
                $result   = $query->fetchAll(PDO::FETCH_OBJ);

                   // echo "<pre>";
                  // print_r($result);
                   // die;
              }
              catch(PDOException $e) 
              {
                echo "Connection failed: " . $e->getMessage();
              } 
           ?>
            <thead>
                <tr class="thead-dark">
                <th  scope="col">#</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Mobile</th>
                <th scope="col">Event Type</th>
                <th scope="col">Event Date</th>
                <th scope="col">Event Start Time</th>
                <th scope="col">Attendees</th>
                </tr>
            </thead>

            <tbody>
                <?php
            
                    foreach ($result as $value)
                    {
                      echo <<< HTML
                      <tr>
                      <td>$value->custid</td>
                      <td>$value->custname</td>
                      <td>$value->custmobile </td>
                      <td>$value->eventtype</td>
                      <td>$value->eventdate</td>
                      <td>$value->eventstarttime</td>
                      <td>$value->attendees</td>
                     </tr>
                     HTML;
              
                    }
                  ?>     
                
                <!-- //<tr>
                //     <td>3</td>
                //     <td>104</td>
                //     <td>Larry</td>
                //     <td>LRM-1768</td>
                //     <td>Car</td>
                //     <td>400</td>
                // </tr> --> 
                
            </tbody>
        </table>
        </div> 
      
            </div>
        </div>
    </div>
</div>


<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
function myFunction1() {
  document.getElementById("myDropdown1").classList.toggle("show");
}
function myFunction2() {
  document.getElementById("myDropdown2").classList.toggle("show");
}


// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>