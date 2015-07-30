<<?php ?>
<div class="container">
<h1>Enter Candidate Info</h1>
<form name="AddCand" role="form" enctype="multipart/form-data" action="add_candidate/upload" method="POST">
<div class="form-group">
  <label for="Name">Name of Candidate:</label>
  <input id="name" name="name" type="text"/>
</div>
<div class="form-group">
  <label for="Email">Email Address:</label>
  <input id="email" name="email" type="text"/>
</div>
<div class="form-group">
  <label for="comments">Comments:</label>
  <input type='textarea' name='comments' placeholder='Write comments' style='width:800;'></input>
</div>
<div class="form-group">
  <label for="resume">Upload Resume Here:</label>
  <input id="resume" name="resume" type="file" />
</div>
<div class="form-group">
  <label for="team">Team:</label>
  <select class="form-control" name="team" id="team" style="width:90px;">
        <?php foreach ($data as $row) {
      echo "<option value=";print_r($row['groupname']);echo ">";print_r($row['groupname']);echo "</option>";
    }
    ?>
  </select>
</div>
<div class="form-group">
  <input id="Button2" type="submit" value="Submit" />
<div>
</form>
</div>
