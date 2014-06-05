 <?php
            $this->load->helper('url');
            $this->load->helper('form');
            $id_container =array();
            $i=0;
            $data = $users;           
            foreach ($data->result() as $row):
            $id_container[$i++]=$row;   
            endforeach;
 ?>

<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th class='text-center'>ID</th>
          <th class='text-center'>Name</th>
          <th class='text-center'>Last name</th>
          <th class='text-center'>Email</th>
          <th class='text-center'>Membership</th>
          <th class='text-center'>Status</th>
          <th class="text-center">Action</th>          
        </tr>
      </thead>
      <tbody> 
                 <?php  $i = 1;   for( $n=0; $n<count($id_container); $n++){   ?> 
        <tr>
            <td class='text-center'><?php  echo $i++; ?></td>
            <td class='text-center'><?php  echo $id_container[$n]->ime ?></td>
            <td class='text-center'><?php  echo $id_container[$n]->prezime ?></td>
            <td class='text-center'><?php  echo $id_container[$n]->email ?></td>
            <td class='text-center'><?php  echo $id_container[$n]->membership ?></td>
            <td class='text-center'><?php  echo $id_container[$n]->status ?></td>
            <td class="text-center"><?php echo anchor('frontpage/manage_profiles1/' .$id_container[$n]->UID, 'Confirm ','class="btn btn-primary btn" ')."&nbsp".anchor('frontpage/manage_profiles0/'.$id_container[$n]->UID, 'Remove','class="btn btn-primary btn" ');?></td>         
        </tr>
                 <?php
                 } 
                 ?>
      </tbody>
    </table>    
</div>
</div>
