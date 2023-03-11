
<?php   
$CI=& get_instance();
$CI->load->library('session');
$session_data=$CI->session->userdata('user');
//print_r($session_data);
//echo "fff";
//exit();
?>



 <!-- MENU SECTION -->
       <div id="left">
            <div class="media user-media well-small">
                <a class="user-link" href="#">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" 
                    src="<?php echo base_url(); ?>assets/img/user.gif" />
                </a>
                <br />
                <div class="media-body">
                    <h5 class="media-heading"> Joe Romlin</h5>
                    <ul class="list-unstyled user-info">
                        
                        <li>
                             <a class="btn btn-danger btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online
                           
                        </li>
                       
                    </ul>
                </div>
                <br />
            </div>

            <ul id="menu" class="collapse">

             
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-pencil"> </i>Principal   
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       &nbsp; 
                    </a>
                    <ul class="collapse" id="component-nav">
                       
                        <li class=""><a  href="<?php echo site_url()?>/welcome/add_principal_post">
                            <i class="icon-angle-right"></i>Add</a></li>
                        <li class=""><a href="<?php echo site_url()?>/welcome/principaltable">
                            <i class="icon-angle-right"></i>List</a></li>
                     
                    </ul>
                </li>

                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
                        <i class="icon-pencil"></i> Teacher
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; 
                    </a>
                    <ul class="collapse" id="form-nav">
                        <li class=""><a  href="<?php echo site_url()?>/welcome/add_teacher_post">
                            <i class="icon-angle-right"></i> Add </a></li>
                        <li class=""><a href="<?php echo site_url()?>/welcome/teachertable">
                            <i class="icon-angle-right"></i> List </a></li>
                      
                    </ul>
                </li>

              </ul>

        </div>
        <!--END MENU SECTION -->