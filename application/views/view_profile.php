<div class="container" style="margin-top:100px;">
<h1>Candidate Profile</h1>
  <label for="Name">Name of Candidate:</label> <?php print_r($data[0]['name']); ?><br>
  <label for="resume">Resume: <a href=file:///<?php print_r($data[0]['resume']); ?>>File</a></label><br>
  <label for="team">Team:</label>  <?php print_r($data[0]['team']); ?> <br>
  <label for="team">Email:</label>  <?php print_r($data[0]['email']); ?> <br>
  <label for="team">Previously Rejected:</label>  <?php if($data[0]['prev_reject'])
  {
    echo "Yes";
  }
  else{
    echo "No";
  }; ?> <br>
  <label for="team">Comments:</label>  <?php print_r($data[0]['comments']); ?> <hr>
   <div class='row'>
      <div class='col-md8'>
          <a href='schedule/<?php print_r($data[0]['id']);?>/<?php print_r($data[0]['team']); ?>'><span class='glyphicon glyphicon-pencil'>New Interview Round</span></a>
          <hr>
          <a href='report/<?php print_r($data[0]['id']); ?>'><span class='glyphicon glyphicon-new-window'>View Report</span></a>
          <hr>
          <a href='feedback/<?php print_r($data[0]['id']); ?>'><span class='glyphicon glyphicon-star'>Enter Feedback</span></a>
          <hr>
          <a href='reject/<?php print_r($data[0]['id']); ?>'><span class='glyphicon glyphicon-remove'>Send Rejection Email</span></a>
          <hr>
          <label for="prev">Previous Interview Information:</label><br>
          <?php
          if ($interviews){
            foreach ($interviews as $interview) {
              date_default_timezone_set('Asia/Calcutta');
              print_r($interview['id']);echo ")   ";
              print_r(date("m/d/y g:i A", $interview['timestamp']));

              if($interview['decision']){
                echo "\tDecision :";
                echo "Selected";
              }
              else{
                if($interview['another_round']){
                  echo "\tStatus : Waitlisted for Next Round";
                }
                else{
                  echo "\tPending Decision";
                }
              }
              echo"<hr>";
            }
        }
      else{
        echo "None";
      }
           ?>
      </div>
   </div>
<!-- <div> -->
