@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endpush
@section('title')
Beranda
@endsection
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-secondary">
          <h3 class="card-title">PILIH PEJABAT PENANDA TANGAN</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <form method="post" action="/kepangkatan/berkala/editpejabat">
                @csrf
                <select class="form-control" name="pegawai_id">
                    <option value="">-pilih-</option>
                    @foreach ($pegawai as $item)
                    <option value="{{$item->id}}" {{$ttd->id == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                    @endforeach
                </select><br/>
                <button type="submit" class="btn btn-block btn-info">update</button>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
</div>

<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="/kepangkatan/berkala/ditolak" enctype="multipart/form-data">
            @csrf
        <div class="modal-header bg-gradient-danger" style="padding:10px">
            <h4 class="modal-title text-sm">Isi Alasan / Keterangan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="keterangan_tolak" class="form-control"></textarea>
            <input type="hidden" id="berkala_id" name="berkala_id">
        </div>
        
        <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-block btn-danger"><i class="fas fa-paper-plane"></i> Kirim</button>
        </div>
        </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).on('click', '.kembalikan', function() {
   $('#berkala_id').val($(this).data('id'));
   $("#modal-default").modal();
});
</script>
@endpush