<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Super|Humans</title>
  </head>
  <body>
    <?php
      require('shiftplanning.php');
      $shiftplanning = new shiftplanning(
        array(
          'key' => 'fe8905e6250630dafaa2375cc44fef5b21c2b21c' // enter your developer key
        )
      );

      $session = $shiftplanning->getSession();
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
            'mode' => 'overview'
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
      foreach($emp_shift['data'] as $shift){
        foreach($shift['employees'] as $employee){
          //get and display data for each employee
          echo "<tr><td>".$employee["name"]."</td></tr>";
          echo "<tr><td>Possition: ".$shift["schedule_name"]." ". $shift["end_time"]["time"] ."</td></tr>";
        }
      }
      echo "</table>";
    ?>
  </body>
</html>
