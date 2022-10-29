<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?=ucfirst($this->uri->segment(1,0))?> / <?=ucfirst($this->uri->segment(2,0))?> / </span> <?=ucfirst($this->uri->segment(3,0))?></h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Tambah User Baru</h5>
                      <small class="text-muted float-end">User</small>
                    </div>
                    <div class="card-body">
                      <form class="" action="" method="post">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
                          <div class="col-sm-10">
                            <input type="text" name="nama_user" value="<?=set_value('nama_user')?>" class="form-control <?= form_error('nama_user') ? 'is-invalid' : '' ?>">
                          </div>
                          <div class="invalid-feedback">
                						<?= form_error('nama_user') ?>
                					</div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Username</label>
                          <div class="col-sm-10">
                            <input type="text" name="username" value="<?=set_value('username')?>" class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>">
                          </div>
                          <div class="invalid-feedback">
                						<?= form_error('username') ?>
                					</div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Password</label>
                          <div class="col-sm-10">
                            <input type="password" name="password" value="<?=set_value('password')?>" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>">
                          </div>
                          <div class="invalid-feedback">
                						<?= form_error('password') ?>
                					</div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Konfirmasi Password</label>
                          <div class="col-sm-10">
                            <input type="password" name="passconf" value="<?=set_value('passconf')?>" class="form-control <?= form_error('passconf') ? 'is-invalid' : '' ?>">
                          </div>
                          <div class="invalid-feedback">
                						<?= form_error('passconf') ?>
                					</div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Email</label>
                          <div class="col-sm-10">
                            <input type="email" name="email" value="<?=set_value('email')?>" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>">
                          </div>
                          <div class="invalid-feedback">
                						<?= form_error('email') ?>
                					</div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">No HP</label>
                          <div class="col-sm-10">
                            <input type="text" name="no_hp" value="<?=set_value('no_hp')?>" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>">
                          </div>
                          <div class="invalid-feedback">
                						<?= form_error('no_hp') ?>
                					</div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">WA</label>
                          <div class="col-sm-10">
                            <input type="text" name="wa" value="<?=set_value('wa')?>" class="form-control <?= form_error('wa') ? 'is-invalid' : '' ?>">
                          </div>
                          <div class="invalid-feedback">
                						<?= form_error('wa') ?>
                					</div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Pin</label>
                          <div class="col-sm-10">
                            <input type="text" name="pin" value="<?=set_value('pin')?>" class="form-control <?= form_error('pin') ? 'is-invalid' : '' ?>">
                          </div>
                          <div class="invalid-feedback">
                						<?= form_error('pin') ?>
                					</div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Jenis User</label>
                          <div class="col-sm-10">
                            <select name="id_jenis_user" class="form-select <?= form_error('id_jenis_user') ? 'is-invalid' : '' ?>">
                              <option value="">- Pilih Jenis User -</option>
                              <option value="1" <?=set_value('id_jenis_user') == '1' ? "selected" : null?>>Admin</option>
                              <option value="2" <?=set_value('id_jenis_user') == '2' ? "selected" : null?>>User</option>
                            </select>
                          <div class="invalid-feedback">
                						<?= form_error('id_jenis_user') ?>
                					</div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Status User</label>
                        <div class="col-sm-10">
                          <select name="status_user" class="form-select <?= form_error('status_user') ? 'is-invalid' : '' ?>">
                            <option value="">- Pilih Status User -</option>
                            <option value="aktif" <?=set_value('status_user') == 'aktif' ? "selected" : null?>>Aktif</option>
                            <option value="nonaktif" <?=set_value('status_user') == 'nonaktif' ? "selected" : null?>>Nonaktif</option>
                          </select>
                        <div class="invalid-feedback">
                          <?= form_error('status_user') ?>
                        </div>
                      </div>
                    </div>
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <br />
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?=site_url('data/data_user')?>" type="button" class="btn btn-danger pull-right">Batal</a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
<!-- / Content -->
