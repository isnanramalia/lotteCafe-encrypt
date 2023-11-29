<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lupa Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" href="../assets/images/cafe/coffee.ico">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/login/fonts/fontawesome-free/css/all.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/login/css/sb-admin-2.min.css">
    <!--===============================================================================================-->
</head>

<style>
    body {
        background-image: url("../assets/images/cafe/bg-login.svg");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

<body>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-4">
                                    <div class="text-center">
                                        <p class="h4 text-dark">Lupa Password?</p>
                                    </div>

                                    <?php if (isset($_GET['msg'])) {
                                        $msg = $_GET['msg'];
                                        if ($msg == 1) {
                                    ?>
                                            <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Autentikasi Gagal!</div>
                                        <?php
                                        } else if ($msg == 2) {
                                        ?>
                                            <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Error Database!</div>
                                        <?php
                                        } else if ($msg == 3) {
                                        ?>
                                            <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Username tidak ditemukan!</div>
                                        <?php
                                        } else if ($msg == 4) {
                                        ?>
                                            <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Password yang anda masukkan tidak sama!</div>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <hr>
                                    <form class="user" method="post" action="cek_data.php">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Masukkan Username" required oninvalid="this.setCustomValidity('Silahkan masukkan username')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="input-group">
                                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" maxlength="15" placeholder="Masukkan password" required oninvalid="this.setCustomValidity('Silahkan isi password')" oninput="setCustomValidity('')">
                                                    <div class="input-group-append">
                                                        <span id="eye-button" onclick="change()" class="input-group-text">
                                                            <i class="fas fa-fw fa-eye" title="tampilkan password"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi password" required oninvalid="this.setCustomValidity('Silahkan ulangi password')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-user btn-block" name="btn_ubah">
                                            <strong>Ubah Password</strong>
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="../index.php">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Show Password -->
    <script type="text/javascript">
        function change() {
            var x = document.getElementById('password1').type;
            if (x == 'password') {
                document.getElementById('password1').type = 'text';
                document.getElementById('eye-button').innerHTML = `<i class="fas fa-fw fa-eye-slash" title="sembunyikan password"></i>`;
            } else {
                document.getElementById('password1').type = 'password';
                document.getElementById('eye-button').innerHTML = `<i class="fas fa-fw fa-eye" title="tampilkan password"></i>`;
            }
        }
    </script>

</body>

</html>