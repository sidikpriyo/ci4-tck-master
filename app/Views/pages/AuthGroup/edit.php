<!-- load my template -->
<?= $this->extend('templates/app'); ?>

<!-- show my content -->
<?= $this->section('content'); ?>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Peran</h3>
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
                    <a href="#">Peran</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Ubah Peran</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Ubah Peran</div>
                        </div>
                    </div>
                    <?php $errors = session()->getFlashdata('errors') ?>
                    <form action="<?= route_to(' auth-groups/(.*)' . $auth_group->id); ?>" method="POST" autocomplete="off">
                        <div class="card-body">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PATCH" id="">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="name" class="text-capitalize">nama peran</label>
                                        <input name="name" value="<?= old('name', $auth_group->name); ?>" type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : null ?>" id="name" placeholder="Masukkan nama peran" />
                                        <div class="invalid-feedback">
                                            <?= isset($errors['name']) ? $errors['name'] : null ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-8">
                                    <div class="form-group">
                                        <label for="description" class="text-capitalize">deskripsi</label>
                                        <textarea name="description" id="description" class="form-control <?= isset($errors['description']) ? 'is-invalid' : null ?>" rows="3" placeholder="Masukkan deskripsi"><?= old('description', $auth_group->description); ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= isset($errors['description']) ? $errors['description'] : null ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Pilih Izin</label>
                                        <div class="selectgroup selectgroup-pills">
                                            <?php foreach ($auth_permissions as $key => $value) :  ?>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="permission_id[]" value="<?= $value->id; ?>" class="selectgroup-input" <?= in_array($value->id, $selected_permissions) ? 'checked' : '' ?> />
                                                    <span class="selectgroup-button"><?= $value->name; ?></span>
                                                </label>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a href="<?= route_to('auth-groups'); ?>" class="btn btn-label-danger btn-round btn-sm me-2">
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