<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Pemesanan - CarPoint</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/themify-icons/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet'>
    
    <style>
        .card-pemesanan {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 25px;
            background: white;
        }
        .card-pemesanan:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        .card-pemesanan .header-card {
            background: #f8f9fa;
            padding: 12px 15px;
            border-bottom: 2px solid #20a8d8;
        }
        .card-pemesanan .kode-pesan {
            font-size: 14px;
            font-weight: 700;
            color: #20a8d8;
        }
        .card-pemesanan .tanggal {
            font-size: 12px;
            color: #999;
        }
        .card-pemesanan .body-card {
            padding: 15px;
        }
        .card-pemesanan .info-pembeli {
            margin-bottom: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .card-pemesanan .nama-pembeli {
            font-size: 16px;
            font-weight: 700;
            color: #333;
        }
        .card-pemesanan .info-mobil {
            margin-bottom: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .card-pemesanan .merk-model {
            font-size: 14px;
            font-weight: 600;
            color: #555;
        }
        .card-pemesanan .harga {
            font-size: 18px;
            font-weight: 700;
            color: #20a8d8;
        }
        .card-pemesanan .batas-dp {
            font-size: 12px;
            color: #ffc107;
        }
        .card-pemesanan .batas-dp-kadaluarsa {
            font-size: 12px;
            color: #dc3545;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }
        .status-booking { background: #ffc107; color: #333; }
        .status-booking_dibayar { background: #17a2b8; color: white; }
        .status-dp_lunas { background: #28a745; color: white; }
        .status-lunas { background: #007bff; color: white; }
        .status-selesai { background: #6c757d; color: white; }
        .status-batal { background: #dc3545; color: white; }
        .btn-group-card {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }
        .btn-group-card .btn {
            flex: 1;
            padding: 6px 5px;
            font-size: 12px;
            border-radius: 8px;
        }
        .filter-section {
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .total-pemesanan {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }
        .header-section {
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
        }
        .info-tambahan {
            font-size: 11px;
            color: #999;
            margin-top: 10px;
            padding-top: 8px;
            border-top: 1px dashed #eee;
        }
    </style>
</head>
<body>

<?php require_once 'views/includes/header.php'; ?>
<?php require_once 'views/includes/sidebar.php'; ?>

<div id="right-panel" class="right-panel">
    <header id="header" class="header">
        <div class="header-menu">
            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            </div>
            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="user-avatar rounded-circle" src="<?= base_url('images/admin.jpg') ?>" alt="User Avatar">
                    </a>
                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="<?= site_url('logout') ?>"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="header-section">
        <div class="row">
            <div class="col-sm-6">
                <h4><i class="fa fa-shopping-cart"></i> Data Pemesanan</h4>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?= base_url('index.php?page=pemesanan/tambah') ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Pemesanan Baru
                </a>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fa fa-check-circle"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fa fa-exclamation-circle"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        <?php endif; ?>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="row">
                <div class="col-md-4">
                    <select id="filterStatus" class="form-control">
                        <option value="all">Semua Status</option>
                        <option value="booking">Booking</option>
                        <option value="booking_dibayar">Booking Dibayar</option>
                        <option value="dp_lunas">DP Lunas</option>
                        <option value="lunas">Lunas</option>
                        <option value="selesai">Selesai</option>
                        <option value="batal">Batal</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" id="searchPembeli" class="form-control" placeholder="Cari nama pembeli...">
                </div>
                <div class="col-md-4">
                    <button id="resetFilter" class="btn btn-secondary btn-block">
                        <i class="fa fa-refresh"></i> Reset Filter
                    </button>
                </div>
            </div>
            <div class="total-pemesanan text-right">
                <span id="totalPemesanan"></span> pemesanan ditemukan
            </div>
        </div>

        <!-- Grid Pemesanan -->
        <div class="row" id="pemesananGrid">
            <?php foreach ($pemesanan as $p): ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 pemesanan-item" 
                 data-status="<?= $p->status_psn ?>"
                 data-nama="<?= strtolower($p->nama_pembeli) ?>">
                <div class="card-pemesanan">
                    <div class="header-card">
                        <div class="row">
                            <div class="col-8">
                                <span class="kode-pesan"><i class="fa fa-ticket"></i> #<?= $p->id_pesan ?></span>
                            </div>
                            <div class="col-4 text-right">
                                <span class="tanggal"><?= date('d/m/Y', strtotime($p->tgl_psn)) ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="body-card">
                        <div class="info-pembeli">
                            <div class="nama-pembeli">
                                <i class="fa fa-user"></i> <?= htmlspecialchars($p->nama_pembeli) ?>
                            </div>
                        </div>
                        <div class="info-mobil">
                            <div class="merk-model">
                                <i class="fa fa-car"></i> <?= htmlspecialchars($p->merk) ?> <?= htmlspecialchars($p->model) ?>
                            </div>
                            <div class="harga mt-1">
                                Rp <?= number_format($p->harga, 0, ',', '.') ?>
                            </div>
                        </div>
                        <div class="batas-dp">
                            <i class="fa fa-clock-o"></i> 
                            Batas DP: <?= date('d/m/Y', strtotime($p->batas)) ?>
                            <?php if (strtotime($p->batas) < time() && $p->status_psn == 'booking_dibayar'): ?>
                                <span class="text-danger">(Kadaluarsa!)</span>
                            <?php endif; ?>
                        </div>
                        <div class="mt-2">
                            <span class="status-badge status-<?= $p->status_psn ?>">
                                <?php if ($p->status_psn == 'booking'): ?>
                                    <i class="fa fa-clock-o"></i> Booking
                                <?php elseif ($p->status_psn == 'booking_dibayar'): ?>
                                    <i class="fa fa-check"></i> Booking Dibayar
                                <?php elseif ($p->status_psn == 'dp_lunas'): ?>
                                    <i class="fa fa-money"></i> DP Lunas
                                <?php elseif ($p->status_psn == 'lunas'): ?>
                                    <i class="fa fa-credit-card"></i> Lunas
                                <?php elseif ($p->status_psn == 'selesai'): ?>
                                    <i class="fa fa-flag-checkered"></i> Selesai
                                <?php elseif ($p->status_psn == 'batal'): ?>
                                    <i class="fa fa-trash"></i> Batal
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="btn-group-card">
                            <?php if ($p->status_psn == 'booking'): ?>
                                <a href="<?= base_url('index.php?page=pemesanan/bayar-booking&id=' . $p->id_pesan) ?>" 
                                   class="btn btn-primary btn-sm" title="Bayar Booking">
                                    <i class="fa fa-money"></i> Bayar Booking
                                </a>
                                <a href="<?= base_url('index.php?page=pemesanan/batal&id=' . $p->id_pesan) ?>" 
                                   class="btn btn-danger btn-sm" title="Batal"
                                   onclick="return confirm('Yakin batalkan pesanan?')">
                                    <i class="fa fa-trash"></i> Batal
                                </a>
                            <?php elseif ($p->status_psn == 'booking_dibayar'): ?>
                                <button class="btn btn-warning btn-sm" disabled>
                                    <i class="fa fa-credit-card"></i> Bayar DP
                                </button>
                                <a href="<?= base_url('index.php?page=pemesanan/cetak&id=' . $p->id_pesan) ?>" 
                                   class="btn btn-secondary btn-sm" target="_blank">
                                    <i class="fa fa-print"></i> Cetak
                                </a>
                            <?php elseif ($p->status_psn == 'dp_lunas' || $p->status_psn == 'lunas'): ?>
                                <button class="btn btn-success btn-sm" disabled>
                                    <i class="fa fa-check"></i> Proses STNK
                                </button>
                                <a href="<?= base_url('index.php?page=pemesanan/cetak&id=' . $p->id_pesan) ?>" 
                                   class="btn btn-secondary btn-sm" target="_blank">
                                    <i class="fa fa-print"></i> Cetak
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('index.php?page=pemesanan/cetak&id=' . $p->id_pesan) ?>" 
                                   class="btn btn-secondary btn-sm" target="_blank">
                                    <i class="fa fa-print"></i> Cetak
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="info-tambahan">
                            <i class="fa fa-info-circle"></i> 
                            DP 30%: Rp <?= number_format($p->harga * 0.3, 0, ',', '.') ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once 'views/includes/footer.php'; ?>

<script src="<?= base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        function updateTotal() {
            var total = $('.pemesanan-item:visible').length;
            $('#totalPemesanan').text(total);
        }
        
        function filterPemesanan() {
            var status = $('#filterStatus').val();
            var search = $('#searchPembeli').val().toLowerCase();
            
            $('.pemesanan-item').each(function() {
                var show = true;
                
                if (status !== 'all' && $(this).data('status') !== status) {
                    show = false;
                }
                if (search !== '' && $(this).data('nama').indexOf(search) === -1) {
                    show = false;
                }
                
                if (show) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            
            updateTotal();
        }
        
        $('#filterStatus, #searchPembeli').on('change keyup', function() {
            filterPemesanan();
        });
        
        $('#resetFilter').click(function() {
            $('#filterStatus').val('all');
            $('#searchPembeli').val('');
            filterPemesanan();
        });
        
        updateTotal();
    });
</script>
</body>
</html>