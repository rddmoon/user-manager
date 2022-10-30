<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?=ucfirst($this->uri->segment(1,0))?></span></h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <?php if(!$ada_foto){ ?>
                          <img src="<?=base_url()?>/assets/assets/img/avatars/no_profile.png" alt="user-avatar" class="d-block rounded" id="uploadedAvatar" width="100" height="100">
                        <?php   } ?>
                        <?php if($ada_foto){ ?>
                          <img src="<?=base_url()?>/assets/assets/img/uploads/<?=$ada_foto?>" alt="user-avatar" class="d-block rounded" id="uploadedAvatar" width="100" height="100">
                        <?php   } ?>
                        <div class="button-wrapper">
                          <?php echo form_open_multipart('profil');?>
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload Foto Baru</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" name="foto" class="account-file-input" accept="image/png, image/jpeg, image/jpg, image/gif" hidden="">
                          </label>
                          
                          <a type="button" class="btn btn-outline-secondary account-image-reset mb-4" href="<?=site_url('profil/remove_avatar')?>"
                            <?php if(!$ada_foto){echo "hidden";} ?>>
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Hapus Foto Profil</span>
                          </a>

                          <p class="text-muted mb-0">File JPG, GIF atau PNG. Maksimal berukuran 1MB</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                      <!-- <form method="POST"> -->
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="basic-default-name">Nama</label>
                            <div class="col-sm-10">
                              <input type="text" name="nama_user" value="<?=$this->input->post('nama_user') ?? $user->nama_user?>" class="form-control <?= form_error('nama_user') ? 'is-invalid' : '' ?>">
                            </div>
                            <input type="hidden" name="id_user" value="<?=$user->id_user?>">
                            <div class="invalid-feedback">
                  						 <?= form_error('nama_user') ?>
                  					</div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Username</label>
                            <input class="form-control" type="text" name="username" value="<?=$this->input->post('username') ?? $user->username?>" class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                  						 <?= form_error('username') ?>
                  					</div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" name="email" value="<?=$this->input->post('email') ?? $user->email?>" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                               <?= form_error('email') ?>
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" value="<?=set_value('password')?>" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                               <?= form_error('password') ?>
                            </div>
                            <div class="form-text">Jika tidak diganti, biarkan kosong.</div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Konfirmasi Password</label>
                            <input type="password" name="passconf" class="form-control" value="<?=set_value('passconf')?>" class="form-control <?= form_error('passconf') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                               <?= form_error('passconf') ?>
                            </div>
                            <div class="form-text">Jika tidak diganti, biarkan kosong.</div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">No HP</label>
                            <input type="text" class="form-control" name="no_hp" value="<?=$this->input->post('no_hp') ?? $user->no_hp?>" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                               <?= form_error('no_hp') ?>
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">WA</label>
                            <input class="form-control" type="text" name="wa" value="<?=$this->input->post('wa') ?? $user->wa?>" class="form-control <?= form_error('wa') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                               <?= form_error('wa') ?>
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">Pin</label>
                            <input type="text" class="form-control" name="pin" value="<?=$this->input->post('pin') ?? $user->pin?>" class="form-control <?= form_error('pin') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                               <?= form_error('pin') ?>
                            </div>
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        </div>
                      <?php echo form_close() ?>
                    </div>
                    <!-- /Account -->
                  </div>
                </div>
              </div>
            </div>
<!-- / Content -->
