
<div class="well">
    <table class="table">
        <p>Console rents:</p>
        <thead>
        <tr>
          <th class='text-center'>ID</th>
          <th class='text-center'>User ID</th>
          <th class='text-center'>Console ID</th>
          <th class='text-center'>Start Date</th>
          <th class='text-center'>End Date</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>        
<?php 
       $this->load->helper('url');
       $crents = $conrents;
       $i = 1;
       if ($crents):
       foreach ($crents->result() as $row):
?>
        <tr>
            <td class='text-center'><?php echo $i++; ?></td>
            <td class='text-center'><?php echo $row->UID; ?></td>
            <td class='text-center'><?php echo $row->CID ?></td>
            <td class='text-center'><?php echo $row->DatumOd ?></td>
            <td class='text-center'><?php echo $row->DatumDo ?></td>
        </tr>
        <?php endforeach;endif; ?>
      </tbody>
    </table>
</div>
<div class="well">
    <table class="table">
        <p>Game rents:</p>
        <thead>
        <tr>
          <th class='text-center'>ID</th>
          <th class='text-center'>User ID</th>
          <th class='text-center'>Game ID</th>
          <th class='text-center'>Start Date</th>
          <th class='text-center'>End Date</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
<?php 
       $this->load->helper('url');
       $grents = $gamrents;
       $j = 1;
       if ($grents):
       foreach ($grents->result() as $row):
?>
        <tr>
            <td class='text-center'><?php echo $j++; ?></td>
            <td class='text-center'><?php echo $row->UID; ?></td>
            <td class='text-center'><?php echo $row->GID ?></td>
            <td class='text-center'><?php echo $row->DatumOd ?></td>
            <td class='text-center'><?php echo $row->DatumDo ?></td>
        </tr>
<?php endforeach;endif; ?>
      </tbody>
    </table>

</div>
</div>