<?php require 'header.php';

?>


<!-- BEGIN: Content-->
<div class="app-content content">

  <div class="content-wrapper">
    <div class="content-body">

      <div class="row">

        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-warning text-white text-center"> <a href="javascript:window.history.back(-1);" style="float:left;color: white;" ><i class="fa fa-arrow-left"></i> Back</a>
 Change Password</div>
            <div class="card-body">
<form action="" method="POST" >
              <table width="100%">
                <tr>
                  <th><input type="password" name="old_pass" required class="form-control" placeholder="Old Password"></th>
                </tr>
                <tr>
                  <th><input type="password" name="pass" required class="form-control" placeholder="New Password"></th>
                </tr>
                <tr>
                  <th><input type="password" name="confirm_pass" required class="form-control" placeholder="Confirm Password"></th>
                </tr>

                <tr>
                  <th><input style="float:right;" type="submit" name="change_pass" value="Change Password" class="btn btn-warning"></th>
                </tr>
              </table>
          
</form>


<?php

if (isset($_POST['change_pass']))
{
   $qry2 = mysqli_query($db,);
   $data2 = mysqli_fetch_array($qry2);

   


}#end of if isset change pass

?>

            </div><!------- end of card body---------->
          </div><!------- end of card---------->
        </div><!------- end of col md 6---------->






      </div><!------- end of row---------->




<style type="text/css">
  table,tr,th,td
  {
    padding: 9px 9px 9px 9px;
  }
</style>









</div>
</div>
</div>


<?php require 'footer.php';?>