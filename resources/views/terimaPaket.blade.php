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
        $('.select2').select2();
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
    <div class="panel-heading"></div>
        <form class="form-horizontal" method="POST" action="{{CRUDBooster::mainpath('add-save')}}">
            <div class="panel-body">
                
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="idUser_petugas_terima" value="{{CRUDBooster::myId()}}">
                    <div class="form-group">
                        <label for="detilPaket" class="col-sm-2 control-label">Detil Paket</label>
                        <div class="col-sm-10">
                            <input id="detilPaket" type="text" name="ket_paket" required class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="wkt_terima" class="col-sm-2 control-label">Tanggal Terima</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <?php $date = new Date(now()); ?>
                                <input id="wkt_terima" type="text" name="wkt_terima" value="{{$date->format('Y-m-d')}}" required class="input_date form-control"/>
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="idUser_pegawai_terima" class="col-sm-2 control-label">Pegawai Tujuan</label>
                        <div class="col-sm-10">
                        <select id="idUser_pegawai_terima" name="idUser_pegawai_terima" class="select2 form-control">
                            <option value="">** Silahkan Pilih Pegawai Tujuan</option>
                                @foreach ($idUser_pegawai_terima as $s)
                        <option value="{{$s->id}}">{{$s->name}} - {{$s->direktorat}} - {{$s->no_hp}}</option>
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
                        <input type="submit" name="submit" value='{{trans("crudbooster.button_save_more")}}' class='btn btn-success'>
                        <input type="submit" class="btn btn-success" value="Simpan"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection