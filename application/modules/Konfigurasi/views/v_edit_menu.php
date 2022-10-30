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
                      <h5 class="mb-0">Edit Menu</h5>
                      <small class="text-muted float-end">Menu</small>
                    </div>
                    <div class="card-body">
                      <form class="" action="" method="post">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Menu</label>
                          <div class="col-sm-10">
                            <input type="text" name="menu_name" value="<?=$this->input->post('menu_name') ?? $menu->menu_name?>" class="form-control <?= form_error('menu_name') ? 'is-invalid' : '' ?>">
                          </div>
                          <div class="invalid-feedback">
                						<?= form_error('menu_name') ?>
                					</div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Link Menu</label>
                          <input type="hidden" name="menu_id" value="<?=$menu->menu_id?>">
                          <div class="col-sm-10">
                            <input type="text" name="menu_link" value="<?=$this->input->post('menu_link') ?? $menu->menu_link?>" class="form-control <?= form_error('menu_link') ? 'is-invalid' : '' ?>">
                          </div>
                        </div>
                        <div class="invalid-feedback">
                          <?= form_error('menu_link') ?>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Icon</label>
                          <div class="col-sm-10">
                            <input type="text" name="menu_icon" value="<?=$this->input->post('menu_icon') ?? $menu->menu_icon?>" class="form-control <?= form_error('menu_icon') ? 'is-invalid' : '' ?>">
                          </div>
                          <div class="invalid-feedback">
                						<?= form_error('menu_icon') ?>
                					</div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Level</label>
                          <div class="col-sm-10">
                            <select name="id_level" class="form-select <?= form_error('id_level') ? 'is-invalid' : '' ?>">
                              <?php $levels = $this->input->post('id_level') ? $this->input->post('id_level') : $menu->id_level; ?>
                              <option value="">- Pilih Level Menu -</option>
                              <?php foreach ($level->result() as $key => $value) {?>
                              <option value="<?=$value->id_level?>" <?=$levels == $value->id_level ? 'selected' : null?>><?=$value->level?></option>
                              <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Parent Menu</label>
                        <div class="col-sm-10">
                          <select name="parent_id" class="form-select">
                            <?php $parents = $this->input->post('parent_id') ? $this->input->post('parent_id') : $menu->parent_id; ?>
                            <option value="">- Pilih Parent Menu -</option>
                            <?php foreach ($parent->result() as $key => $value) {?>
                            <option value="<?=$value->menu_id?>" <?=$parents == $value->menu_id ? 'selected' : null?>><?=$value->menu_name?>  /<?=$value->menu_link?></option>
                            <?php } ?>
                            </select>
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
