<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Super|Humans</title>
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
  </head>
    <body>
      <div class="header-container">
          <header class="wrapper clearfix">
            <a  href='/index.html'><img class='logo-head' rel='image/png' src='img/logo-sh.png'></a>
          </header>
      </div>
      <div class="header-month">
        <h1>Employee Schedule</h1>
      </div>
      <div class="main-container">
          <div class="main wrapper clearfix">
            <?php
              require('shiftplanning.php');
              $shiftplanning = new shiftplanning(
                array(
                  'key' => 'fe8905e6250630dafaa2375cc44fef5b21c2b21c' // enter your developer key
                )
              );

        //    $session = $shiftplanning->getSession();
              //print_r($session);

              if( !$session ){
                $response = $shiftplanning->doLogin(
                  array(
                    'username' => 'veljamirkovic@gmail.com',
                    'password' => 'Humanitarnost134',
                  )
                );
              //print_r($response);

              if( $response['status']['code'] == 1 ){
                $session = $shiftplanning->getSession();    // return the session data after successful login
                //        echo $session['employee']['name']. ", you are logged in!", "\r\n";
                 $loggedin = 1;
              }

              else{
              //        echo $response['status']['text'] . "--" . $response['status']['error'];
                $loggedin = 0;
              }
              }

              //print_r($shiftplanning->getShifts());

              $start_date = date("Y-m-d",strtotime("today"));
              $end_date =  date("Y-m-d",strtotime("today"));
              $emp_shift = $shiftplanning->setRequest(
                array_merge(
                  array(
                    'module' => 'schedule.shifts',
                    'method' => 'GET',
                    'mode' => 'overview',
                  ),
                  array(
                    'start_date' => $start_date,
                    'end_date' => $end_date
                  )
                )
              );
              //print_r($emp_shift);

              //Print table to html
                  echo "<table>";
              echo "<tr><th>Employee</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr>";
              foreach($emp_shift['data'] as $shift){
                foreach($shift['employees'] as $employee){
                  //get and display data for each employee
              echo "<tr><td class='table-shifts'>".$employee["name"]."</td><td class='table-shifts'>". $shift["start_time"]["time"] ."-". $shift["end_time"]["time"] ."</br>Position: ".$shift["schedule_name"]." </td><td class='table-shifts'></td><td class='table-shifts'></td><td class='table-shifts'></td><td class='table-shifts'></td><td class='table-shifts'></td><td class='table-shifts'></td></tr>";
        //          echo "<tr><td class='table-shifts'>Position: ".$shift["schedule_name"]." ". $shift["start_time"]["time"] ."-". $shift["end_time"]["time"] ."</td></tr>";
        //          echo "<tr></tr>";
                }
              }
              echo "</table>";
            ?>
          </div> <!-- #main -->
      </div> <!-- #main-container -->

      <div class="footer-container">
          <footer class="wrapper">
              <a class="fa fa-github social" href="https://github.com/vmirkovic"></a>
          </footer>
      </div>
  </body>
</html>
