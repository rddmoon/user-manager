<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?=ucfirst($this->uri->segment(1,0))?> / <?=ucfirst($this->uri->segment(2,0))?> / </span> <?=ucfirst($this->uri->segment(3,0))?></h4>
          <br />
          <form class="" action="<?=site_url('konfigurasi/akses/simpan')?>" method="post">
            <div class="card">
              <?php if($user->id_jenis_user == '1'){
                      $jenis_user = "Admin";
                    }?>
              <?php if($user->id_jenis_user == '2'){
                      $jenis_user = "User";
                    }?>
              <h5 class="card-header">Edit Akses Username: <?=$user->username?> / Jenis: <?=$jenis_user?></h5>
              <input type="hidden" name="id_user" value="<?=$user->id_user?>">
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Nama Menu</th>
                        <th>Kode Menu</th>
                        <th>Hak Akses</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php function input($no, $akses){
                        return '<td><div class="form-check form-switch mb-2">
                            <input name="akses/'.$no.'" class="form-check-input" type="checkbox"
                            '.($akses == '0' ? 'checked' : '').'></div></td>';
                      } ?>
                      <?php $no = 0;
                      foreach ($list_menu->result() as $key => $value) { ?>
                      <tr>
                        <?php if($value->id_level == 'lv1'){ ?>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?=$value->menu_name?></strong></td>
                        <?php }else
                              { ?>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>&nbsp&nbsp&nbsp&nbsp<?=$value->menu_name?></td>
                        <?php } ?>
                        <td><?=$value->menu_id?></td>
                        <?php echo input($no, $value->delete_mark); ?>
                      </tr>
                    <?php $no++;} ?>
                    </tbody>
                  </table>
                </div>
            </div>
            <br />
            <br />
            <div class="">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="<?=site_url('konfigurasi/akses')?>" type="button" class="btn btn-danger pull-right">Batal</a>
            </div>
          </form>
          </div>
        </div>
<!-- / Content -->
