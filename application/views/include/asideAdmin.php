	<?php $this->load->helper('url_helper'); ?>
<div class="container">
    <div class="row" style="clear: both; margin-bottom: 3%; border-bottom: 1px solid #dddddd; border-top:1px solid #dddddd; background:#F2F2F2;">
        <ul class="nav nav-pills nav-justified">
          <li><?php echo anchor('frontpage/index', 'Home'); ?></li>
	  <li><?php echo anchor('frontpage/admin_rents', 'Active Rents'); ?></li>
	  <li><?php echo anchor('frontpage/admin_consoles', 'Add Consoles'); ?></li>
	  <li><?php echo anchor('frontpage/admin_games', 'Add Games'); ?></li>
          <li><?php echo anchor('frontpage/manage_profiles', 'Manage Profiles'); ?></li>
          <li><?php echo anchor('frontpage/admin_statistic', 'Statistic'); ?></li>
          <li><?php echo anchor('frontpage/admin_profile', 'Profile'); ?></li>          
	</ul>
    </div>
</div>
