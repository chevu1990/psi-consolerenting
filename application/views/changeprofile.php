
	<?php $this->load->helper('form_helper'); ?>

<div class ="well well-sm">
    <legend><h2>Change your information! <small>or cancel operation by clicking button Cancel.</small></h2></legend>
    <?php
        echo form_open_multipart('user/update');

        echo validation_errors();

        echo "<p><strong>Password:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo form_password('password');
        echo "<p>";

        echo "<p><strong>Confirm password:</strong> ";
        echo form_password('cpassword');
        echo "<p>";

        echo "<p><strong>First name:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo form_input('firstName');
        echo "<p>";

        echo "<p><strong>Last name:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo form_input('lastName');
        echo "<p>";
    ?>

        <input type="file" name="user_file">

    <?php
        echo "<p>";
        echo form_submit('signup_submit', 'Submit Changes', "class='btn btn-primary btn-lg'");
        
        echo "&nbsp;&nbsp;&nbsp;";
        
        echo form_close();
    ?>

    <a href=<?php echo base_url() . "index.php/frontpage/profile" ?>><button type="button" class="btn btn-primary"> Cancel</button></a>
    </div>
