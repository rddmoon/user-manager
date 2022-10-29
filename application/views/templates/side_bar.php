<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <div class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">usermanager</span>
          </div>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item <?php if($this->uri->segment(1,0) == 'dashboard'){echo "active";} ?>">
            <a href="<?=site_url('dashboard')?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>
          <?php foreach ($menu_lv1 as $lv1): ?>
            <?php foreach ($menu_lv2 as $lv2) {
              if($lv1['menu_id'] == $lv2['parent_id']){ ?>
                <li class="menu-item <?php if($this->uri->segment(1,0) == $lv1['menu_link']){echo "active";} ?>">
                  <a href="<?=base_url($lv1['menu_link'])?>" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx <?=$lv1['menu_icon']?>"></i>
                    <div data-i18n="Layouts">
                      <?=$lv1['menu_name']?>
                    </div>
                  </a>
          <?php    ; break;}
              else{ ?>
                <li hidden>
          <?php     }
            } ?>

            <ul class="menu-sub">
              <?php foreach ($menu_lv2 as $lv2):
                      if($lv2['parent_id'] == $lv1['menu_id']){?>
              <li class="menu-item <?php if(uri_string() == $lv2['menu_link']){echo "active";} ?>">
                <a href="<?=base_url($lv2['menu_link'])?>" class="menu-link">
                  <i class="menu-icon tf-icons bx <?=$lv2['menu_icon']?>"></i>
                    <div data-i18n="Without menu"><?=$lv2['menu_name']?></div>
                </a>
              </li>
            <?php     }
                  endforeach ?>
            </ul>
          </li>
        <?php endforeach ?>
      </aside>
      <!-- / Menu -->
