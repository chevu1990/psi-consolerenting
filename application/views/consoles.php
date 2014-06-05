   <script type="text/javascript">
           function ajaxSearch() {
            var input_data = $('#search_data').val();
            if (input_data.length === 0) {
                $('#suggestions').hide();
            } else {

                var post_data = {
                    'search_data': input_data,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/search/cautocomplete/",
                    data: post_data,
                    success: function(data) {
                        // return success
                        if (data.length > 0) {
                            $('#suggestions').show();
                            $('#autoSuggestionsList').addClass('auto_list');
                            $('#autoSuggestionsList').html(data);
                        }
                    }
                });

            }
        }

   </script>  
        
     <div class="something">
        Search trough consoles:<input name="search_data" id="search_data" class = 'form-control' type="text" onkeyup="ajaxSearch();">
           <div id="suggestions">
               <div id="autoSuggestionsList">  
               </div>
           </div>
     </div>
<?php
            $this->load->helper('url');
            $this->load->helper('form');
            $id_container =array();
            $i=0;
            $j=0;
            $data = $ConsolesData;  
            $data1 =$ImgData;
            foreach ($data->result() as $row):
            $id_container[$i++]=$row;   
            endforeach;  
            foreach ($data1->result() as $row):
            $img_container[$j++]=$row;   
            endforeach;
            $num = count($id_container);
            for( $n=0; $n<$num; $n++){
 ?>
   
<div class="container" style="margin-top: 2%; border: 1px solid #dddddd; padding:5px;">    
    <div class="row" style="margin-bottom: 2%; margin-left: 3%">        
        <div class="col-sm-2 col-md-2" >
             <?php
                    for( $m=0; $m<count($img_container); $m++){
                    if($id_container[$n]->CID == $img_container[$m]->CID){
                    echo '<img src='.$img_container[$m]->URL.' class="img-responsive">'; 
                   
                 } 
                }
             ?>
        </div>
        
        <div class="col-sm-4 col-md-4">
            <blockquote>
                <p><?php echo $id_container[$n]->naziv; ?></p> <small><cite title="Consoles remaining">remaining: <?php echo $id_container[$n]->count; ?>  <i class="glyphicon glyphicon-map-marker"></i></cite></small>
            </blockquote>
            <p> <i class="glyphicon glyphicon-tower"></i>&nbsp;&nbsp;Description:&nbsp;&nbsp;
               <?php echo $id_container[$n]->opis; ?><br /><br />
               
                <i class="glyphicon glyphicon-tower"></i>&nbsp;&nbsp;Average rating:&nbsp;&nbsp;
               <?php echo $id_container[$n]->Ocena; ?>/5<br /><br />
               &nbsp;&nbsp;Price: &nbsp;&nbsp; <?php echo $id_container[$n]->Cena; ?>$<br />
               <br /> <?php echo anchor('frontpage/console/'.$id_container[$n]->CID,'Proceed','class="btn btn-primary btn"');?>
            </p>
        </div>
        <?php 
        $n = $n+1; 
        if($n<$num) {                    
            echo '<div class="col-sm-2 col-md-2" >';
                for( $m=0; $m<count($img_container); $m++){
                    if($id_container[$n]->CID == $img_container[$m]->CID){
                    echo '<img src='.$img_container[$m]->URL.' class="img-responsive">';                   
                 } 
                }
        echo '</div>
        <div class="col-sm-4 col-md-4">
            <blockquote>
                <p>'?><?php echo $id_container[$n]->naziv; ?><?php echo '</p> <small><cite title="Consoles remaining">remaining:'?> <?php echo $id_container[$n]->count; ?> <?php echo' <i class="glyphicon glyphicon-map-marker"></i></cite></small>
            </blockquote>
            
            <p> <i class="glyphicon glyphicon-tower"></i>&nbsp;&nbsp;Description:&nbsp;&nbsp;'?><?php echo $id_container[$n]->opis; ?><?php echo'<p> <i class="glyphicon glyphicon-tower"></i>&nbsp;&nbsp;Average rating:&nbsp;&nbsp;'?><?php echo $id_container[$n]->Ocena; ?>/5<?php echo'<br /><br />Price:'?>
                <?php echo $id_container[$n]->Cena; ?>$<?php echo'<br />
                    <br />'?><?php echo anchor('frontpage/console/'.$id_container[$n]->CID,'Proceed','class="btn btn-primary btn"');?><?php echo '</p>
        </div>
    </div>
    
    
    
</div>'?>
        <?php }
        else{
            echo "</div></div>";
        }
        }
