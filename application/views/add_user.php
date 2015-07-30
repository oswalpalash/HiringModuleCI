<div class="container" style="margin-top:100px;">
  <h1>Add User</h1>
  <form name="AddCand" role="form" enctype="multipart/form-data" action="add_user/save" method="POST">
  <div class="form-group">
    <label for="Name">username:</label>
    <input id="username" name="username" type="text"/>
  </div>
  <div class="form-group">
    <label for="Name">email:</label>
    <input id="email" name="email" type="text"/>
  </div>
  <div class="form-group">
    <label for="Name">password:</label>
    <input id="password" name="password" type="password"/>
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
