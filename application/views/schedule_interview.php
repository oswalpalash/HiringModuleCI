<?php  ?>
<link rel="stylesheet" href="http://cdn.kendostatic.com/2015.2.624/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.2.624/styles/kendo.material.min.css" />

    <script src="http://cdn.kendostatic.com/2015.2.624/js/jquery.min.js"></script>
    <script src="http://cdn.kendostatic.com/2015.2.624/js/kendo.all.min.js"></script>
<br>

<div class="container">
   <div class='row'>
       <div class='col-md-4'></div>
       <div class='col-md-4'>
         <div class='col-md-12 form-group'>
 <div class="form-row"><h1>Interview</h1>
 </div>
   </div>

         <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
         <form accept-charset="UTF-8" action="done" class="require-validation" id="interview" method="post">
           <br>
         <div class='form-row'>
             <div class='col-xs-12 form-group required'>
               <label class='control-label'>Time Of Interview</label>
               <input id="datetimepicker" name="datetimepicker" style="width: 100%;" class='form-control' >
               <script>
                $(document).ready(function () {
                    // create DateTimePicker from input HTML element
                    $("#datetimepicker").kendoDateTimePicker({
                        value:new Date()
                    });
                });
            </script>
             </div>
           </div>
           <div class='form-row'>
             <div class='col-xs-12 form-group card required'>
                 <label class='control-label'>Interviewer for applied Team:</label>
                 <select class="form-control" name="username" id="username" style="width:90px;">
                       <?php foreach ($data as $row) {
                     echo "<option value=";print_r($row['username']);echo ">";print_r($row['username']);echo "</option>";
                   }
                   ?>
                 </select>
             </div>
           </div>
               <button class='form-control btn btn-primary submit-button' name="submit" type='submit' value="submit"> Schedule »</button>
             </div>
           </div>

         </form>
       </div>
      </div>
   </div>
</div>
</div>
<br>
