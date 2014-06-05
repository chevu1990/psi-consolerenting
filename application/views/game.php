<?php
            $this->load->helper('url');
            $this->load->helper('form_helper');
            $data = $GamesData;
            $data2 =$UserData;
            $data3 =$ImgData;
            foreach ($data->result() as $row);
?>

 <div class="row" style="margin-bottom: 2%; margin-left: 3%">        
     <div class="col-md-2 col-lg-2" style="width: 29%; " >
            <?php echo '<img src='.$data3->row()->URL. ' alt="slika" class="img-rounded img-responsive" />';?>
        </div>
        <div class="col-sm-4 col-md-4">
            <blockquote>
                <p><?php echo $row->naziv; ?></p> <small><cite title="Consoles remaining">remaining:&nbsp;<?php echo $row->count;?>  <i class="glyphicon glyphicon-map-marker"></i></cite></small>
            </blockquote>
            <p> <i class="glyphicon glyphicon-tower"></i>&nbsp;&nbsp;Status:&nbsp;&nbsp;<?php echo $row->status; ?> <br />
            <p> <i class="glyphicon glyphicon-tower"></i>&nbsp;&nbsp;Description:&nbsp;&nbsp;<?php echo $row->opis; ?> <br />
            <p> <i class="glyphicon glyphicon-tower"></i>&nbsp;&nbsp;Average rating:&nbsp;&nbsp;
               <?php echo round($row->Ocena, 2); ?>/5<br /><br />
                <br /> <i class="glyphicon glyphicon-tower"></i>&nbsp;&nbsp;Price:&nbsp;&nbsp;
                <?php 
                
                $cena = $row->Cena;
                if($this->session->userdata('is_logged_in')){  
                   $membership=$data2->row()->membership;
                if($membership == 2){
                    $cena = $cena*0.8;
                }
                if($membership == 3) {
                    $cena = $cena*0.6;
                }
                }
                echo $cena; ?>$<br />
                
                <small><em>&nbsp;&nbsp;&nbsp;&nbsp;Price adjusted according to user category</em></small>
                
                <br /><br />
                
                <br /> <i class="glyphicon glyphicon-tower"></i>&nbsp;&nbsp;Days: &nbsp;&nbsp;
                
                <?php echo form_open('frontpage/createRent/' . $row->GID);?>
                <?php 
                $options = array(
                  '1'  => '1',
                  '2'  => '2',
                  '3'  => '3',
                  '4'  => '4',
                  '5'  => '5',
                  '6'  => '6',
                  '7'  => '7',
                );
                echo form_dropdown('days', $options, '2');
                ?>
                <br/><br />
                <?php echo form_submit('RentGame','Rent this Game','class="btn btn-primary btn"');?></p>            
                <?php echo form_close();?>
        </div>
 </div>

