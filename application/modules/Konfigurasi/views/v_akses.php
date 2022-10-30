<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?=ucfirst($this->uri->segment(1,0))?> /</span> <?=ucfirst($this->uri->segment(2,0))?></h4>
          <br />
            <div class="card">
              <h5 class="card-header">Sistem Menu</h5>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama User</th>
                      <th>Username</th>
                      <th>Jenis User</th>
                      <th>Akses</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php  $no = 1;
                    foreach ($user->result_array() as $value) { ?>
                    <tr>
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?=$no++?></strong></td>
                      <td><?=ucwords($value['nama_user'])?></td>
                      <td><?=$value['username']?></td>
                      <?php if($value['id_jenis_user'] == '1'){?>
                        <td>Admin</td>
                      <?php } ?>
                      <?php if($value['id_jenis_user'] == '2'){?>
                        <td>User</td>
                      <?php } ?>
                      <td>
                        <a href="<?=site_url('konfigurasi/akses/edit/'.$value['id_user'])?>"><span class="badge rounded-pill bg-info"><i class="bx bx-edit me-1"></i>Edit</span></a>
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
