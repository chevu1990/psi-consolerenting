<?php
            $this->load->helper('url');
            $data = $myData;
            if ($data):
            foreach ($data->result() as $row);
            $image = $img;
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src=<?php echo $image ?> alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                            <?php  echo $row->ime . " " . $row->prezime ?></h4>
                        <small><cite title="Name"><i class="glyphicon glyphicon-user">
                                    <?php echo $row->ime ?>
                        </i></cite></small>
                        <br />
                        <small><cite title="Surname"><i class="glyphicon glyphicon-user">
                                    <?php echo $row->prezime ?>
                        </i></cite></small>
                        <p>
                            <small><cite title="Email"><i class="glyphicon glyphicon-envelope"><?php echo "&nbsp;" . $row->email ?></i>
                                    <br /></cite></small>
                        <small><cite title="Membership"><i class="glyphicon glyphicon-info-sign">
                                    <?php if($row->membership == 1) {
                                            echo "Regular User";
                                          }else if($row->membership == 2){
                                                  echo "Premium User";
                                                }else if($row->membership == 3){
                                                        echo "Gold user"; 
                                                      }
                                     ?>
                        </i></cite></small>
                            <br />
                        <a href="changeprofile"><button type="button" class="btn btn-default btn-lg">
                            <span class="glyphicon glyphicon-list"></span> Change info
                        </button></a>
                    </div>
                </div>
            </div>
        </div>
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><h3>Active Rents:</h3>

<table class="table table-striped custab">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date on</th>
            <th>Date off</th>
            <th>Rate</th>
            <th class="text-center">Action</th>            
        </tr>
    </thead>
<?php $id = 1; ?>
<?php
            $this->load->helper('form');
            $crent = $crents;
            if ($crent):
            $id_container =array();
            $i=0;
            foreach ($crent->result() as $row):
                $id_container[$i++] = $row->CID;            
?>                
        <?php echo form_open('user/crents/' . $row->CID . "/" . $row->RCID) ?>
    
            <tr>
                <td><?php echo $id++; ?></td>
                <td><?php 
                        $this->db->select('naziv');
                        $this->db->from('console');
                        $this->db->where('CID', $row->CID);
                        $qv = $this->db->get();
                        if ($qv->num_rows() > 0){
                            $result = $qv->row();
                            $name = $result->naziv;
                            echo $name;
                        }                
                ?></td>
                <td><?php echo $row->DatumOd; ?></td>
                <td><?php echo $row->DatumDo; ?></td>
                <td>
                    <?php 
                $options = array(
                  '5'  => '5',
                  '4'  => '4',
                  '3'  => '3',
                  '2'  => '2',
                  '1'  => '1',
                );
                echo form_dropdown('rate', $options, '5');
                ?>
                </td>                
                <td class="text-center">
                    <?php echo form_submit('return_submit', 'Return', "class='btn btn-primary btn-sm'"); ?>
                </td>

            </tr>
        <?php echo form_close();  ?>
   <?php endforeach; endif;?>
            
<?php
            $this->load->helper('form');
            $grent = $grents;
            if ($grent):
            $id_container =array();
            $i=0;
            foreach ($grent->result() as $row):
                $id_container[$i++] = $row->GID;

?>             
        <?php echo form_open('user/grents/' . $row->GID . "/" . $row->RGID) ?>
            
        <?php echo validation_errors(); ?>

            <tr>
                <td><?php echo $id++; ?></td>
                <td><?php 
                        $this->db->select('naziv');
                        $this->db->from('game');
                        $this->db->where('GID', $row->GID);
                        $qv = $this->db->get();
                        if ($qv->num_rows() > 0){
                            $result = $qv->row();
                            $name = $result->naziv;
                            echo $name;
                        }                
                ?></td>                <td><?php echo $row->DatumOd; ?></td>
                <td><?php echo $row->DatumDo; ?></td>
                <td>
                    <?php 
                $options = array(
                  '5'  => '5',
                  '4'  => '4',
                  '3'  => '3',
                  '2'  => '2',
                  '1'  => '1',
                );
                echo form_dropdown('rate', $options, '5');
                ?>

                </td>
                <td class="text-center">
                    <?php echo form_submit('return_submit', 'Return', "class='btn btn-primary btn-sm'"); ?>
                </td>
            </tr>
        <?php echo form_close();  ?>
<?php endforeach; endif;else:echo '<p style="color: red; font-size: 110%;">You must be loged in to see this page.</p>';endif;?>
    
        </table>
    </div>
</div>