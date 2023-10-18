<div class="card card-body card_ilmi">
    <div>
        <div>
            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan') ?>"></div>
            <div class="flash-data-hp" data-flashdata="<?php echo $this->session->flashdata('hp') ?>"></div>
            <div class="flash-data-foto" data-flashdata="<?php echo $this->session->flashdata('no_foto') ?>"></div>



            <h6 style="font-weight: 900;">Informasi Akun</h6>
            <p style="line-height: 0px;">Perbarui Informasi Akun Anda</p>
            <div style="margin-top:40px;display:flex;align-items:center;">
                <img src="data:image/jpg;base64,<?php echo $data_user2['gambar']; ?>" class="img-circle">
                <!--  -->
                <div style="margin-left: 21px;">
                    <h3><?php echo  $data_user2['name'] ?></h3>
                    <h6><?php echo  $data_user2['email'] ?></h6>
                </div>

            </div>
        </div>
        <div style="margin-top: 10px;">
            <?php if ($this->session->userdata('role_id') == 2 || $this->session->userdata('role_id') == 3) { ?>
                <form action="<?php echo base_url('user/proses_edit_gambar') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group" style="display:flex;gap: 10px;">
                        <input type="file" id="file" class="form-control" name="userfile" accept=".jpg, .jpeg, .png" style="width: 23.5%;height:40px;">
                        <button type="submit" class="btn btn-info">Unggah</button>
                    </div>

                    <!-- <P>*ukuran file tidak boleh melebihi 2 mb</P> -->

                </form>
                <form action="<?php echo base_url('User/proses_edit') ?>" method="POST">

                    <h6 style="display: inline-block;font-weight: 900;">Informasi Pribadi</h6>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $data_user['email'] ?>">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama</label>
                        <input type="text" class="form-control " id="exampleInputPassword1" name="nama" value="<?php echo $data_user['name'] ?>">
                        <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="">
                            <?php if($peserta['jenis_kelamin']=='L'){
                                $jenis_kelamin = 'Laki-laki';
                                }else{
                                    $jenis_kelamin = 'Perempuan';
                                }
                            ?>
                            <select class="form-control" aria-label="Default select example" name="jenis_kelamin" >
                                <option selected><?php echo $jenis_kelamin ?></option>
                                <?php if ($peserta['jenis_kelamin'] == 'P' || $peserta['jenis_kelamin'] == 'Perempuan') { ?>
                                    <option>Laki-laki</option>
                                <?php } ?>
                                <?php if ($peserta['jenis_kelamin'] == 'L' || $peserta['jenis_kelamin'] == 'Laki-laki') { ?>
                                    <option>Perempuan</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tempat Lahir</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="tempat_lahir" value="<?php echo $peserta['tempat_lahir'] ?>">
                        <?php echo form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col">
                        <label for="">Tanggal Lahir</label>
                        <div class="input-group mb-0">
                          <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/timer1.svg" alt=""></span>
                          <input class="form-control" type="date" name="tanggal_lahir" value="<?php echo $peserta['tanggal_lahir'] ?>">
                        </div>
                        <?php echo form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">No. Telepon</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" name="no_hp" value="<?php echo $peserta['nomor_hp'] ?>">
                        <?php echo form_error('no_hp', '<small class="text-danger pl-3">', '   '); ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Alamat</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="alamat" value="<?php echo $peserta['alamat'] ?>">
                        <?php echo form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Instansi</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="instansi" value="<?php echo $peserta['instansi'] ?>">
                        <?php echo form_error('instansi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <button type="submit" class="btn btn-info">Ubah</button>

                </form>
            <?php } ?>

            <?php if ($this->session->userdata('role_id') == 1) { ?>
                <form action="<?php echo base_url('user/proses_edit_gambar_admin') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group" style="display:flex;gap: 10px;">
                        <input type="file" id="file" class="form-control" name="userfile" accept=".jpg, .jpeg, .png" style="width: 23.5%;height:40px;">
                        <button type="submit" class="btn btn-info">Unggah</button>
                    </div>

                    <!-- <P>*ukuran file tidak boleh melebihi 2 mb</P> -->

                </form>
                <form action="<?php echo base_url('user/proses_edit_admin') ?>" method="POST" enctype="multipart/form-data">

                    <h6 style="display: inline-block;font-weight: 900;">Informasi Pribadi</h6>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $data_user['email'] ?>">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="nama" value="<?php echo $data_user['name'] ?>">
                        <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-info">Ubah</button>
                </form>
            <?php } ?>
        </div>

    </div>

</div>