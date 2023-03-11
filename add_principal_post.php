
<!--PAGE CONTENT -->
        <div id="content">
            <div class="inner" style=" min-height: 700px;">
              <br> <br>
                <div class="row">
                <div class="col-lg-12">
                     <div class="panel panel-default">
                     <div class="panel-body">
                            <div class="table-responsive">



    <form action="<?=site_url('welcome/save_principal')?>" 
    class="form-horizontal"  id="block-validate" enctype="multipart/form-data" method="POST" >

                <div class="form-group">
                        <label class="control-label col-lg-4">Name</label>
                        <div class="col-lg-4">
                         <input type="text"  name="name" class="form-control" required />
                        </div>
                </div>
                                         
                <div class="form-group">
                        <label class="control-label col-lg-4">Email</label>
                        <div class="col-lg-4">
                         <input type="email"  name="email" class="form-control" required />
                        </div>
                </div>                     

                 <div class="form-group">
                        <label class="control-label col-lg-4">Password</label>
                        <div class="col-lg-4">
                         <input type="password"  name="password" class="form-control" required />
                        </div>
                </div> 
                 
                  <div class="form-group">
                        <label class="control-label col-lg-4">Gender</label>
                        <div class="col-lg-4">
                               &nbsp;   &nbsp; &nbsp; &nbsp;
                       <input type="radio" name="gender" value="1" > Male 
                       &nbsp;   &nbsp; &nbsp; &nbsp;
                       <input type="radio" name="gender" value="0" > Female
                        </div>
                </div> 

                <div class="form-group">
                        <label class="control-label col-lg-4">Date of Birth</label>
                        <div class="col-lg-4">
                         <input type="date"  name="dob" class="form-control" required />
                        </div>
                </div> 


                 <div class="form-group">
                        <label class="control-label col-lg-4">Select hobbies</label>
                        <div class="col-lg-4">
                             
                    <input type="checkbox" name="hobbies[]" value="Cricket"> Cricket
                       &nbsp;    
                    <input type="checkbox" name="hobbies[]" value="Volleyball"> Volleball
                     &nbsp;    
                    <input type="checkbox" name="hobbies[]" value="Swimming"> Swimming
                     &nbsp;    
                    <input type="checkbox" name="hobbies[]" value="Others"> Others
                        </div>
                </div> 

                <div class="form-group">
                        <label class="control-label col-lg-4">Qualification</label>
                        <div class="col-lg-4">
                         <input type="text"  name="qualification" class="form-control" required />
                        </div>
                </div> 

                 <div class="form-group">
                        <label class="control-label col-lg-4">Joining date</label>
                        <div class="col-lg-4">
                         <input type="date"  name="joindate" class="form-control" required />
                        </div>
                </div> 

                 <div class="form-group">
                        <label class="control-label col-lg-4">Resign date</label>
                        <div class="col-lg-4">
                         <input type="date"  name="resigndate" class="form-control" />
                        </div>
                </div> 

                  <div class="form-group">
                        <label class="control-label col-lg-4">Address</label>
                        <div class="col-lg-4">
                         <input type="text"  name="address" class="form-control" required />
                        </div>
                </div>


                <div class="form-group">
                        <label class="control-label col-lg-4">Select Image</label>
                        <div class="col-lg-4">
                         <input type="file"  name="files" class="form-control" required />
                        </div>
                 </div>
                

                <div class="form-actions" style="text-align:center;">
                <input type="submit" value="SUBMIT" class="btn btn-primary btn-md "/>
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

  