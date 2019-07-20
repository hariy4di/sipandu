@extends('crudbooster::admin_template')
@section('content')


    @if($button_show_data || $button_reload_data || $button_new_data || $button_delete_data || $index_button || $columns)
        <div id='box-actionmenu' class='box'>
            <div class='box-body'>
                @include("crudbooster::default.actionmenu")
            </div>
        </div>
    @endif


    @if(Request::get('file') && Request::get('import'))

        <ul class='nav nav-tabs'>
            <li style="background:#eeeeee"><a style="color:#111"
                                              onclick="if(confirm('Yakin ingin pergi ?')) location.href='{{ CRUDBooster::mainpath("import-data") }}'"
                                              href='javascript:;'><i class='fa fa-download'></i> Unggah File &raquo;</a></li>
            <li style="background:#eeeeee"><a style="color:#111" href='#'><i class='fa fa-cogs'></i> Pengaturan &raquo;</a></li>
            <li style="background:#ffffff" class='active'><a style="color:#111" href='#'><i class='fa fa-cloud-download'></i> Sedang mengimpor &raquo;</a></li>
        </ul>

        <!-- Box -->
        <div id='box_main' class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sedang mengimpor</h3>
                <div class="box-tools">
                </div>
            </div>

            <div class="box-body">

                <p style='font-weight: bold' id='status-import'><i class='fa fa-spin fa-spinner'></i> Mohon tunggu, sedang mengimpor...</p>
                <div class="progress">
                    <div id='progress-import' class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40"
                         aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        <span class="sr-only">40% Komplit (sukses)</span>
                    </div>
                </div>

                @push('bottom')
                    <script type="text/javascript">
                        $(function () {
                            var total = {{ intval(Session::get('total_data_import')) }};

                            var int_prog = setInterval(function () {

                                $.post("{{ CRUDBooster::mainpath('do-import-chunk?file='.Request::get('file')) }}", {resume: 1}, function (resp) {
                                    console.log(resp.progress);
                                    $('#progress-import').css('width', resp.progress + '%');
                                    $('#status-import').html("<i class='fa fa-spin fa-spinner'></i> Mohon tunggu, sedang mengimpor... (" + resp.progress + "%)");
                                    $('#progress-import').attr('aria-valuenow', resp.progress);
                                    if (resp.progress >= 100) {
                                        $('#status-import').addClass('text-success').html("<i class='fa fa-check-square-o'></i> Impor Data Lengkap !");
                                        clearInterval(int_prog);
                                    }
                                })


                            }, 2500);

                            $.post("{{ CRUDBooster::mainpath('do-import-chunk').'?file='.Request::get('file') }}", function (resp) {
                                if (resp.status == true) {
                                    $('#progress-import').css('width', '100%');
                                    $('#progress-import').attr('aria-valuenow', 100);
                                    $('#status-import').addClass('text-success').html("<i class='fa fa-check-square-o'></i> Impor Data Lengkap !");
                                    clearInterval(int_prog);
                                    $('#upload-footer').show();
                                    console.log('Import Success');
                                }
                            })

                        })

                    </script>
                @endpush

            </div><!-- /.box-body -->

            <div class="box-footer" id='upload-footer' style="display:none">
                <div class='pull-right'>
                    <a href='{{ CRUDBooster::mainpath("import-data") }}' class='btn btn-default'><i class='fa fa-upload'></i> Unggah File Lain</a>
                    <a href='{{CRUDBooster::mainpath()}}' class='btn btn-success'>Selesai</a>
                </div>
            </div><!-- /.box-footer-->

        </div><!-- /.box -->
    @endif

    @if(Request::get('file') && !Request::get('import'))

        <ul class='nav nav-tabs'>
            <li style="background:#eeeeee"><a style="color:#111"
                                              onclick="if(confirm('Yakin ingin pergi ?')) location.href='{{ CRUDBooster::mainpath("import-data") }}'"
                                              href='javascript:;'><i class='fa fa-download'></i> Unggah sebuah File &raquo;</a></li>
            <li style="background:#ffffff" class='active'><a style="color:#111" href='#'><i class='fa fa-cogs'></i> Pengaturan &raquo;</a></li>
            <li style="background:#eeeeee"><a style="color:#111" href='#'><i class='fa fa-cloud-download'></i> Sedang mengimpor &raquo;</a></li>
        </ul>

        <!-- Box -->
        <div id='box_main' class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pengaturan</h3>
                <div class="box-tools">

                </div>
            </div>

            <?php
            if ($data_sub_module) {
                $action_path = Route($data_sub_module->controller."GetIndex");
            } else {
                $action_path = CRUDBooster::mainpath();
            }

            $action = $action_path."/done-import?file=".Request::get('file').'&import=1';
            ?>

            <form method='post' id="form" enctype="multipart/form-data" action='{{$action}}'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body table-responsive no-padding">
                    <div class='callout callout-info'>
                        * Abaikan kolom di mana Anda tidak yakin data tersebut sesuai dengan kolomnya.<br/>
                        * Peringatan!, Sayangnya saat ini, sistem tidak dapat mengimpor kolom yang berisi url gambar atau foto.
                    </div>
                    @push('head')
                        <style type="text/css">
                            th, td {
                                white-space: nowrap;
                            }
                        </style>
                    @endpush
                    <table class='table table-bordered' style="width:130%">
                        <thead>
                        <tr class='success'>
                            @foreach($table_columns as $k=>$column)
                                <?php
                                $help = '';
                                if ($column == 'id' || $column == 'created_at' || $column == 'updated_at' || $column == 'deleted_at') continue;
                                if (substr($column, 0, 3) == 'id_') {
                                    $relational_table = substr($column, 3);
                                    $help = "<a href='#' title='Ini adalah foreign key, sehingga Sistem akan memasukkan data baru ke tabel `$relational_table` jika tidak ada'><strong>(?)</strong></a>";
                                }
                                ?>
                                <th data-no-column='{{$k}}'>{{ $column }} {!! $help !!}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            @foreach($table_columns as $k=>$column)
                                <?php if ($column == 'id' || $column == 'created_at' || $column == 'updated_at' || $column == 'deleted_at') continue;?>
                                <td data-no-column='{{$k}}'>
                                    <select style='width:120px' class='form-control select_column' name='select_column[{{$k}}]'>
                                        <option value=''>** Set Kolom untuk {{$column}}</option>
                                        @foreach($data_import_column as $import_column)
                                            <option value='{{$import_column}}'>{{$import_column}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>


                </div><!-- /.box-body -->

                @push('bottom')
                    <script type="text/javascript">
                        $(function () {
                            var total_selected_column = 0;
                            setInterval(function () {
                                total_selected_column = 0;
                                $('.select_column').each(function () {
                                    var n = $(this).val();
                                    if (n) total_selected_column = total_selected_column + 1;
                                })
                            }, 200);
                        })

                        function check_selected_column() {
                            var total_selected_column = 0;
                            $('.select_column').each(function () {
                                var n = $(this).val();
                                if (n) total_selected_column = total_selected_column + 1;
                            })
                            if (total_selected_column == 0) {
                                swal("Oops...", "Harap setidaknya 1 kolom yang harus disesuaikan...", "error");
                                return false;
                            } else {
                                return true;
                            }
                        }
                    </script>
                @endpush

                <div class="box-footer">
                    <div class='pull-right'>
                        <a onclick="if(confirm('Yakin ingin pergi ?')) location.href='{{ CRUDBooster::mainpath("import-data") }}'" href='javascript:;'
                           class='btn btn-default'>Batal</a>
                        <input type='submit' class='btn btn-primary' name='submit' onclick='return check_selected_column()' value='Impor Data'/>
                    </div>
                </div><!-- /.box-footer-->
            </form>
        </div><!-- /.box -->


    @endif

    @if(!Request::get('file'))
        <ul class='nav nav-tabs'>
            <li style="background:#ffffff" class='active'><a style="color:#111"
                                                             onclick="if(confirm('Yakin ingin pergi ?')) location.href='{{ CRUDBooster::mainpath("import-data") }}'"
                                                             href='javascript:;'><i class='fa fa-download'></i> Unggah File &raquo;</a></li>
            <li style="background:#eeeeee"><a style="color:#111" href='#'><i class='fa fa-cogs'></i> Pengaturan &raquo;</a></li>
            <li style="background:#eeeeee"><a style="color:#111" href='#'><i class='fa fa-cloud-download'></i> Sedang mengimpor &raquo;</a></li>
        </ul>

        <!-- Box -->
        <div id='box_main' class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Unggah File</h3>
                <div class="box-tools">

                </div>
            </div>

            <?php
            if ($data_sub_module) {
                $action_path = Route($data_sub_module->controller."GetIndex");
            } else {
                $action_path = CRUDBooster::mainpath();
            }

            $action = $action_path."/do-upload-import-data";
            ?>

            <form method='post' id="form" enctype="multipart/form-data" action='{{$action}}'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body">

                    <div class='callout callout-success'>
                        <h4> Selamat Datang di Alat Pengimpor Data </h4>
                         Sebelum melakukan unggah file, sebaiknya baca petunjuk di bawah ini: <br/>
                         * Format file harus: xls, xlsx, atau csv <br/>
                         * Jika Anda memiliki data file besar, kami tidak dapat menjamin. Jadi, tolong bagi file-file itu menjadi beberapa bagian file (maks 5 MB). <br/>
                         * Alat ini menghasilkan data secara otomatis, jadi berhati-hatilah dengan struktur tabel xls Anda. Harap pastikan struktur tabel benar. <br/>
                         * Struktur tabel: Baris 1 adalah kolom tajuk, dan selanjutnya adalah data.
                    </div>

                    <div class='form-group'>
                        <label>File XLS / CSV</label>
                        <input type='file' name='userfile' class='form-control' required/>
                        <div class='help-block'>Hanya mendukung tipe file : XLS, XLSX, CSV</div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <div class='pull-right'>
                        <a href='{{ CRUDBooster::mainpath() }}' class='btn btn-default'>Batal</a>
                        <input type='submit' class='btn btn-primary' name='submit' value='Unggah'/>
                    </div>
                </div><!-- /.box-footer-->
            </form>
        </div><!-- /.box -->


        @endif
        </div><!-- /.col -->


        </div><!-- /.row -->

@endsection