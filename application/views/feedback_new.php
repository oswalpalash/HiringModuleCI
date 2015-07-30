<div class="container" style="margin-top:100px;">
<script type="text/javascript">
function addFields(){
    var container = document.getElementById("container");

    var i = container.childElementCount/3;
    document.getElementById("q_count").value = i+1;
    var input = document.createElement("input");
    input.type = "text";
    input.name = "question"+(i);
    input.placeholder = "Question"
    var input2 = document.createElement("input");
    input2.type = "textarea";
    input2.name = "answer"+(i);
    input.style.width = 310;
    input.style.height = 75;
    input2.style.height = 75;
    input2.style.width = 600;
    input2.placeholder = "Answer";
    container.appendChild(input);
    container.appendChild(input2);
    container.appendChild(document.createElement("br"));

}
  </script>
  <form class="form-horizontal" role="form" method="post" action="../save_feedback_new">
    <div class='form-group'>
      <label>Select Interview</label>
      <input type="hidden" name="uid" value="<?php print_r($uid); ?>">
      <input type="hidden" name="q_count" id="q_count">
      <select class='form-control' name="interview">
        <?php
        date_default_timezone_set('Asia/Calcutta');
        foreach ($i_info as $i_infor) {
          if($this->session->userdata('username')==$i_infor['interviewer']){
          echo "<option value=".$i_infor['id'].">";
          print_r($i_infor['id']);
          echo ") By ";
          print_r($i_infor['interviewer']);
          echo " on ";
          print_r(date("m/d/y g:i A",($i_infor['timestamp'])));
          echo "</option>";
        }
        }
        ?>
      <select>
    </div>
  <?php
    echo"<div class='form-group'>";
  	echo "<h2>Round Feedback <small></small></h2>";
  	echo "</div>";
    echo "<div class='form-group'><label>Rate Candidate</label>";
    echo "<select class='form-control' name='rating'>
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    <option value='7'>7</option>
    <option value='8'>8</option>
    <option value='9'>9</option>
    <option value='10'>10</option>
    </select>";
    echo '<textarea name="comments" cols="135" rows="5" placeholder="Write Comments about interview"></textarea>';
    echo "</div>";

  ?>
  <div class="form-group" id="container">

  </div>
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
    <input type="button" value="Add Question" onclick="addFields();">
  </div>
    <div class="form-group">
      <input id="Button2" type="submit" name="submit" value="Submit" />
    </div>
  </form>
</div>
</div>
