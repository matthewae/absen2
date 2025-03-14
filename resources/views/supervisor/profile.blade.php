@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Name</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $supervisor->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Department</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $supervisor->department }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Phone Number</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $supervisor->phone_number ?? 'Not set' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $supervisor->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection