<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute harus diterima.',
    'active_url'           => ':attribute bukanlah URL yang valid.',
    'after'                => ':attribute harus tanggal setelah :date.',
    'after_or_equal'       => ':attribute harus tanggal setelah atau sama dengan :date.',
    'alpha'                => ':attribute hanya boleh berisi huruf.',
    'alpha_dash'           => ':attribute hanya boleh berisi huruf, angka, and dash.',
    'alpha_num'            => ':attribute hanya boleh berisi huruf dan angka.',
    'array'                => ':attribute harus berupa sebuah array.',
    'before'               => ':attribute harus tanggal sebelum :date.',
    'before_or_equal'      => ':attribute harus tanggal sebelum atau sama dengan :date.',
    'between'              => [
        'numeric' => ':attribute harus di antara :min dan :max.',
        'file'    => ':attribute harus di antara :min dan :max kilobyte.',
        'string'  => ':attribute harus di antara :min dan :max karakter.',
        'array'   => ':attribute harus di antara :min dan :max item.',
    ],
    'boolean'              => 'Field :attribute harus true atau false.',
    'confirmed'            => 'Konfirmasi :attribute tidak cocok.',
    'date'                 => ':attribute bukan tanggal yang valid.',
    'date_format'          => ':attribute tidak sesuai dengan format :format.',
    'different'            => ':attribute dan :other harus berbeda.',
    'digits'               => ':attribute harus :digits digit.',
    'digits_between'       => ':attribute harus di antara :min dan :max digit.',
    'dimensions'           => ':attribute memiliki dimensi gambar yang tidak sesuai.',
    'distinct'             => 'Field :attribute memiliki duplikasi nilai.',
    'email'                => ':attribute harus email yang valid.',
    'exists'               => ':attribute yang dipilih tidak valid.',
    'file'                 => ':attribute harus sebuah file.',
    'filled'               => 'Field :attribute harus memiliki nilai.',
    'image'                => ':attribute harus sebuah gambar.',
    'in'                   => ':attribute yang dipilih tidak valid.',
    'in_array'             => 'Field :attribute tidak ditemukan pada :other.',
    'integer'              => ':attribute harus sebuah integer.',
    'ip'                   => ':attribute harus sebuah IP address yang valid.',
    'ipv4'                 => ':attribute harus sebuah IPv4 address yang valid.',
    'ipv6'                 => ':attribute harus sebuah IPv6 address yang valid.',
    'json'                 => ':attribute harus sebuah JSON string yang valid..',
    'max'                  => [
        'numeric' => ':attribute tidak boleh lebih dari :max.',
        'file'    => ':attribute tidak boleh lebih dari :max kilobyte.',
        'string'  => ':attribute tidak boleh lebih dari :max karakter.',
        'array'   => ':attribute tidak boleh lebih dari :max item.',
    ],
    'mimes'                => ':attribute harus file dengan tipe: :values.',
    'mimetypes'            => ':attribute harus file dengan tipe: :values.',
    'min'                  => [
        'numeric' => ':attribute paling tidak harus :min.',
        'file'    => 'The :attribute paling tidak harus :min kilobyte.',
        'string'  => 'The :attribute paling tidak harus :min karakter.',
        'array'   => 'The :attribute paling tidak harus :min item.',
    ],
    'not_in'               => ':attribute yang dipilih tidak valid.',
    'numeric'              => ':attribute harus angka.',
    'present'              => 'Field :attribute harus ada.',
    'regex'                => 'Format :attribute tidak valid.',
    'required'             => 'Field :attribute harus diisi.',
    'required_if'          => 'Field :attribute harus diisi apabila :other adalah :value.',
    'required_unless'      => 'Field :attribute harus diisi apabila :other bukan :values.',
    'required_with'        => 'Field :attribute harus diisi apabila :values ada.',
    'required_with_all'    => 'Field :attribute harus diisi apabila :values ada.',
    'required_without'     => 'Field :attribute harus diisi apabila :values tidak ada.',
    'required_without_all' => 'Field :attribute harus diisi apabila tidak ada satu pun :values yang ada.',
    'same'                 => ':attribute dan :other harus sesuai.',
    'size'                 => [
        'numeric' => ':attribute harus :size.',
        'file'    => ':attribute harus :size kilobyte.',
        'string'  => ':attribute harus :size karakter.',
        'array'   => ':attribute harus terdiri dari :size item.',
    ],
    'string'               => ':attribute harus sebuah string.',
    'timezone'             => ':attribute harus dalam zona yang valid.',
    'unique'               => ':attribute telah digunakan.',
    'uploaded'             => ':attribute gagal diunggah.',
    'url'                  => 'format :attribute tidak valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
