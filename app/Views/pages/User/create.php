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
                    <a href="#">Buat Pengguna</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Buat Pengguna</div>
                        </div>
                    </div>
                    <?php $errors = session()->getFlashdata('errors') ?>
                    <form action="<?= route_to('users'); ?>" method="POST" autocomplete="off">
                        <div class="card-body">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username" class="text-capitalize">nama pengguna</label>
                                        <input name="username" value="<?= old('username'); ?>" type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : null ?>" id="username" placeholder="Masukkan nama pengguna" />
                                        <div class="invalid-feedback">
                                            <?= isset($errors['username']) ? $errors['username'] : null ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="text-capitalize">email</label>
                                        <input name="email" value="<?= old('email'); ?>" type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : null ?>" id="email" placeholder="Masukkan email pengguna" />
                                        <div class="invalid-feedback">
                                            <?= isset($errors['email']) ? $errors['email'] : null ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password" class="text-capitalize">kata sandi</label>
                                        <input name="password" value="<?= old('password'); ?>" type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : null ?>" id="password" placeholder="Masukkan kata sandi" autocomplete="off" />
                                        <div class="invalid-feedback">
                                            <?= isset($errors['password']) ? $errors['password'] : null ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="confirm_password" class="text-capitalize">konfirmasi kata sandi</label>
                                        <input name="confirm_password" value="<?= old('confirm_password'); ?>" type="password" class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : null ?>" id="confirm_password" placeholder="Ulangi kata sandi" autocomplete="off" />
                                        <div class="invalid-feedback">
                                            <?= isset($errors['confirm_password']) ? $errors['confirm_password'] : null ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Pilih Peran</label>
                                        <select class="form-control <?= isset($errors['group_id']) ? 'is-invalid' : null ?>" name="group_id" id="">
                                            <option value="" disabled selected>Pilih peran</option>
                                            <?php foreach ($auth_groups as $key => $value) :  ?>
                                                <option value="<?= $value->id; ?>" <?= old('group_id') == $value->id ? 'selected' : null ?>><?= $value->name; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= isset($errors['group_id']) ? $errors['group_id'] : null ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a href="<?= route_to('users'); ?>" class="btn btn-label-danger btn-round btn-sm me-2">
                                <span class="btn-label">
                                    <i class="fa fa-window-close"></i>
                                </span>
                                Batal
                            </a>

                            <button type="submit" class="btn btn-label-success btn-round btn-sm me-2">
                                <span class="btn-label">
                                    <i class="fas fa-save"></i>
                                </span>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>