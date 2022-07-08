<!doctype html>
<html lang="en">

<head>
    <title>SIAKAD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('login/css/style.css')}}">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        {{-- <div class="img" style="background-image: url({{asset('images/Logo.png')}});"></div> --}}
                    <img src="{{asset('images/logo.png')}}" alt="" style="height: 50%; width: 50%; margin-left: 25%;">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h5 style="text-align: center"><b>Sistem Informasi Akademik E-Rapot</b></h5>
                                <h5 style="text-align: center"><b>MTS Al Fajar Kandat</b></h5>
                            </div>
                        </div>
                        <form action="{{route('postlogin')}}" method="post" class="signin-form">
                            {{ csrf_field() }}
                            <div class="form-group mt-3">
                                <input type="email" name="email" class="form-control" required>
                                <label class="form-control-placeholder" for="Email">Email</label>
                                @error('email')
                                <h6 class="text-danger">{{ $message }}</h6>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" class="form-control" name="password"
                                    required>
                                <label class="form-control-placeholder" for="password">Password</label>
                                @error('password')
                                <h6 class="text-danger">{{ $message }}</h6>
                                @enderror
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                                    In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>;''
        </div>
    </section>

    <script src="{{asset('login/js/jquery.min.js')}}"></script>
    <script src="{{asset('login/js/popper.js')}}"></script>
    <script src="{{asset('login/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('login/js/main.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Email/Password Salah!',
        })

    </script>
    @endif
</body>

</html>
