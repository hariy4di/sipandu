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
      {{-- <h1><i class="fa fa-truck"></i> {!! $page_title or "Page Title" !!}</h1> --}}
      <a class="btn btn-primary btn-lg" href="{{CRUDBooster::mainpath('add')}}"><i class="fa fa-truck"></i> Terima Paket</a>
  </div>
  <div class="panel-body">
      <table id="table" class="table table-striped table-hover" style="width:100%" data-page-length="25" data-order="[[ 0, &quot;desc&quot; ]]">
    <thead>
      <tr>
        <th>ID Paket</th>
        <th>Detil Paket</th>
        <th>Pegawai Tujuan</th>
        <th>Unit</th>
        <th>Aksi</th>
       </tr>
    </thead>
    <tbody>
      @foreach($result as $row)
      <tr>
        <td class="lead text-success">{{DB::table('users')->where('id',$row->idUser_pegawai_terima)->value('idunit')}}-{{$row->id}}</td>
        <td>{{$row->ket_paket}}</td>
        <td>{{DB::table('users')->where('id',$row->idUser_pegawai_terima)->value('name')}}</td>
        <td>{{DB::table('users')->join('unit','users.idunit','=','unit.id')->where('users.id',$row->idUser_pegawai_terima)->value('unit.direktorat')}}</td>
        <td style="width:10%">
          
          <!-- To make sure we have read access, wee need to validate the privilege -->

          <a class='btn btn-primary btn-sm' href='{{CRUDBooster::mainpath("detail/$row->id")}}' data-toggle="tooltip" data-placement="bottom" title="Detil"><i class="fa fa-eye"></i></a>

          @if(CRUDBooster::isUpdate() && $button_edit && empty($row->idUser_petugas_serah))

          <a class='btn btn-success btn-sm' href='{{CRUDBooster::mainpath("edit/$row->id")}}' data-toggle="tooltip" data-placement="bottom" title="Penyerahan"><i class="glyphicon glyphicon-share-alt"></i></a>

          @endif
          
          @if(CRUDBooster::isDelete() && $button_edit && empty($row->idUser_pegawai_serah))

          <a class='btn btn-danger btn-sm' href='#' onclick='{{CRUDBooster::deleteConfirm(CRUDBooster::mainpath("delete/$row->id"))}}' data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>

          @endif

          @if($row->idUser_pegawai_serah)

          <i class="glyphicon glyphicon-ok-sign text-success" data-toggle="tooltip" data-placement="bottom" title="Sudah Diserahkan"></i>

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