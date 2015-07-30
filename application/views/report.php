<div class="container" style="margin-top:100px;">
  <h1> Report For <?php print_r($cname);?></h1>
  <table class="table">
    <thead>
      <td>Interview ID</td>
      <td>Interview Time</td>
      <td>Interviewer</td>
      <td>Question Text</td>
      <td>Rating</td>
      <td>Comments</td>
    </thead>
    <tbody>

      <?php
      date_default_timezone_set('Asia/Calcutta');
      foreach ($data as $intw_rep) {
        echo "<tr>";
        echo "<td>";print_r($intw_rep->intw_id);echo "</td>";
        echo "<td>";print_r(date("m/d/y g:i A",$intw_rep->timestamp));echo "</td>";
        echo "<td>";print_r($intw_rep->interviewer);echo "</td>";
        echo "<td>";print_r($intw_rep->QuestionText);echo "</td>";
        echo "<td>";print_r($intw_rep->rating);echo "</td>";
        echo "<td>";print_r($intw_rep->CommentText);echo "</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>

</div>
