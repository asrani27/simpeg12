@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('title')
    AJUKAN KEPANGKATAN
@endsection
@section('content')
<a href="/kepangkatan/pangkat" class="btn btn-sm bg-gradient-purple"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a><br/><br/>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$pegawai->nip}}" readonly>
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$pegawai->nama}}" readonly>
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">PANGKAT/GOLONGAN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$pegawai->nm_pangkat}}" readonly>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-sm table-bordered">
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>JENJANG</th>
                    <th>RINCIAN BERKAS USUL KENAIKAN PANGKAT</th>
                    <th>PENAMAAN FILE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td rowspan="7">1</td>    
                        <td rowspan="7">STRUKTURAL</td>
                        <td></td>  
                        <td></td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Pangkat Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_skkp}}" target="_blank">{{$pangkat->struktural_skkp}}</a></strong></td>  

                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK jabatan mulai awal promosi s.d Jabatan Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_sklantik}}" target="_blank">{{$pangkat->struktural_sklantik}}</a></strong></td>  
                      
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SKP dan DP3 2 tahun Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_skp2thn}}" target="_blank">{{$pangkat->struktural_skp2thn}}</a></strong></td>  
                          
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK Tugas Belajar (Bagi Yang mencantumkan gelar)</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_sktubel}}" target="_blank">{{$pangkat->struktural_sktubel}}</a></strong></td>  
                          
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Izin Belajar (Bagi Yang mencantumkan gelar)</td> 
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_skiznbel}}" target="_blank">{{$pangkat->struktural_skiznbel}}</a></strong></td>  
                         
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi Ijazah dan Transkrip pendidikan terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_ijzakhir}}" target="_blank">{{$pangkat->struktural_ijzakhir}}</a></strong></td>  
                         
                    </tr>

                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td rowspan="11">2</td>    
                        <td rowspan="11">JABATAN FUNGSIONAL TERTENTU</td>
                        <td></td>  
                        <td></td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Pangkat Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_skkp}}" target="_blank">{{$pangkat->jft_skkp}}</a></td>  
                          
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Asli PAK lanjutan dari PAK Terakhir</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_pak}}" target="_blank">{{$pangkat->jft_pak}}</a></strong></td>  
                          
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi Sertifikat Uji Kompetensi (Bagi yang naik jenjang)</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_serdiklat}}" target="_blank">{{$pangkat->jft_serdiklat}}</a></strong></td>  
                     
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK kenaikan jabatan  Fungsional (Bagi yang naik jenjang)</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_sknaikjab}}" target="_blank">{{$pangkat->jft_sknaikjab}}</a></strong></td>  
                        
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SKP dan DP3 2 tahun Terakhir</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_skp2thn}}" target="_blank">{{$pangkat->jft_skp2thn}}</a></strong></td>  
                          
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi Ijazah dan Transkrip pendidikan terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_ijzakhir}}" target="_blank">{{$pangkat->jft_ijzakhir}}</a></strong></td>  
                        
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK pembebasan JFT *</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_skhentijf}}" target="_blank">{{$pangkat->jft_skhentijf}}</a></strong></td>  
                          
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK Pengembalian dalam jabatan*</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_skjfkembali}}" target="_blank">{{$pangkat->jft_skjfkembali}}</a></strong></td>  
                          
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK Tugas Belajar (Bagi Yang mencantumkan gelar)</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_sktubel}}" target="_blank">{{$pangkat->jft_sktubel}}</a></strong></td>  
                          
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Izin Belajar (Bagi Yang mencantumkan gelar)</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_skiznbel}}" target="_blank">{{$pangkat->jft_skiznbel}}</a></strong></td>  
                          
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td rowspan="6">3</td>    
                        <td rowspan="6">REGULAR (KPO)</td>
                        <td></td>  
                        <td></td>
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Pangkat Terakhir</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/reguler/{{$pangkat->id}}/{{$pangkat->reguler_skkp}}" target="_blank">{{$pangkat->reguler_skkp}}</a></strong></td>  
                    
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SKP dan DP3 2 tahun Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/reguler/{{$pangkat->id}}/{{$pangkat->reguler_skp2thn}}" target="_blank">{{$pangkat->reguler_skp2thn}}</a></strong></td>  
                        
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK Tugas Belajar (Bagi Yang mencantumkan gelar)</td>
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/reguler/{{$pangkat->id}}/{{$pangkat->reguler_sktubel}}" target="_blank">{{$pangkat->reguler_sktubel}}</a></strong></td>  
                         
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Izin Belajar (Bagi Yang mencantumkan gelar)</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/reguler/{{$pangkat->id}}/{{$pangkat->reguler_skiznbel}}" target="_blank">{{$pangkat->reguler_skiznbel}}</a></strong></td>  
                         
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi Ijazah dan Transkrip pendidikan terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/reguler/{{$pangkat->id}}/{{$pangkat->reguler_ijzakhir}}" target="_blank">{{$pangkat->reguler_ijzakhir}}</a></strong></td>  
                         
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td rowspan="5"></td>    
                        <td rowspan="5">CATATAN :</td>
                        <td></td>  
                        <td></td> 
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td colspan=3>File wajib dalam bentuk PDF dengan maksimal ukuran 2 MB per file</td>
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td colspan=3>Penamaan File wajib sesuai table</td>
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td colspan=3>Berkas fotocopy wajib di legalisir</td>
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td colspan=3>Yang bertanda * bersifat opsional</td>
                    </tr>
                </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

<!-- Select2 -->
<script src="/theme/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
</script>  
@endpush