
	<?php $this->load->helper('form_helper'); ?>

<div class ="well well-sm">
    <legend><h2>Add a game! <small>or cancel operation by clicking button Cancel.</small></h2></legend>
    <?php
        echo form_open_multipart('admin/add_game');

        echo validation_errors();

        echo "<p><strong>Name:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo form_input('naziv');
        echo "<p>";

        

        echo "<p><strong>Description:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $data =array('name'=>'opis');
        
        echo form_textarea($data);
        echo "<p>";
        
        $options = array(
                  '1'  => '1',
                  '2'  => '2',
                  '3'  => '3',
                  '4'  => '4',
                  '5'  => '5',
                  
                );
        echo '<p><strong>Number of games:</strong> &nbsp;'.form_dropdown('count', $options, '1').'</p>';
        echo '<br/>'; 
        echo "<p><strong>Price:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo form_input('cena');
        echo "<p>";
        echo '<br/>'; 
        
    ?>
        
        <input type="file" name="user_file">
        <br/> 

    <?php
        echo "<p>";
        echo form_submit('console_submit', 'Submit Changes', "class='btn btn-primary btn-lg'");
        
        echo "&nbsp;&nbsp;&nbsp;";
        
        echo form_close();
    ?>

    <a href=<?php echo base_url() . "index.php/frontpage/admin_games" ?>><button type="button" class="btn btn-primary"> Cancel</button></a>
    </div>
