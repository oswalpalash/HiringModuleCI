
<!--load jQuery library-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--load bootstrap.js-->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<div class="container" style="margin-top:100px;">
  <h1>List of Candidates</h1>
  <!-- <?php print_r($data); ?> -->

<table class="table">
    <thead>
        <tr>
            <th>Email ID</th>
            <th>Candidate Name</th>
            <th>Team</th>
            <th>Status</th>
            <th>Interviewer</th>
        </tr>
    </thead>
    <tbody>
        <!-- <tr>
            <td>1</td>
            <td>John</td>
            <td>TECH</a></td>
            <td>NEXT INTERVIEW</td>
            <td>ABCD</td>
        </tr> -->
        <?php
        foreach ($data as $row){
          echo "<tr>";
        //  echo "<td>";print_r($row->{'cand_id'});echo "</td>";
          echo "<td><a href='/index.php/candidate/";print_r($row->id);echo"'>";print_r($row->email);echo "</a></td>";
          echo "<td><a href='/index.php/candidate/";print_r($row->id);echo"'>";print_r($row->name);echo "</a></td>";
          echo "<td><a href='/index.php/all/".$row->team."'>";print_r($row->team);echo "</td>";
          if($row->decision == '1')
          {
            echo "<td>HIRED</td>";
          }
          else{
            if($row->another_round == '1')
            {
              echo "<td>NEXT INTERVIEW</td>";
            }
            else
            {
              echo "<td>UNSCREENED</td>";
            }
          }
          echo "<td>";print_r($row->interviewer);echo "</td>";
          echo "</tr>";
        }
           ?>
    </tbody>
</table>
</div>
