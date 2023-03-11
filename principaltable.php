    <!--PAGE CONTENT -->
 <div id="content">

            <div class="inner" style="min-height:700px;">
                <div class="row">
                 
                 </div>
                 <br>
                 <div class="row">
                 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                      <a href="<?=site_url('Welcome/add_principal_post')?>"
                    class="btn btn-primary">Add New+</a>
                        </div>
                  <?php 
                    if(!$this->session->flashdata('msg')==''){  ?>
                       <center>   
                            <div class="alert alert-success alert-dismissable">
                                <a href="" class="close" data-dismiss="alert" aria-label="close">x</a>
                                <h4>  <?php  echo $this->session->flashdata('msg'); ?></h4>
                            </div>
                        </center>
                <?php } ?>
            
                <?php 
                if(!$this->session->flashdata('error_msg')==''){  ?>
                    <center>   
                        <div class="alert alert-danger alert-dismissable">
                            <a href="" class="close" data-dismiss="alert" aria-label="close">x</a>
                            <h4>  <?php  echo $this->session->flashdata('error_msg'); ?></h4>
                        </div>
                    </center>
                <?php } ?>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead >
                                        <tr>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>GENDER</th>
                                            <th>DATE OF BIRTH</th>
                                            <th>HOBBIES</th>

                                            <th>QUALIFICATION</th>
                                            <th>JOINING DATE</th>
                                            <th>RESIGN DATE</th>
                                            <th>ADDRESS</th>
                                            <th>IMAGE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                            foreach ($principal_data as $value) 
                            {?>
                        <tr>

               <td><?php echo  $value['name'];?></td>
               <td><?php echo  $value['email'];?></td>
               <td>
               <?php
             if($value['gender']=="1")
                {
                echo "Male";
                }
                else
                 {
               echo  "Female";
                 }
              ?>
               </td>
               <td><?php echo  $value['dob']; ?></td>
                 <td><?php echo  $value['hobbies']; ?></td>
               <td><?php echo  $value['qualification'];?></td>
               <td><?php echo  $value['joindate']; ?></td>
               <td><?php echo  $value['resigndate']; ?></td>
               <td><?php echo  $value['address']; ?></td>

     <td><img src="<?php echo base_url().'upload/'.$value['pic']  ?>" height="60px" width="60px"></td>
              
            <td>
       <a href="<?=site_url('welcome/edit_principal/'.$value['id'])?>" 
         class="btn btn-primary">Edit</a>   
      <!--  <a href="<?php echo site_url().'/welcome/delete_principal/'.$value['id']; ?>" 
       onclick="return confirm('Do you really wants to delete')"  class="btn btn-danger">Delete</a> -->  
      <a href="<?=site_url('welcome/delete_principal/'.$value['id'])?>"  
       onclick="return confirm('Do you really wants to delete')"  class="btn btn-danger">Delete</a>
   </td>
                       </tr> 
 <?php } ?>
                                </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>

             </div>
       <!--END PAGE CONTENT -->

 </div>

     <!--END MAIN WRAPPER -->
