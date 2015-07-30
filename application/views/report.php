<div class="container" style="margin-top:100px;">
  <h1>Interview Report For <?php print_r($cname);?></h1>
      <?php
      date_default_timezone_set('Asia/Calcutta');
      foreach ($data as $intw_id) {
        $this->load->model('report_model');
        $fb = $this->report_model->show_feedbk($intw_id['id'])[0];
        echo "<h3>Interview ID #".$intw_id['id']." by ".$intw_id['interviewer'].
        " on " .date("m/d/y g:i A",$intw_id['timestamp']) ."</h3>";
        echo "Interview Comments : ".$fb['CommentText']."<br>";
        echo "Interview Rating : ".$fb['rating']."/10<br>";
        echo "Interview Decision : ";
        if($intw_id['decision']){
          echo "Selected";
        }
        else{
          if($intw_id['another_round']){
            echo "Waitlisted For another Round";
          }
          else{
            echo "Pending Decision";
          }
        }
        echo"<br>";
        $qa = $this->report_model->show_qa($intw_id['id']);
        // var_dump($qa);
        if($qa!=''){
          foreach ($qa as $question) {
            echo "<br>Question: ".$question['QuestionText']."<br>";
            echo "Answer: ".$question['QuestionText']."<br>";
          }
        }
        echo "<hr>";
        // die();
        // echo "<td>";print_r(date("m/d/y g:i A",));echo "</td>";
        // echo "<td>";print_r($intw_rep->interviewer);echo "</td>";
        // echo "<td>";print_r($intw_rep->QuestionText);echo "</td>";
        // echo "<td>";print_r($intw_rep->AnswerText);echo "</td>";
        // echo "<td>";print_r($intw_rep->CommentText);echo "</td>";
      }
      ?>

</div>
