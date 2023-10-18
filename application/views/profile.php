     <div class="card card-body card_ilmi">
         <div>
             <div>
                 <div class="flash-data_passlama" data-flashdata="<?php echo $this->session->flashdata('lama') ?>"></div>
                 <div class="flash-data_passbaru" data-flashdata="<?php echo $this->session->flashdata('baru') ?>"></div>
                 <div class="flash-data_pass" data-flashdata="<?php echo $this->session->flashdata('pesan') ?>"></div>
                 <div class="flash-data_minpass" data-flashdata="<?php echo $this->session->flashdata('minpass') ?>"></div>

                 <h6 style="font-weight: 900;">Informasi Akun</h6>
                 <p style="line-height: 0px;">Perbarui Informasi Akun Anda</p>
                 <div style="margin-top:40px;display:flex;align-items:center;">
                     <img src="data:image/jpg;base64,<?php echo $data_user['gambar']; ?>" class="img-circle">
                     <div style="margin-left: 21px;">
                         <h3><?php echo  $data_user['name'] ?></h3>
                         <h6><?php echo  $data_user['email'] ?></h6>
                     </div>
                 </div>
             </div>
             <div style="margin-top: 30px;">
                 <h6 style="display: inline-block;font-weight: 900;">Informasi Pribadi</h6>
                 <a href="<?php echo base_url('User/profile_edit') ?>" style="float: right;display:inline-block;color:red"> <img src="<?php echo base_url() ?>/assets/assets/img/profile/edit.svg"> Edit</a>

                 <form>
                     <div class="form-group">
                         <label for="exampleInputEmail1">Email</label>
                         <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="color:black;" value="<?php echo $data_user['email'] ?>" readonly>
                     </div>
                     <div class="form-group">
                         <label for="exampleInputPassword1">Nama</label>
                         <input type="text" class="form-control" id="exampleInputPassword1" style="color:black;" value="<?php echo $data_user['name'] ?>" readonly>
                     </div>
                     <?php if ($this->session->userdata('role_id') == 2 || $this->session->userdata('role_id') == 3) { ?>
                        <div class="form-group">
                             <label for="exampleInputEmail1">Jenis Kelamin</label>
                             <?php if( $peserta['jenis_kelamin']=='L'){$kelamin='Laki-laki';}else{$kelamin='Perempuan';} ?>
                             <input type="text" class="form-control" id="exampleInputEmail1" style="color:black;" value="<?php echo $kelamin ?>" readonly>
                         </div> 
                         <div class="form-group">
                             <label for="exampleInputEmail1">Tempat Lahir</label>
                             <input type="text" class="form-control" id="exampleInputEmail1" style="color:black;" value="<?php echo $peserta['tempat_lahir'] ?>" readonly>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Tanggal Lahir</label>
                             <input type="text" class="form-control" id="exampleInputEmail1" style="color:black;" value="<?php echo $peserta['tanggal_lahir'] ?>" readonly>
                         </div>
                    
                         <div class="form-group">
                             <label for="exampleInputPassword1">Alamat</label>
                             <input type="text" class="form-control" id="exampleInputPassword1" style="color:black;" value="<?php echo $peserta['alamat'] ?>" readonly>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">No. Telepon</label>
                             <input type="text" class="form-control" id="exampleInputEmail1" style="color:black;" value="<?php echo $peserta['nomor_hp'] ?>" readonly>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputPassword1">Instansi</label>
                             <input type="text" class="form-control" id="exampleInputPassword1" style="color:black;" value="<?php echo $peserta['instansi'] ?>" readonly>
                         </div>
                     <?php } ?>
                 </form>
             </div>

         </div>
     </div>

     <div class="card card-body card_ilmi">
         <div>
             <h5 style="display: inline-block;">Password</h5>
             <button type="button" style="float: right;display:inline-block;color:red;border-style: none;background-color: transparent;" data-bs-toggle="modal" data-bs-target="#exampleModall"> <img src="<?php echo base_url() ?>assets/assets/img/profile/edit.svg"> Edit</button>
             <h6>Password</h6>
             <div class="input-group" style="height: 42px;">
                 <div class="input-group-prepend" style="width: 60px;height:100%">
                     <img src="<?php echo base_url() ?>assets/assets/img/profile/lock.svg" class="input-group-text" style="height:42px;">

                 </div>
                 <input type="password" class="form-control" style="margin-left: -20px;height: 42px;margin-bottom:0px" value="password" readonly>
             </div>
         </div>

     </div>

     <!-- Modal -->
     <div class="modal fade" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form action="#" id="formData">
                         <h6>Password Lama</h6>
                         <div class="input-group" style="margin-bottom: 10px;height: 42px;margin-bottom:4px;">
                             <div class="input-group-prepend" style="width: 60px;">
                                 <img src="<?php echo base_url() ?>assets/assets/img/profile/lock.svg" class="input-group-text" style="height:42px;">
                             </div>
                             <input type="password" class="form-control" style="margin-left: -20px;margin-bottom:0px;height:42px;" name="oldpass" id="oldpass">
                             <button class="btn btn-outline-secondary" style="text-decoration: none; border-color: #ADADAD;height:auto" type="button" id="btnPw1" onclick="change1()">
                                 <i class="fa fa-eye fa-lg"></i>
                             </button>

                         </div>
                         <span class="form-text text-danger" id="oldpass_error"></span>
                         <h6>Password Baru</h6>
                         <div class="input-group" style="margin-bottom: 10px;height: 42px;">
                             <div class="input-group-prepend" style="width: 60px;height:100%">
                                 <img src="<?php echo base_url() ?>assets/assets/img/profile/lock.svg" class="input-group-text" style="height:42px;">
                             </div>
                             <input type="password" class="form-control" style="margin-left: -20px;height:42px;" name="newpass" id="newpass">
                             <button class="btn btn-outline-secondary" style="text-decoration: none; border-color: #ADADAD;" type="button" id="btnPw2" onclick="change2()">
                                 <i class="fa fa-eye fa-lg"></i>
                             </button>
                         </div>
                         <span class="form-text text-danger" id="newpass_error"></span>
                         <h6>Konfirmasi Password</h6>
                         <div class="input-group" style="margin-bottom: 10px;height: 42px;">
                             <div class="input-group-prepend" style="width: 60px;height:100%;">
                                 <img src="<?php echo base_url() ?>assets/assets/img/profile/lock.svg" class="input-group-text" style="height:42px;">
                             </div>
                             <input type="password" class="form-control" style="margin-left: -20px;height:42px;" name="confirmpass" id="confirmpass">
                             <button class="btn btn-outline-secondary" style="text-decoration: none; border-color: #ADADAD;" type="button" id="btnPw3" onclick="change3()">
                                 <i class="fa fa-eye fa-lg"></i>
                             </button>
                         </div>
                         <span class="form-text text-danger" id="confirmpass_error"></span>

                 </div>
                 </form>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                     <button type="button" class="btn btn-primary" onclick="save()">Simpan</button>

                 </div>
             </div>
         </div>
     </div>

     <script type="text/javascript">
         function change1() {
             var x = document.getElementById('oldpass').type;

             if (x == 'password') {
                 document.getElementById('oldpass').type = 'text';

                 document.getElementById('btnPw1').innerHTML = '<i class="fa fa-eye-slash fa-lg"></i>'
             } else {
                 document.getElementById('oldpass').type = 'password';

                 document.getElementById('btnPw1').innerHTML = '<i class="fa fa-eye fa-lg"></i>';
             }

         }

         function change2() {
             var y = document.getElementById('newpass').type;
             if (y == 'password') {
                 document.getElementById('newpass').type = 'text';

                 document.getElementById('btnPw2').innerHTML = '<i class="fa fa-eye-slash fa-lg"></i>'
             } else {
                 document.getElementById('newpass').type = 'password';

                 document.getElementById('btnPw2').innerHTML = '<i class="fa fa-eye fa-lg"></i>';
             }
         }

         function change3() {
             var z = document.getElementById('confirmpass').type;
             if (z == 'password') {
                 document.getElementById('confirmpass').type = 'text';

                 document.getElementById('btnPw3').innerHTML = '<i class="fa fa-eye-slash fa-lg"></i>'
             } else {
                 document.getElementById('confirmpass').type = 'password';

                 document.getElementById('btnPw3').innerHTML = '<i class="fa fa-eye fa-lg"></i>';
             }
         }

         function save() {
             var modal = $('#exampleModall');
             var tableData = $('#serverside');
             var formData = $('#formData');
             $.ajax({
                 type: "POST",
                 url: "<?php echo base_url('user/proses_edit_pass') ?>",
                 data: formData.serialize(),
                 dataType: "JSON",
                 success: function(response) {
                     if (response.status == 'success') {
                        Swal.fire({ 
                            title: 'Password',
                            text: 'Berhasil diubah',
                            icon: 'success',
                            confirmButtonColor: "#1A9AC6",
                        })
                         modal.modal('hide');
                         reload();
                        
                     }
                     if (response.oldpass_error != '') {
                         $('#oldpass_error').html(response.oldpass_error);
                     } else {
                         $('oldpass_error').html('');
                     }
                     if (response.newpass_error != '') {
                         $('#newpass_error').html(response.newpass_error);
                     } else {
                         $('newpass_error').html('');
                     }
                     if (response.confirmpass_error != '') {
                         $('#confirmpass_error').html(response.confirmpass_error);
                     } else {
                         $('confirmpass_error').html('');
                     }
                     if (response.status == 'failed_pass') {
                         Swal.fire({
                             title: "Gagal",
                             text: 'Password lama salah',
                             icon: "error",
                             confirmButtonColor: "#1A9AC6",
                         });
                     }
                     if (response.status == 'failed_pass_baru') {
                         Swal.fire({
                             title: "Gagal",
                             text: 'Password baru tidak sama',
                             icon: "error",
                             confirmButtonColor: "#1A9AC6",
                         });
                     }
                 },
                 error: function() {

                     console.log('error database');

                 }
             });

         }
     </script>