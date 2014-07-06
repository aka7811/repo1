<style>.dropdown-menu .pseudo-li>a {
display: block;
padding: 3px 20px;
clear: both;
font-weight: 400;
line-height: 1.42857143;
color:black; 
white-space: nowrap;
}
.dropdown-menu  .pseudo-li>a:hover,
.dropdown-menu .pseudo-li>a:focus
{text-decoration:none;color:#262626;background-color:#f5f5f5}

.dropdown-menu  .pseudo-li>a:hover {
background-color:black;
 color:white;
}
.dropdown-menu  .pseudo-li>a:active {
background-color:red;
color:white;
 
}

.right-border
{
border-right:thin solid red;

 
}
.bottom-border
{
padding-right:5px;
border-bottom:thin solid grey;
padding-bottom:10px; 
}
 
 
 
 .open > .dropdown-menu {
  -webkit-transform: scale(1, 1);
  transform: scale(1, 1);  
  opacity:1;
}
  
.dropdown-menu {
  opacity:0.1;
  -webkit-transform-origin: top;  transform-origin: top;
  -webkit-animation-fill-mode: forwards; animation-fill-mode: forwards; 
 transform: scale(1, 0);
 -webkit-transform: scale(1, 0);
  display: block; 
  transition: all 0.17s ease-in;  -webkit-transition: 0.17s ease-in;
}


</style>


 <?php $this->load->helper('container'); ?>
 <?php 
    $auth_data="";
   $this->load->model('auth_model_mine');
   $categories = $this-> navmodel->Get_Categories();
   if ($this->ion_auth->logged_in())
    {
      $user = $this->ion_auth->user()->row();
     

      $auth_data['user_options']=$this-> navmodel->Get_User_Options($this->ion_auth->user()->row()->id);
      
      if($this->ion_auth->is_admin())
      {
        $auth_data['admin_options']=$this-> navmodel->Get_Admin_Options();
      }

      if($this->ion_auth->in_group(4))
      {
        $auth_data['giatros_options']=$this-> navmodel->Get_Giatros_Options($this->auth_model_mine->Table_Id_of_user('giatroi', $user->id));
      }

      if($this->ion_auth->in_group(3))
      {
        $auth_data['farmakeio_options']=$this-> navmodel->Get_Farmakeio_Options($this->auth_model_mine->Table_Id_of_user('farmakeia', $user->id));
      }

      if($this->ion_auth->in_group(5))
      {
        $auth_data['admin2_options']=$this-> navmodel->Get_Admin2_Options();
      }
       
    } 
   $links=$this-> navmodel->Get_Links();
   $links2=$this-> navmodel->Get_Links2();

  ?>
  
  
  
 <nav class="navbar navbar-default    navbar-static-top  navbar-inverse yamm"  >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nc1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span><span class="icon-bar"></span> <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Συνταγογράφηση</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="nc1">
       
    
   
    <ul class="nav navbar-nav ">
       
        <li class="dropdown   ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="help-dropdown">
		  Βοηθητικά <span class="glyphicon glyphicon-help"> <b class="caret"></b>
		  </a>
          
		  <ul class="dropdown-menu"> <!-- aristero menu -->
		  <li>
		   <div class="container-fluid" style="width:900px">
		   <div class="row bottom-border">
		  
			  <div class="col-md-5 right-border" >
			  
					<h5 style="color:grey" > Γρήγοροι σύνδεσμοι</h5>
					<?php foreach ($links as $link): ?>

					 <div class="pseudo-li" ><a href='<?php echo  $link[1]?>'><?php echo $link[0] ?></a></div>
					 

					<?php endforeach ?>
							  
				 
			  </div>
			  <div class="col-md-7 right-border" >
							<h5 style="color:grey" > Γρήγορη εναλλαγή χρήστη</h5>		
						<?php foreach ($links2 as $link): ?>

					 <div class="pseudo-li" ><a href='<?php echo  $link[1]?>'><?php echo $link[0] ?></a></div>
					 

					<?php endforeach ?>
					</div>
					
			</div>
			  <div class="row  " style="padding-top:25px;">
			   <div class="col-md-12  " >
			  
					<p style="color:green; font-size:116%" > <span class="glyphicon glyphicon-asterisk"></span>
					Επιλέξτε δεξιά χρήστη και αριστερά σελίδες (δοκιμή authorization)
					</p>
					 
							  
				 
			  </div>
			  
			  </div>
			
			</div>
			
		   </li>
			</ul>
        </li>
		
	 
      </ul>
	  
	 <!-- edo mpenei to auth comp -->
	<?php echo $this->load->view("templates/auth", $auth_data,true);    ?>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
 </nav>
 

 <!--?php 
   if(isset($message_var)) {echo $this->load->view("templates/message",["message_var"=>$message_var],true);}
?-->
 
 
 
 
 
 



