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
                    url: "<?php echo base_url(); ?>index.php/search/gautocomplete/",
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
        Search trough games:<input name="search_data" id="search_data" class = 'form-control' type="text" onkeyup="ajaxSearch();">
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
            $data = $GamesData;  
            $data1 =$ImgData;
            foreach ($data->result() as $row):
            $id_container[$i++]=$row;   
            endforeach;
            foreach ($data1->result() as $row):
            $img_container[$j++]=$row;   
            endforeach; 
            for( $n=0; $n<count($id_container); $n++){
 ?>   

<div class="container">
    <div class="col-md-2 column productbox" style="margin-top:5px;">
        <?php
        for( $m=0; $m<count($img_container); $m++){
            if($id_container[$n]->GID == $img_container[$m]->GID){
            echo '<img src='.$img_container[$m]->URL.' class="img-responsive">';      
        } 
        }
        ?>
        <div class="producttitle"><?php  echo $id_container[$n]->naziv ?></div>
        <div class="productprice"><?php  echo $id_container[$n]->opis ?></div> 
        <?php  $k = $id_container[$n]->GID ?>
            <div class="productprice"><div class="pull-right"><?php echo anchor('frontpage/game/'.$id_container[$n]->GID, 'More','class="btn btn-primary btn"');?></div><div class="pricetext"><?php  echo $id_container[$n]->Cena ?></div></div>
        <div class="productprice">&nbsp;</div>    
    </div>
    


            <?php } ?>

</div>
<br/>
</div>
</div>