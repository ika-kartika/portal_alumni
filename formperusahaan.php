<div class="accordion" id="accordionperusahaan">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2" href="#collapseperusahaan">
                <i class="icon-file"></i> Data Perusahaan <i class="icon-minus pull-right"></i>
            </a>
        </div>
        <div id="collapseperusahaan" class="accordion-body collapse in">
            <div class="accordion-inner" style="background-color: #ffffff;">
                <form class="form-horizontal">
                    <fieldset>
                        <legend>Basic Info</legend>
                        <div class="control-group">
                            <label class="control-label">Company Name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="nama" name="nama_perusahaan" readonly="readonly" value="<?php echo $nmper;?>"><span id="pesan1"></span>

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Sector</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="bidang" name="bidang" value="<?php echo $bidangper;?>">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Password</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-lock"></i></span>
                                    <input class="span2"  type="password" id="password" name="password" value=''>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Re-enter Password</label>
                            <div class="controls">
                                <input type="password" class="input-xlarge" id="repassword" name="repassword" value='' ><span id="pesan2"></span>

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Email</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-envelope"></i></span>
                                    <input class="span2"  type="text" id="email" name="email" value="<?php echo $email;?>"> <span id="pesan"></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Website</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-home"></i></span>
                                    <input class="span2"  type="text" id="website" name="website" value="<?php echo $web;?>">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Phone Number</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="telpon" name="telpon" value="<?php echo $telp;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Fax Number</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="fax" name="fax" value="<?php echo $fax;?>">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="alamat">Address</label>
                            <div class="controls">
                                <textarea class="input-xlarge" id="alamat" rows="3" name="alamat"><?php echo $alamat;?></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" id="save">Save Changes</button>
                            <a href="profilad.php?namauser=<?=$nmper;?>" class="btn">Go To Profil</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

</div>