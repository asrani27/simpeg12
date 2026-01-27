@extends('layouts.app')

@push('css')

@endpush
@section('title')
    UBAH PASSWORD
@endsection
@section('content')
<br/>
<div class="row">
    <div class="col-12">
<form method="post" action="/kepangkatan/gantipass">
    @csrf
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-body">  
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Password Baru</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="password1" required>
                    </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Masukkan Password lagi</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="password2" required>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-block btn-primary"><strong>UPDATE</strong></button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    </div>
</div>

@endsection

@push('js')
@endpush