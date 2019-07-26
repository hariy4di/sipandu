@extends('crudbooster::admin_template') 
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
    </div>
    <div class="panel-body">
            <div class="form-group col-sm-12">
                    <label for="idPaket" class="col-sm-2-pull col-md-2 control-label">ID Paket</label>
                    <div class="col-sm-10-push col-md-10">
                        <h1 id="idPaket">{{$row->id}}</h1>
                    </div>
            </div>
            <div class="form-group col-sm-12">
                    <label for="detilPaket" class="col-sm-2-pull col-md-2 control-label">Detil Paket</label>
                    <div class="col-sm-10-push col-md-10">
                        <span id="detilPaket" class="form-control">{{$row->ket_paket}}</span>
                    </div>
            </div>
            <div class="form-group col-sm-12">
                        <label for="tglTerimaPaket" class="col-sm-2-pull col-md-2 control-label">Tgl. Terima Paket</label>
                        <div class="col-sm-4-push col-md-4 ">
                            <?php 
                                $date=new Date($row->wkt_terima);
                                
                                ?>
                            <span id="tglTerimaPaket" class="form-control">{{$date->format('d-m-Y')}}</span>
                        </div>

                <label for="tglSerah" class="col-sm-2-pull col-md-2 control-label">Tgl. Penyerahan</label>
                <div class="col-sm-4-push col-md-4">
                    <?php 
                    if(empty($row->wkt_serah)){
                        $date2="";
                    }
                    else {
                        $date2=(new Date($row->wkt_serah))->format('d-m-Y');
                    }
                                
                    ?>
                    <span id="tglSerah" class="form-control">{{$date2}}</span>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label for="namaPetugasPenerima" class="col-sm-2-pull col-md-2 control-label">Petugas Penerima</label>
                <div class="col-sm-4-push col-md-4">
                    <span id="namaPetugasPenerima" class="form-control">{{DB::table('users')->where('id',$row->idUser_petugas_terima)->value('name')}}</span>
                </div>

                <label for="namaPetugasSerah" class="col-sm-2-pull col-md-2 control-label">Petugas yang Menyerahkan</label>
                <div class="col-sm-4-push col-md-4">
                    <span id="namaPetugasSerah" class="form-control">{{DB::table('users')->where('id',$row->idUser_petugas_serah)->value('name')}}</span>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label for="namaPenerima" class="col-sm-2-pull col-md-2 control-label">Dikirim untuk</label>
                <div class="col-sm-4-push col-md-4">
                    <span id="namaPenerima" class="form-control">{{DB::table('users')->where('id',$row->idUser_pegawai_terima)->value('name')}}</span>
                </div>
                <label for="namaSerah" class="col-sm-2-pull col-md-2 control-label">Diserahkan kepada</label>
                <div class="col-sm-4-push col-md-4">
                    <span id="namaSerah" class="form-control">{{DB::table('users')->where('id',$row->idUser_pegawai_serah)->value('name')}}</span>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label for="unitPenerima" class="col-sm-2-pull col-md-2 control-label">Unit Pegawai Tujuan</label>
                <div class="col-sm-4-push col-md-4">
                    <span id="unitPenerima" class="form-control">{{DB::table('users')->leftjoin('unit','users.idunit','=','unit.id')->where('users.id',$row->idUser_pegawai_terima)->value('unit.direktorat')}}</span>
                </div>
                <label for="unitPenerima" class="col-sm-2-pull col-md-2 control-label">Unit Pegawai Penerima</label>
                <div class="col-sm-4-push col-md-4">
                    <span id="unitPenerima" class="form-control">{{DB::table('users')->leftjoin('unit','users.idunit','=','unit.id')->where('users.id',$row->idUser_pegawai_serah)->value('unit.direktorat')}}</span>
                </div>
            </div>         
    </div>
    <div class="panel-footer">
            @if(g('return_url'))
            <a href='{{g("return_url")}}' class='btn btn-default'><i
                        class='fa fa-chevron-circle-left'></i> {{trans("crudbooster.button_back")}}</a>
        @else
            <a href='{{CRUDBooster::mainpath("?".http_build_query(@$_GET)) }}' class='btn btn-default'><i
                        class='fa fa-chevron-circle-left'></i> {{trans("crudbooster.button_back")}}</a>
        @endif
    </div>
</div>
    
@endsection