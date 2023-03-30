<?php

$CI = & get_instance();

$CI->load->library('session');  

$session_data = $CI->session->userdata('inuser');
$id = $session_data['id'];
$res=$this->users_model->get_run("Select * from inuser WHERE id = $id");
$pic=base_url()."assets/profile_pic/".$res[0]['profile_pic']; 
// print_r($session_data);
// print_r($res);
// echo "fff";
// exit;
?>







        <!-- MENU SECTION -->

       <div id="left" >

            <div class="media user-media well-small">

                <a class="user-link" href="#">

                    <img class="media-object img-thumbnail user-img" alt="User Picture" height="150" width="150" src="<?php print ($res[0]['profile_pic']!=='') ? $pic : base_url()."assets/img/default.png"; ?>" />
                    

                </a>

                <br />

                <div class="media-body">

                    <h5 class="media-heading"><?="Hello! ".$res[0]['name']?></h5>

                    <ul class="list-unstyled user-info">

                        
<!-- 
                        <li>

                             <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online

                           

                        </li> -->

                       

                    </ul>

                </div>

                <br />

            </div>



            <ul id="menu" class="collapse">

                <li class="panel">
                    <a href="<?php echo site_url();?>/welcome/dashboard" >
                <i class="icon-dashboard"></i> Dashboard
               </a>                   
                 </li>

       <!--  <li><a href="gallery.html"><i class="icon-film"></i> Image Gallery </a></li> -->

                <?php if($session_data['type']==1){ ?>

                <!--<li ><a href="<?php //echo site_url();?>/welcome/table_show">-->

                <!--    <i class=""></i>Admin List </a></li>-->
                
                 <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav1">
                        <i class="icon-pencil"></i> Admin
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; 
                    </a>
                    <ul class="collapse" id="form-nav1">
                        <li class=""><a href="<?php echo site_url();?>/welcome/add"><i class="icon-angle-right"></i> Add </a></li>
                        <li class=""><a href="<?php echo site_url();?>/welcome/table_show"><i class="icon-angle-right"></i> List </a></li>
                        
                    </ul>
                </li>


                
    <? } 

               
      if($session_data['type']==1  ||$session_data['type']==2){ ?>
            
            <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav2">
                        <i class="icon-pencil"></i> Reseller
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; 
                    </a>
                    <ul class="collapse" id="form-nav2">
                        <li class=""><a href="<?php echo site_url();?>/welcome/addreseller"><i class="icon-angle-right"></i> Add </a></li>
                        <li class=""><a href="<?php echo site_url();?>/welcome/table_reseller"><i class="icon-angle-right"></i> List </a></li>
                        
                    </ul>
                </li>
                
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav3">
                        <i class="icon-pencil"></i> Item
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; 
                    </a>
                    <ul class="collapse" id="form-nav3">
                        <li class=""><a href="<?php echo site_url();?>/welcome/addproduct"><i class="icon-angle-right"></i> Add </a></li>
                        <li class=""><a href="<?php echo site_url();?>/welcome/table_product"><i class="icon-angle-right"></i> List </a></li>
                        
                    </ul>
                </li>


                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav4">
                        <i class="icon-pencil"></i> Payment
       
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; 
                    </a>
                    <ul class="collapse" id="form-nav4">
                        <li class=""><a href="<?php echo site_url();?>/welcome/addpayment"><i class="icon-angle-right"></i> Add </a></li>
                        <li class=""><a href="<?php echo site_url();?>/welcome/payment_show"><i class="icon-angle-right"></i> List </a></li>
                        
                    </ul>
                </li>

                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav5">
                        <i class="icon-pencil"></i> Order
       
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; 
                    </a>
                    <ul class="collapse" id="form-nav5">
                        <li class=""><a href="<?php echo site_url();?>/welcomeNew/addmorepayment"><i class="icon-angle-right"></i> Add </a></li>
                         <li class=""><a href="<?php echo site_url();?>/welcome/orderlist"><i class="icon-angle-right"></i> List </a></li> 
                        
                    </ul>
                </li>
                    <? } 

            if($session_data['type']==3){ ?>

                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav4">
                        <i class="icon-pencil"></i> Payment
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; 
                    </a>
                    <ul class="collapse" id="form-nav4">
                      <!--   <li class=""><a href="<?php echo site_url();?>/welcome/addpayment"><i class="icon-angle-right"></i> Add </a></li> -->
                        <li class=""><a href="<?php echo site_url();?>/welcome/payment_show"><i class="icon-angle-right"></i> List </a></li>
                        
                    </ul>
                </li>

                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav5">
                        <i class="icon-pencil"></i> Order
       
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; 
                    </a>
                    <ul class="collapse" id="form-nav5">
                        <li class=""><a href="<?php echo site_url();?>/welcomeNew/addmorepayment"><i class="icon-angle-right"></i> Add </a></li>
                         <li class=""><a href="<?php echo site_url();?>/welcome/orderlist"><i class="icon-angle-right"></i> List </a></li> 
                        
                    </ul>
                </li>
                   
    

                    
 
           <!-- <li><a href="<?php //echo site_url();?>/welcome/table_reseller"><i -->

           <!--         class=""></i>Reseller List</a></li>-->



           <!--<li><a href="<?php //echo site_url();?>/welcome/table_product"><i -->

           <!--         class=""></i>Item List</a></li>-->

                    

           <!--  <li><a href="<?php //echo site_url();?>/welcome/payment_show"><i -->

           <!--         class=""></i>Payment List</a></li>-->
                 

                <?php } ?>






            </ul>
        </div>

        <!--END MENU SECTION -->