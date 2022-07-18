@extends('layout.master')
@section('title', 'Siakad | Kurikulum')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Tambah Data Kurikulum
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Kurikulum</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Kurikulum</li>
        </ol>
    </nav>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kurikulum.store') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Tahun Ajaran</label>
                          <div class="row">
                            <div class="col-md-4">
                                <input class="form-control" autocomplete="off" name="tahun_ajaran1" value="{{ old('tahun_ajaran1') }}">
                                @error('tahun_ajaran1')
                                    <h6 class="text-danger">{{ $message }}</h6>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <h5 style="margin-top:10px">/</h5>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" autocomplete="off" name="tahun_ajaran2" value="{{ old('tahun_ajaran2') }}">
                                @error('tahun_ajaran2')
                                    <h6 class="text-danger">{{ $message }}</h6>
                                @enderror
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Semester</label>
                          <select class="form-control" name="semester">
                            <option disabled selected>Pilih Semester</option>
                            <option value="Ganjil" {{ old('semester') == "Ganjil" ? 'selected' : ''}}>Semester Ganjil (I)</option>
                            <option value="Genap" {{ old('semseter') == "Genap" ? 'selected' : ''}}>Semester Genap (II)</option>
                          </select>
                      </div>
                  </div>
              </div>
                <button type="submit" class="btn btn-gradient-primary mr-2 float-right">Submit</button>
        </div>
    </div>
    </form>
</div>
@endsection
