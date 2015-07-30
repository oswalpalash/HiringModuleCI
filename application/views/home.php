<div class="container" style="margin-top:100px;">
  <h1>Welcome <?php print_r($this->session->userdata('username'));?></h1>
  <h3>Role Wise Applicant Filtering</h3><hr>
  <?php //print_r($data);
  foreach ($data as $row) {
    echo'<a href="/index.php/all/'.$row['team'].'" class="btn btn-primary btn-lg">
      <span class="glyphicon glyphicon-info-sign"></span>'.$row['team'].'
    ';
    echo '<h4>'.$row['count(*)'].'</h4></a>  ';
  }
  ?>
</div>
