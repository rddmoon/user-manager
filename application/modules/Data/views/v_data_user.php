<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?=ucfirst($this->uri->segment(1,0))?> /</span> <?=ucfirst($this->uri->segment(2,0))?></h4>
          <div class="">
            <a href="<?=site_url('data/data_user/add')?>" class="btn btn-primary">
              <i class="menu-icon tf-icons bx bx-user-plus"></i> Tambah</a>
          </div>
          <br />
            <div class="card">
              <h5 class="card-header">User</h5>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama User</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>No HP</th>
                      <th>WA</th>
                      <th>PIN</th>
                      <th>Jenis User</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php  $no = 1;
                    foreach ($user->result() as $key => $value) { ?>
                    <tr>
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?=$no++?></strong></td>
                      <td><?=$value->nama_user?></td>
                      <td><?=$value->username?></td>
                      <td><?=$value->email?></td>
                      <td><?=$value->no_hp?></td>
                      <td><?=$value->wa?></td>
                      <td><?=$value->pin?></td>
                      <?php if($value->id_jenis_user == '1'){?>
                        <td>Admin</td>
                      <?php } ?>
                      <?php if($value->id_jenis_user == '2'){?>
                        <td>User</td>
                      <?php } ?>
                      <?php if($value->status_user == "aktif"){ ?>
                        <td><span class="badge bg-label-primary me-1"><?=ucfirst($value->status_user)?></span></td>
                      <?php }
                            else{ ?>
                        <td><span class="badge bg-label-warning me-1"><?=ucfirst($value->status_user)?></span></td>
                      <?php } ?>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?=site_url('data/data_user/edit/'.$value->id_user)?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                            <a onclick="return confirm('Apakah anda yakin akan menghapus data?')" class="dropdown-item" href="<?=site_url('data/data_user/delete/'.$value->id_user)?>">
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
