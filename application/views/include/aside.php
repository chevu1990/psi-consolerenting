	<?php $this->load->helper('url_helper'); ?>

    <div class="row" style="clear: both; margin-bottom: 3%; border-bottom : 1px solid #dddddd; border-top:1px solid #dddddd;background:#F2F2F2;">    
        <ul class="nav nav-pills nav-justified" style="margin-bottom:0%;">
          <li><?php echo anchor('frontpage/index', 'Home'); ?></li>
	  <li><?php echo anchor('frontpage/about', 'About Us'); ?></li>
	  <li><?php echo anchor('frontpage/consoles', 'Consoles'); ?></li>
	  <li><?php echo anchor('frontpage/games', 'Games'); ?></li>
          <li><?php echo anchor('frontpage/register', 'Register'); ?></li>
          <li><?php echo anchor('frontpage/contact', 'Contact'); ?></li>
	</ul>
    </div>   

