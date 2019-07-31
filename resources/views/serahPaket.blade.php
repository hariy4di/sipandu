@extends('crudbooster::admin_template') 
@push('head')
    <link rel='stylesheet' href='{{asset("vendor/crudbooster/assets/select2/dist/css/select2.min.css")}}'/>
    <style type="text/css">
        .select2-container--default .select2-selection--single {
            border-radius: 0px !important
        }

        .select2-container .select2-selection--single {
            height: 35px
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #3c8dbc !important;
            border-color: #367fa9 !important;
            color: #fff !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff !important;
        }
    </style>
@endpush
@push('bottom')
    <script src='{{asset("vendor/crudbooster/assets/select2/dist/js/select2.full.min.js")}}'></script>
    @if (App::getLocale() != 'en')
    <script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/datepicker/locales/bootstrap-datepicker.'.App::getLocale().'.js') }}"
            charset="UTF-8"></script>
    @endif
    <script>
        var lang = '{{App::getLocale()}}';
        $(document).ready(function() {
        $('#idUser_pegawai_serah').select2();
        $('.input_date').datepicker({
                format: 'yyyy-mm-dd',
                @if (in_array(App::getLocale(), ['ar', 'fa']))
                rtl: true,
                @endif
                language: lang
            });

            $('.open-datetimepicker').click(function () {
            $(this).next('.input_date').datepicker('show');
            });
    });
    </script>
@endpush

@section('content')
<!-- Your html goes here -->
<div class="panel panel-default">
    <div class="panel-heading"><strong><i class="{{CRUDBooster::getCurrentModule()->icon}}"></i> {!! $page_title or "Page Title" !!}</strong></div>
        <form class="form-horizontal" method="POST" action="{{CRUDBooster::mainpath('edit-save/'.$row->id)}}">
            <div class="panel-body">             
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="wkt_terima" value="{{$row->wkt_terima}}">
                    <input type="hidden" name="idUser_petugas_serah" value="{{CRUDBooster::myId()}}">
                    <input type="hidden" name="idUser_pegawai_terima" value="{{$row->idUser_pegawai_terima}}">
                    <div class="form-group">
                        <label for="detilPaket" class="col-sm-2 control-label">Detil Paket</label>
                        <div class="col-sm-10">
                            <input id="detilPaket" type="text" name="ket_paket" value="{{$row->ket_paket}}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')" class="form-control" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="wkt_serah" class="col-sm-2 control-label">Tanggal Penyerahan</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <?php $date = new Date(now()); ?>
                                <input id="wkt_serah" type="text" name="wkt_serah" value="{{$date->format('Y-m-d')}}" required="" oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')" class="input_date form-control"/>
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="idUser_pegawai_serah" class="col-sm-2 control-label">Diterima Oleh</label>
                        <div class="col-sm-10">
                        <select id="idUser_pegawai_serah" name="idUser_pegawai_serah" class="form-control" required  oninvalid="this.setCustomValidity('Pilih salah satu!')" onchange="setCustomValidity('')">
                                <option value="">** Silahkan Pilih Pegawai Penerima Penyerahan</option>
                                @foreach ($idUser_pegawai_serah as $s)
                                    <option value='{{$s->id}}'>{{$s->name}} - {{$s->direktorat}} - {{$s->no_hp}}</option>
                                @endforeach
                        </select>
                        </div>
                    </div>
                
            <div class="panel-footer">
                <div class="form-group">
                    <label class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                            @if(g('return_url'))
                            <a href='{{g("return_url")}}' class='btn btn-default'><i
                                        class='fa fa-chevron-circle-left'></i> {{trans("crudbooster.button_back")}}</a>
                        @else
                            <a href='{{CRUDBooster::mainpath("?".http_build_query(@$_GET)) }}' class='btn btn-default'><i
                                        class='fa fa-chevron-circle-left'></i> {{trans("crudbooster.button_back")}}</a>
                        @endif
                        <input type="submit" class="btn btn-success" value="Simpan"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection