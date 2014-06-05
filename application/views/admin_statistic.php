 <?php
            $this->load->helper('url');
            $usercnt = $usercount;
            $useractivecnt = $useractivecount;
            $activernts = $activerents;
            $rentscounter = $numberofrents;
            $i=1;
 ?>

<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th class="text-center">Number of users</th>
          <th class="text-center">Number of active users</th>
          <th class="text-center">Number of active rents</th>
          <th class="text-center">Total Rents Counter</th>
        </tr>
      </thead>
      <tbody> 
        <tr>
            <td><?php echo $i++; ?></td>
            <td class="text-center"><?php echo "<a href='manage_profiles'>" . $usercnt . "</a>"; ?></td>
            <td class="text-center"><?php echo $useractivecount; ?></td>
            <td class="text-center"><?php echo "<a href='admin_rents'>" . $activerents. "</a>"; ?></td>
            <td class="text-center"><?php echo $rentscounter; ?></td>
        </tr>
      </tbody>
    </table>    
</div>
</div>
