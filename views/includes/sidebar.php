<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?= base_url('index.php?page=admin/dashboard') ?>">
                <img src="<?= base_url('images/logo.png') ?>" alt="Logo">
            </a>
            <a class="navbar-brand hidden" href="<?= base_url('index.php?page=admin/dashboard') ?>">
                <img src="<?= base_url('images/logo2.png') ?>" alt="Logo">
            </a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?= ($active_menu == 'dashboard') ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php?page=admin/dashboard') ?>"> 
                        <i class="menu-icon fa fa-dashboard"></i> Dashboard 
                    </a>
                </li>
                
                <h3 class="menu-title">Data Master</h3>
                
                <li class="<?= ($active_menu == 'mobil') ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php?page=mobil') ?>"> 
                        <i class="menu-icon fa fa-car"></i> Data Mobil 
                    </a>
                </li>
                <li class="<?= ($active_menu == 'pembeli') ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php?page=pembeli') ?>"> 
                        <i class="menu-icon fa fa-users"></i> Data Pembeli 
                    </a>
                </li>
                <li class="<?= ($active_menu == 'penjual') ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php?page=penjual') ?>"> 
                        <i class="menu-icon fa fa-user-plus"></i> Data Penjual 
                    </a>
                </li>

                <h3 class="menu-title">Transaksi</h3>
                
                <li class="<?= ($active_menu == 'pemesanan') ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php?page=pemesanan') ?>"> 
                        <i class="menu-icon fa fa-shopping-cart"></i> Pemesanan 
                    </a>
                </li>
                <li class="<?= ($active_menu == 'penjualan') ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php?page=penjualan') ?>"> 
                        <i class="menu-icon fa fa-money"></i> Penjualan 
                    </a>
                </li>
                <li class="<?= ($active_menu == 'pembelian') ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php?page=pembelian') ?>"> 
                        <i class="menu-icon fa fa-exchange"></i> Pembelian 
                    </a>
                </li>

                <li class="<?= ($active_menu == 'surat') ? 'active' : '' ?>">
    <a href="<?= base_url('index.php?page=surat') ?>"> 
        <i class="menu-icon fa fa-file-text"></i> Urus Surat
    </a>
</li>
<li class="<?= ($active_menu == 'pengiriman') ? 'active' : '' ?>">
    <a href="<?= base_url('index.php?page=pengiriman') ?>"> 
        <i class="menu-icon fa fa-truck"></i> Pengiriman
    </a>
</li>

                <h3 class="menu-title">Laporan & Setting</h3>
                
                <li class="<?= ($active_menu == 'laporan') ? 'active' : '' ?>">
                    <a href="<?= base_url('index.php?page=laporan') ?>"> 
                        <i class="menu-icon fa fa-file-text"></i> Laporan 
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('logout') ?>"> 
                        <i class="menu-icon fa fa-power-off"></i> Logout 
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>