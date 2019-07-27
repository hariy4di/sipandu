<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@push('bottom')
<script>
$(document).ready(function() {
    $('#table').DataTable({
    language: 
    {
    sEmptyTable:   "Tidak ada data yang tersedia pada tabel ini",
    sProcessing:   "Sedang memproses...",
    sLengthMenu:   "Tampilkan _MENU_ entri",
    sZeroRecords:  "Tidak ditemukan data yang sesuai",
    sInfo:         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
    sInfoEmpty:    "Menampilkan 0 sampai 0 dari 0 entri",
    sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
    sInfoPostFix:  "",
    sSearch:       "Cari:",
    sUrl:          "",
    oPaginate: {
        sFirst:    "Pertama",
        sPrevious: "Sebelumnya",
        sNext:     "Selanjutnya",
        sLast:     "Terakhir"
    }
  }
});
} );
</script>
@endpush
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
      <h1><i class="fa fa-dropbox"></i> {!! $page_title or "Page Title" !!}</h1>
  </div>
  <div class="panel-body">
      <table id="table" class="table table-striped table-hover" style="width:100%" data-page-length="25" data-order="[[ 0, &quot;desc&quot; ]]">
    <thead>
      <tr>
        <th>ID Paket</th>
        <th>Detil Paket</th>
        @if ($isunit == 1)
          <th>Tujuan</th> 
        @endif
        <th>Tgl. Sampai</th>
        <th>Petugas Penerima</th>
        <th>Aksi dan Status</th>

       </tr>
    </thead>
    <tbody>
      @foreach($result as $row)
      <tr>
          @if(empty($row->id02))
        <td class="lead text-success">{{$row->id}}</td>
        @endif
        @if($row->id02)
        <td class="lead text-success">{{$row->id02}}</td>
        @endif
        <td>{{$row->ket_paket}}</td>
        @if ($row->id02)
          <td>{{DB::table('users')->where('id',$row->idUser_pegawai_terima)->value('name')}}</td>  
        @endif
        <?php 
            $date = new Date($row->wkt_terima);
        ?>
        <td>{{$date->format('d-m-Y')}}</td>
        <td>{{DB::table('users')->where('id',$row->idUser_petugas_terima)->value('name')}}</td>
        <td style="width:18%">
          <!-- To make sure we have read access, wee need to validate the privilege -->
          @if(empty($row->id02))
          <a class='btn btn-primary btn-sm' href='{{CRUDBooster::mainpath("detail/$row->id")}}'><i class="fa fa-eye"></i> Detil</a>
          @endif
          @if($row->id02)
          <a class='btn btn-primary btn-sm' href='{{CRUDBooster::mainpath("detail/$row->id02")}}'><i class="fa fa-eye"></i> Detil</a>
          @endif
          @if($row->idUser_pegawai_serah)
          <i class="fa fa-check text-success"> Sudah Diserahkan</i>
          @endif
          @if (empty($row->idUser_pegawai_serah))
          <i class="fa fa-times text-danger"> Belum Diserahkan</i>
          @endif
          
        </td>
       </tr>
      @endforeach
    </tbody>
    </table>
  </div>
</div>
</div>
@endsection