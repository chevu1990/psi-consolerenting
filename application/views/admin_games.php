
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th class='text-center'>ID</th>
          <th class='text-center'>Game Name</th>
          <th class='text-center'>Status</th>
          <th class='text-center'>Price</th>
          <th class='text-center'>Count</th>
          <th class='text-center'>Times Rented</th>
          <th class='text-center'>+console</th>
          <th class='text-center'>-console</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>      
<?php 
       $this->load->helper('url');
       $games = $gms;
       $i = 1;
       if ($games):
       foreach ($games->result() as $row):
?>
        <tr>
            <td class='text-center'><?php echo $i++; ?></td>
            <td class='text-center'><?php echo $row->naziv; ?></td>
            <td class='text-center'><?php echo $row->status; ?></td>
            <td class='text-center'><?php echo $row->Cena; ?></td>
            <td class='text-center'><?php echo $row->count; ?></td>
            <td class='text-center'><?php echo $row->rentedcount; ?></td>
            <td class='text-center'><?php echo anchor('frontpage/addgcount/' . $row->GID, '+1 ','class="btn btn-primary btn" ');?></td>
            <td class='text-center'><?php echo anchor('frontpage/deletegcount/' . $row->GID, '-1 ','class="btn btn-primary btn" ');?></td>
        </tr>
<?php endforeach; endif; ?>
      </tbody>
    </table>
    <div class="container">
        <?php echo anchor('frontpage/add_game', 'Add Game','class="btn btn-primary btn" style="text-align: center; width: 10%;"');?>
    </div>
</div>
</div>