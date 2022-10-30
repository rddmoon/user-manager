<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?=ucfirst($this->uri->segment(1,0))?> /</span> <?=ucfirst($this->uri->segment(2,0))?></h4>
          <br />
            <div class="card">
              <h5 class="card-header">Aktivitas Username: <?=$user->username?></h5>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Deskripsi</th>
                      <th>Menu</th>
                      <th>Status</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php  $no = 1;
                    foreach ($aktivitas->result() as $key => $value) { ?>
                    <tr>
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?=$no++?></strong></td>
                      <td><?=$value->deskripsi?></td>
                      <td><?=$value->menu_name?></td>
                      <?php if($value->status == "berhasil"){ ?>
                        <td><span class="badge bg-label-success me-1"><?=ucfirst($value->status)?></span></td>
                      <?php }
                            else{ ?>
                        <td><span class="badge bg-label-warning me-1"><?=ucfirst($value->status)?></span></td>
                      <?php } ?>
                      <td><?=$value->create_date?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-sm-12">
                <br />
                <a href="<?=site_url('aktivitas/aktivitas_user')?>" type="button" class="btn btn-secondary">Kembali</a>
              </div>
            </div>
          </div>
        </div>
<!-- / Content -->
