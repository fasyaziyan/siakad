@extends('layout.master')
@section('title', 'Siakad | Admin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Tambah Data Admin
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Admin</li>
        </ol>
    </nav>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.store') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input class="form-control" autocomplete="off" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" autocomplete="off" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" autocomplete="off" name="password" value="{{ old('password') }}">
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2 float-right">Submit</button>
        </div>
    </div>
    </form>
</div>
@endsection()
@section('script')
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'D/MM/YYYY',
        toString(date, format) {
            // you should do formatting based on the passed format,
            // but we will just return 'D/M/YYYY' for simplicity
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }
    });

</script>
@endsection
