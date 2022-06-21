<h1 class="">Selamat Datang di <?php echo $_settings->info('name') ?></h1>
<hr>
<div class="row">

<div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-store"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Jasa</span>
            <span class="info-box-number text-right">
            <?php 
                    echo $conn->query("SELECT * FROM `jasa`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>


    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-spa"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Paket</span>
            <span class="info-box-number text-right">
            <?php 
                    echo $conn->query("SELECT * FROM `paket`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>    

<div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Pemasukan</span>
            <span class="info-box-number text-right">
            <?php 
                    echo $conn->query("SELECT * FROM `kas` where statuskas ='masuk'")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

<div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Pengeluaran</span>
            <span class="info-box-number text-right">
            <?php 
                    echo $conn->query("SELECT * FROM `kas` where statuskas ='keluar'")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>


    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Data Karyawan</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `karyawan`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-navy elevation-1"><i class="fas fa-calendar-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Absensi</span>
            <span class="info-box-number text-right">
            <?php 
                    echo $conn->query("SELECT * FROM `absensi`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <?php if($_settings->userdata('type') == 1): ?>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-teal elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Data Admin</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `admin` where id != 1 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <?php endif; ?>
</div>