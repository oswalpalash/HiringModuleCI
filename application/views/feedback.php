<div class="container" style="margin-top:100px;">
<script type="text/javascript">

  </script>
  <form class="form-horizontal" role="form" method="post" action="../save_feedback">
    <div class='form-group'>
      <label>Select Interview</label>
      <input type="hidden" name="uid" value="<?php print_r($uid); ?>">
      <input type="hidden" name="q_ids" value="<?php
      foreach ($data as $row)
      {

        print $row['id'];
        echo ",";
      }
       ?>">
      <select class='form-control' name="interview">
        <?php
        date_default_timezone_set('Asia/Calcutta');
        foreach ($i_info as $i_infor) {
          echo "<option value=".$i_infor['id'].">";
          print_r($i_infor['id']);
          echo ") By ";
          print_r($i_infor['interviewer']);
          echo " on ";
          print_r(date("m/d/y g:i A",($i_infor['timestamp'])));
          echo "</option>";
        }
        ?>
      <select>
    </div>
  <?php foreach ($data as $question) {
    echo"<div class='form-group'>";
  	echo "<h2>";print_r($question['QuestionText']);echo"<small></small></h2>";
  	echo "</div>";
    echo "<div class='form-group'><label>Rate</label>";
    echo "<select class='form-control' name='rating";print_r($question['id']);
    echo "'>
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    </select>";
    echo "<input type='textarea' name='comment";print_r($question['id']);
    echo "' placeholder='Write comments' style='width:970;'></input>";
    echo "</div>";
  }
  ?>
  <div class="form-group">
    <label>
      <input type="checkbox" name="decision"> Interview Decision
    </label>
  </div>
  <div class="form-group">
      <label>
        <input type="checkbox" name="another_round"> Need another Round
      </label>
    </div>

  <div class="form-group">
    <input id="Button2" type="submit" name="submit" value="Submit" />
  <div>
  </form>
</div>
