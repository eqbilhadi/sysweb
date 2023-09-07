<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover" data-sidebar-image="none" data-preloader="disable">
<style>
  body {
    overflow-y: hidden;
  }

  .auth-one-bg {
    background-image: url(<?= base_url() ?>assets/images/auth-one-bg.jpg);
    background-position: center;
    background-size: cover;
  }
</style>

<head>
  <meta charset="utf-8" />
  <title><?= $data->head_title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="Themesbrand" name="author" />

  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico">
  <link href="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <script src="<?= base_url() ?>assets/js/layout.js"></script>
  <script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>assets/js/pages/sweetalerts.init.js"></script>
  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />
</head>

<body>


  <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <div class="auth-page-content overflow-hidden">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card overflow-hidden">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="p-lg-5 p-4 auth-one-bg h-100">
                    <div class="bg-overlay"></div>
                    <div class="position-relative h-100 d-flex flex-column">
                      <div class="mb-4">
                        <a href="index.html" class="d-block">
                          <img src="<?= base_url() ?>assets/images/logo-light.png" alt="" height="18">
                        </a>
                      </div>

                    </div>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="p-lg-5 p-4">
                    <div>
                      <h5 class="text-primary"><?= $data->title ?></h5>
                      <p class="text-muted"><?= $data->subtitle ?></p>
                    </div>
                    <div class="mt-4">
                      <form action="#" id="formData" method="POST">
                        <div class="mb-3">
                          <label for="username" class="form-label">Username</label>
                          <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" autofocus>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="password-input">Password</label>
                          <div class="position-relative auth-pass-inputgroup mb-3">
                            <input type="password" class="form-control pe-5 password-input" name="password" placeholder="Enter password" id="password-input">
                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                          </div>
                        </div>
                        <div class="mt-4">
                          <button class="btn btn-success w-100 btn-login" onclick="login()">Sign In</button>
                        </div>
                      </form>
                    </div>

                    <div class="mt-5 text-center">
                      <p class="mb-0">Don't have an account ? <a href="auth-signup-cover.html" class="fw-semibold text-primary text-decoration-underline"> Signup</a> </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer start-0">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center">
              <p class="mb-0">&copy;
                <script>
                  document.write(new Date().getFullYear())
                </script> <?= $data->footer ?> <i class="mdi mdi-heart text-danger"></i> <?= $data->by ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>



  <script src="<?= base_url() ?>assets/libs/jquery/jquery-3.6.0.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/node-waves/waves.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/feather-icons/feather.min.js"></script>
  <script src="<?= base_url() ?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins.js"></script>


  <script src="<?= base_url() ?>assets/js/pages/password-addon.init.js"></script>
</body>

</html>
<script>
  <?php include APPPATH . 'views/auth/js/index.js'; ?>
</script>