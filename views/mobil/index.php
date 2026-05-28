<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Mobil - CarPoint</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/themify-icons/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet'>
    
    <style>
        .card-mobil {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 25px;
            background: white;
        }
        .card-mobil:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        .card-mobil .foto-mobil {
            height: 200px;
            overflow: hidden;
            position: relative;
            background: #f5f5f5;
        }
        .card-mobil .foto-mobil img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .card-mobil:hover .foto-mobil img {
            transform: scale(1.05);
        }
        .card-mobil .status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            z-index: 1;
        }
        .status-tersedia { background: #28a745; color: white; }
        .status-dipesan { background: #ffc107; color: #333; }
        .status-terjual { background: #dc3545; color: white; }
        .card-mobil .info-mobil {
            padding: 15px;
        }
        .card-mobil .merk-model {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #333;
        }
        .card-mobil .tahun-warna {
            font-size: 13px;
            color: #777;
            margin-bottom: 10px;
        }
        .card-mobil .harga {
            font-size: 20px;
            font-weight: 700;
            color: #20a8d8;
            margin-bottom: 15px;
        }
        .card-mobil .plat {
            font-size: 12px;
            color: #999;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .btn-group-card {
            display: flex;
            gap: 8px;
        }
        .btn-group-card .btn {
            flex: 1;
            padding: 8px 5px;
            font-size: 13px;
            border-radius: 8px;
        }
        .filter-section {
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .total-mobil {
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
        .btn-tambah {
            background: #20a8d8;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
        }
        .btn-tambah:hover {
            background: #1985ac;
            color: white;
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
                <h4><i class="fa fa-car"></i> Gallery Mobil</h4>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?= base_url('index.php?page=mobil/tambah') ?>" class="btn btn-tambah">
                    <i class="fa fa-plus"></i> Tambah Mobil
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
                    <select id="filterMerk" class="form-control">
                        <option value="all">Semua Merk</option>
                        <?php 
                        $merks = array_unique(array_column($mobil, 'merk'));
                        foreach ($merks as $merk): 
                        ?>
                        <option value="<?= strtolower($merk) ?>"><?= $merk ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="filterStatus" class="form-control">
                        <option value="all">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="dipesan">Dipesan</option>
                        <option value="terjual">Terjual</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button id="resetFilter" class="btn btn-secondary btn-block">
                        <i class="fa fa-refresh"></i> Reset Filter
                    </button>
                </div>
            </div>
            <div class="total-mobil text-right">
                <span id="totalMobil"></span> mobil ditemukan
            </div>
        </div>

        <!-- Grid Mobil -->
        <div class="row" id="mobilGrid">
            <?php foreach ($mobil as $m): ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mobil-item" 
                 data-merk="<?= strtolower($m->merk) ?>"
                 data-status="<?= $m->status ?>">
                <div class="card-mobil">
                    <div class="foto-mobil">
                        <?php if ($m->foto && file_exists($m->foto)): ?>
                            <img src="<?= base_url($m->foto) ?>" alt="<?= $m->merk ?>">
                        <?php else: ?>
                            <img src="<?= base_url('images/no-image.png') ?>" alt="No Image">
                        <?php endif; ?>
                        <span class="status-badge status-<?= $m->status ?>">
                            <?php if ($m->status == 'tersedia'): ?>
                                <i class="fa fa-check"></i> Tersedia
                            <?php elseif ($m->status == 'dipesan'): ?>
                                <i class="fa fa-clock-o"></i> Dipesan
                            <?php else: ?>
                                <i class="fa fa-shopping-cart"></i> Terjual
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="info-mobil">
                        <div class="merk-model">
                            <?= htmlspecialchars($m->merk) ?> <?= htmlspecialchars($m->model) ?>
                        </div>
                        <div class="tahun-warna">
                            <i class="fa fa-calendar"></i> <?= $m->tahun ?> &nbsp;|&nbsp;
                            <i class="fa fa-paint-brush"></i> <?= htmlspecialchars($m->warna) ?>
                        </div>
                        <div class="harga">
                            Rp <?= number_format($m->harga, 0, ',', '.') ?>
                        </div>
                        <div class="plat">
                            <i class="fa fa-credit-card"></i> Plat: <?= htmlspecialchars($m->plat) ?>
                        </div>
                        <div class="btn-group-card">
                            <a href="<?= base_url('index.php?page=mobil/edit&id=' . $m->id_mobil) ?>" 
                               class="btn btn-warning btn-sm" title="Edit">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            <a href="<?= base_url('index.php?page=mobil/hapus&id=' . $m->id_mobil) ?>" 
                               class="btn btn-danger btn-sm" title="Hapus"
                               onclick="return confirm('Yakin hapus data mobil ini?')">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
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
            var total = $('.mobil-item:visible').length;
            $('#totalMobil').text(total);
        }
        
        function filterMobil() {
            var merk = $('#filterMerk').val();
            var status = $('#filterStatus').val();
            
            $('.mobil-item').each(function() {
                var show = true;
                
                if (merk !== 'all' && $(this).data('merk') !== merk) {
                    show = false;
                }
                if (status !== 'all' && $(this).data('status') !== status) {
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
        
        $('#filterMerk, #filterStatus').on('change', function() {
            filterMobil();
        });
        
        $('#resetFilter').click(function() {
            $('#filterMerk').val('all');
            $('#filterStatus').val('all');
            filterMobil();
        });
        
        updateTotal();
    });
</script>
</body>
</html>