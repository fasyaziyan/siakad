@extends('layout.master')
@section('title', 'Siakad | Change Password')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Ganti Password
    </h3>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <livewire:guru-change-password>
        </div>
    </div>
</div>
@endsection