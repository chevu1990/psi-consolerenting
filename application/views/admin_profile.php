<?php
            $this->load->helper('url');
            $this->load->helper('form_helper');
            
            $data = $admin;
            $image = $img;
            foreach ($data->result() as $row);
            
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
                            <?php  echo $row->Ime . " " . $row->Prezime ?></h4>
                        <small><cite title="Name"><i class="glyphicon glyphicon-map-marker">
                                    <?php echo $row->Ime ?>
                        </i></cite></small>
                        <br />
                        <small><cite title="Last name"><i class="glyphicon glyphicon-map-marker">
                                    <?php echo $row->Prezime ?>
                        </i></cite></small>
                        <p>
                            <small><cite title="Email"><i class="glyphicon glyphicon-envelope"><?php echo "&nbsp;" . $row->username ?></i>
                                    <br /></cite></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

