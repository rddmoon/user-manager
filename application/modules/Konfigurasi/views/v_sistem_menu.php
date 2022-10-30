<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?=ucfirst($this->uri->segment(1,0))?> /</span> <?=ucfirst($this->uri->segment(2,0))?></h4>
          <div class="">
            <a href="<?=site_url('konfigurasi/sistem_menu/add')?>" class="btn btn-primary">
              <i class="menu-icon tf-icons bx bx-user-plus"></i> Tambah</a>
          </div>
          <br />
            <div class="card">
              <h5 class="card-header">Sistem Menu</h5>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Menu</th>
                      <th>Level</th>
                      <th>Link</th>
                      <th>Icon</th>
                      <th>Parent Menu</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php  $no = 1;
                    foreach ($sistem_menu->result() as $key => $value) { ?>
                    <tr>
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?=$no++?></strong></td>
                      <td><?=$value->menu_name?></td>
                      <td><?=$value->id_level?></td>
                      <td><?=$value->menu_link?></td>
                      <td><?=$value->menu_icon?></td>
                      <td><?=$value->parent_name?></td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?=site_url('konfigurasi/sistem_menu/edit/'.$value->menu_id)?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                            <a onclick="return confirm('Apakah anda yakin akan menghapus data?')" class="dropdown-item" href="<?=site_url('konfigurasi/sistem_menu/delete/'.$value->menu_id)?>">
                              <i class="bx bx-trash me-1"></i> Delete</a>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
<!-- / Content -->
