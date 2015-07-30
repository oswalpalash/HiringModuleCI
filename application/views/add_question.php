<div class="container" style="margin-top:100px;">
  <h1>Add a Question</h1>
  <form name="AddCand" role="form" enctype="multipart/form-data" action="save" method="POST">
  <div class="form-group">
    <label for="Name">Question Text:</label>
    <input id="ques" name="ques" type="text"/>
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
    <input id="Button2" name="submit" type="submit" value="Submit" />
  <div>
  </form>
</div>
