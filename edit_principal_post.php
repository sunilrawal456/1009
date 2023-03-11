
<!--PAGE CONTENT -->
        <div id="content">
            <div class="inner" style=" min-height: 700px;">
              <br> <br>
                <div class="row">
                <div class="col-lg-12">
                     <div class="panel panel-default">
                     <div class="panel-body">
                            <div class="table-responsive">
                                  <?php 
                  foreach ($edit_principal_data as $value) {
                      $id=$value['id'];

                    }
                    
                    ?>
 <form action="<?=site_url('Welcome/update_principal/'.$value['id'])?>" 
    class="form-horizontal"  id="block-validate" enctype="multipart/form-data"   method="POST">

                <div class="form-group">
                        <label class="control-label col-lg-4">Name</label>
                        <div class="col-lg-4">
                         <input type="text"  name="name" value="<?php echo $value['name']?>"
                         class="form-control" required />
                        </div>
                </div>
                                         
                <div class="form-group">
                        <label class="control-label col-lg-4">Email</label>
                        <div class="col-lg-4">
                         <input type="email"  name="email" value="<?php echo $value['email']?>"class="form-control" required />
                        </div>
                </div>                     

                 <div class="form-group">
                        <label class="control-label col-lg-4">Password</label>
                        <div class="col-lg-4">
                    <input type="password"  name="password" value="<?php echo $value['password']?>"class="form-control" required />
                        </div>
                </div> 
                 
                  <div class="form-group">
                        <label class="control-label col-lg-4">Gender</label>
                        <div class="col-lg-4">
                              &nbsp;   &nbsp; &nbsp; &nbsp;
                       <input type="radio" name="gender" value="1" 
                       <?php if($value['gender']=="1"){ echo "checked";}?>> Male 
                       &nbsp;   &nbsp; &nbsp; &nbsp;
                       <input type="radio" name="gender" value="0" 
                       <?php if($value['gender']=="0"){ echo "checked";}?>> Female
                        </div>
                </div> 

                <div class="form-group">
                        <label class="control-label col-lg-4">Date of Birth</label>
                        <div class="col-lg-4">
                         <input type="date"  name="dob"  value="<?php echo $value['dob']?>"class="form-control" required />
                        </div>
                </div> 


<?php

 $b=explode(",",$value["hobbies"]);
 // echo "<pre>";
 // print_r($b);
?>


                <div class="form-group">
                        <label class="control-label col-lg-4">Select hobbies</label>
                        <div class="col-lg-4">
                                  
                                 
                   <input type="checkbox" name="hobbies[]" value="Cricket"
                                 <?php
                                     if(in_array("Cricket",$b))
                                     {
                                         echo "checked";
                                     }
                                     ?>
                                    >Cricket
                       &nbsp;   
                    <input type="checkbox" name="hobbies[]" value="Volleyball"
                                 <?php
                                     if(in_array("Volleyball",$b))
                                     {
                                         echo "checked";
                                     }
                                     ?>
                                    >Volleyball
                     &nbsp;
                     <input type="checkbox" name="hobbies[]" value="Swimming"
                               <?php
                                     if(in_array("Swimming",$b))
                                     {
                                         echo "checked";
                                     }
                                     ?>
                                    >Swimming


                       &nbsp;
                     <input type="checkbox" name="hobbies[]" value="Others"
                                 <?php
                                     if(in_array("Others",$b))
                                     {
                                         echo "checked";
                                     }
                                     ?>
                                    >Others


                        </div>
                </div>

                  


                <div class="form-group">
                        <label class="control-label col-lg-4">Qualification</label>
                        <div class="col-lg-4">
            <input type="text"  name="qualification"  value="<?php echo $value['qualification']?>"class="form-control" required />
                        </div>
                </div> 

                 <div class="form-group">
                        <label class="control-label col-lg-4">Joining date</label>
                        <div class="col-lg-4">
                        <input type="date"  name="joindate"  value="<?php echo $value['joindate']?>"class="form-control" required />
                        </div>
                </div> 

                 <div class="form-group">
                        <label class="control-label col-lg-4">Resign date</label>
                        <div class="col-lg-4">
                    <input type="date"  name="resigndate"  value="<?php echo $value['resigndate']?>"class="form-control" />
                        </div>
                </div> 

                  <div class="form-group">
                        <label class="control-label col-lg-4">Address</label>
                        <div class="col-lg-4">
                        <input type="text"  name="address"  value="<?php echo $value['address']?>"class="form-control" required />
                        </div>
                </div>

                <div class="form-group">
                        <label class="control-label col-lg-4">Select Image</label>
                        <div class="col-lg-4">
                         <input type="file"  name="files" class="form-control" required />
                <img src="<?php echo base_url().'upload/'.$value['pic']  ?>" height="60px" width="60px">  <input type="hidden" name="old_doc" value="<?php echo $value['pic'] ?>">
                        </div>
                 </div>


                <div class="form-actions" style="text-align:center;">
                <input type="submit" value="UPDATE" class="btn btn-primary btn-md "/>
                </div>
                 
                    </form>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
         
             </div>
        </div>
       <!--END PAGE CONTENT -->

 </div>

     <!--END MAIN WRAPPER -->

  