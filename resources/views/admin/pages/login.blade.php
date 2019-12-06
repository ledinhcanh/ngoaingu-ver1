<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Đăng nhập</title>
  <base href="{{ asset('') }}">
  <!-- Custom fonts for this template-->
  <link href="assets/admin/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> --}}
  <link href="assets/admin/css/nunito.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/admin/css/toastr.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
    integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> --}}
              <div class="col-md-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">KHOA NGOẠI NGỮ</h1>
                  </div>
                  <form class="user" action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" name="name" class="form-control input_user" placeholder="username">
                    </div>
                    <div class="input-group mb-2">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                      </div>
                      <input type="password" name="password" class="form-control input_pass"
                        placeholder="password">
                    </div>
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="submit" class="btn btn-primary btn-user btn-block" style="margin-top: 37px;">Đăng nhập</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/admin/js/sb-admin-2.min.js"></script>
  <script src="assets/admin/js/toastr.min.js"></script>
  <script src="assets/admin/js/ajax.js"></script>
  @if (session('thongbao'))
  <script>
    toastr.options.progressBar = true;
      toastr.success('{{ session('thongbao') }}','Thông báo!', {timeOut: 2000});
  }
  </script>
  @endif
  @if (session('error'))
  <script>
    toastr.options.progressBar = true;
      toastr.error('{{ session('error') }}','Thông báo!', {timeOut: 2000});
  </script>
  @endif
</body>

</html>