<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login - Amora Food</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body class="login-body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-white border-0 text-center pt-4">
                        <h3 class="font-weight-light my-2 text-primary fw-bold">Amora Food</h3>
                        <p class="text-muted small">Sistem Inventori Barang</p>
                    </div>
                    <div class="card-body px-5 pb-5">
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger small"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>
                        
                        <form action="/auth/login" method="post">
                            <?= csrf_field() ?>
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="inputUser" placeholder="Username" required>
                                <label for="inputUser">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="inputPass" placeholder="Password" required>
                                <label for="inputPass">Password</label>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button class="btn btn-primary btn-lg" type="submit">Sign In</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3 bg-light">
                        <div class="small"><a href="/" class="text-decoration-none">Kembali ke Katalog Publik</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>