<!-- load my template -->
<?= $this->extend('templates/app'); ?>

<!-- show my content -->
<?= $this->section('content'); ?>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Pengguna</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Pengguna</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Daftar Pengguna</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Daftar Pengguna</div>
                            <div class="card-tools d-flex align-items-center">
                                <?php $request = \Config\Services::request(); ?>
                                <form action="" method="get" autocomplete="off" class="d-flex align-items-center me-2">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="keyword" value="<?= $request->getGet('keyword'); ?>" class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <a href="<?= route_to('users/new'); ?>" class="btn btn-label-success btn-round btn-sm me-2">
                                    <span class="btn-label">
                                        <i class="fa fa-user-plus"></i>
                                    </span>
                                    Tambah
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('success')) :  ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Sukses!</strong> <?= session()->getFlashdata('success'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('errors')) :  ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> <?= session()->getFlashdata('errors'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase">no</th>
                                        <th class="text-uppercase">username</th>
                                        <th class="text-uppercase">email</th>
                                        <th class="text-uppercase text-center">aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($users)) : ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    <?php endif ?>

                                    <?php
                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $no = 1 + (5 * ($page - 1));
                                    foreach ($users as $key => $value) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $value->username ?></td>
                                            <td><?= $value->email ?></td>
                                            <td class="text-center" style="width: 15%;">
                                                <div class="d-inline-flex gap-1">
                                                    <a href="<?= route_to('users/(.*)/edit', $value->id); ?>" class="btn btn-label-warning btn-sm">
                                                        <span class="btn-label"><i class="fa fa-edit"></i></span>
                                                    </a>
                                                    <button type="button" class="btn btn-label-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-delete-user-<?= $value->id ?>">
                                                        <span class="btn-label"><i class="fa fa-trash"></i></span>
                                                    </button>
                                                    <div class="modal fade" id="modal-delete-user-<?= $value->id ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="<?= site_url('users/' . $value->id); ?>" method="post">
                                                                    <?= csrf_field(); ?>
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Izin</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="text-start"> Yakin anda menghapus data <strong><?= $value->username ?></strong> ?</p>
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <i>Menampilkan <?= 1 + (5 * ($page - 1)); ?> hingga <?= $no - 1; ?> dari <?= $pager->getTotal(); ?> entri </i>
                        </div>
                        <div>
                            <?= $pager->links('default', 'pagination'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>