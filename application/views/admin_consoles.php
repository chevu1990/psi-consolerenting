
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th class='text-center'>ID</th>
          <th class='text-center'>Console Name</th>
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
       $consoles = $cons;
       $i = 1;
       if ($consoles):
       foreach ($consoles->result() as $row):
?>
        <tr>
            <td class='text-center'><?php echo $i++; ?></td>
            <td class='text-center'><?php echo $row->naziv; ?></td>
            <td class='text-center'><?php echo $row->status; ?></td>
            <td class='text-center'><?php echo $row->Cena; ?></td>
            <td class='text-center'><?php echo $row->count; ?></td>
            <td class='text-center'><?php echo $row->rentedcount; ?></td>
            <td class='text-center'><?php echo anchor('frontpage/addccount/' . $row->CID, '+1 ','class="btn btn-primary btn" ');?></td>
            <td class='text-center'><?php echo anchor('frontpage/deleteccount/' . $row->CID, '-1 ','class="btn btn-primary btn" ');?></td>
        </tr>
<?php endforeach;endif; ?>
    </tbody>
    </table>
    <div class="container">
        <?php echo anchor('frontpage/add_console', 'Add Console','class="btn btn-primary btn" style="text-align: center; width: 10%;"');?>        
    </div>
</div>
</div>
