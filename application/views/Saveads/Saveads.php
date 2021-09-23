<script src="<?php echo base_url()?>assets/saveads.js"></script>

<div class="main-panel">

    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">

            </div>
            <div class="col-md-12 my-4">
                <div class="row">

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                            <h4 class="text-white card-title">First picture</h4>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                        <div id="save_section">
                            <form method="POST" id="frm_first_ads">
                                <div class="form-group">
                                    <label for="">First Ads</label>
                                    <input type="file" class="form-control" id="first_ads">
                                 </div>
                                <div class="form-group">
                                   <button type="button" class="btn btn-info btn-sm btn-block" id="btn_upload_first_adss">UPLOAD <i class="fa fa-upload"></i></button>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="card-footer bg-white">
                        <?php if($first_ad==''):?>
                          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png" class="img-fluid w-100 h-100" id="first_ads_ic">
                        <?php else:?>
                            <div class="float-right"><button class="btn btn-danger btn-sm my-2" id="first_ads_remove"><i class="fa fa-trash"></i></button></div>
                          <img src="<?php echo base_url()?>assets/customerdisplayads/<?php echo $first_ad?>" class="img-fluid w-100 h-100" id="first_ads_ic">
                        <?php endif;?>

                        </div>
                    </div>

                         <div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                            <h4 class="text-white card-title">Second picture</h4>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                        <div id="save_section">
                            <form method="POST" id="frm_second_ads">
                                <div class="form-group">
                                    <label for="">Second Ads</label>
                                    <input type="file" class="form-control" id="second_ads">
                                 </div>
                                <div class="form-group">
                                   <button type="button" class="btn btn-info btn-sm btn-block" id="second_ads_btn">UPLOAD <i class="fa fa-upload"></i></button>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="card-footer bg-white">
                        <?php if($second_ad==''):?>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png" class="img-fluid w-100 h-100" id="second_ads_pic">
                        <?php else:?>
                                 <div class="float-right"><button class="btn btn-danger btn-sm my-2" id="remove_second_ads_section"><i class="fa fa-trash"></i></button></div>
                                <img src="<?php echo base_url()?>assets/customerdisplayads/<?php echo $second_ad?>" class="img-fluid w-100 h-100" id="second_ads_pic">
                        <?php endif;?>

                        </div>
                    </div>



                         <div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                            <h4 class="text-white card-title">Third picture</h4>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                        <div id="save_section">
                            <form method="POST" id="frm_third_ads">
                                <div class="form-group">
                                    <label for="">Third Ads</label>
                                    <input type="file" class="form-control" id="third_ads">
                                 </div>
                                <div class="form-group">
                                   <button type="button" class="btn btn-info btn-sm btn-block" id="third_ads_btn">UPLOAD <i class="fa fa-upload"></i></button>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="card-footer bg-white">
                        <?php if($third_ad==''):?>
                         <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png" class="img-fluid w-100 h-100" id="second_ads_pic">
                        <?php else:?>
                          <div class="float-right"><button class="btn btn-danger btn-sm my-2" id="remove_third_ad_section"><i class="fa fa-trash"></i></button></div>
                         <img src="<?php echo base_url()?>assets/customerdisplayads/<?php echo $third_ad?>" class="img-fluid w-100 h-100" id="second_ads_pic">
                        <?php endif;?>

                        </div>
                    </div>



                         <div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                            <h4 class="text-white card-title">Fourth picture</h4>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                        <div id="save_section">
                            <form method="POST" id="frm_fourth_ads">
                                <div class="form-group">
                                    <label for="">Fourth Ads</label>
                                    <input type="file" class="form-control" id="fourth_ads">
                                 </div>
                                <div class="form-group">
                                   <button type="button" class="btn btn-info btn-sm btn-block" id="frm_fourth_ads_btn">UPLOAD <i class="fa fa-upload"></i></button>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="card-footer bg-white">
                        <?php if($fourth_ad==''):?>
                         <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png" class="img-fluid w-100 h-100" id="fourth_pic_ads">
                        <?php else:?>
                          <div class="float-right"><button class="btn btn-danger btn-sm my-2" id="fourth_remove_pic"><i class="fa fa-trash"></i></button></div>
                         <img src="<?php echo base_url()?>assets/customerdisplayads/<?php echo $fourth_ad?>" class="img-fluid w-100 h-100" id="fourth_pic_ads">
                        <?php endif;?>

                        </div>
                    </div>






                </div>
            </div>

        </div>

    </div>




    <!--Edit suppliers-->


