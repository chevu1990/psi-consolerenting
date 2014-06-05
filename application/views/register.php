
<?php $this->load->helper('form_helper'); ?>

<div class ="row">
      <div class="col-md-10 col-md-offset-1" >
        <div class="well well-sm">

    <legend><h2>Please Sign Up <small>It's free and always will be.</small></h2></legend>
    <br /> 
    <br />
    <?php
        echo form_open('user/signup', "style='width:80%; height:200%;'");
        
        echo validation_errors();

        echo "<p style='font-size: 130%'><strong >Email:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo form_input('email', $this->input->post('email'), "class = 'form-inline'");
        echo "</p>";
      
        echo "<p style='font-size: 130%'><strong>Password:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo form_password('password','', "class = 'form-inline '");
        echo "<p>";
    
        echo "<p style='font-size: 130%'><strong>Confirm password:</strong> &nbsp;&nbsp;";
        echo form_password('cpassword','' ,"class = 'form-inline'");
        echo "<p>";
        
        echo "<p style='font-size: 130%'><strong>First name:</strong>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo form_input('firstName','' ,"class = 'form-inline'");
        echo "<p>";
      
        echo "<p style='font-size: 130%'><strong>Last name:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo form_input('lastName','' , "class = 'form-inline'");
        echo "<p>";
        
        echo "<p>";
        echo form_submit('signup_submit', 'Sign up', "class='btn btn-primary btn-lg'");
        echo "<p>";
        echo form_close();
    ?>
</div>
      </div></div>
