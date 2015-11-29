<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | El following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute no es una URL válida.',
    'after'                => 'El campo :attribute debe ser una fecha anterior a :date.',
    'alpha'                => 'El campo :attribute solo puede contener letras.',
    'alpha_dash'           => 'El campo :attribute solo puede contener letras, números, y barras.',
    'alpha_num'            => 'El campo :attribute solo puede contener letras y números.',
    'array'                => 'El campo :attribute debe ser an array.',
    'before'               => 'El campo :attribute debe ser a date before :date.',
    'between'              => [
        'numeric' => 'El campo :attribute debe ser entre :min y :max.',
        'file'    => 'El campo :attribute debe ser entre :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe ser entre :min y :max carácteres.',
        'array'   => 'El campo :attribute debe tener entre :min y :max objetos.',
    ],
    'boolean'              => 'El campo :attribute debe ser true o false.',
    'confirmed'            => 'El campo :attribute confirmación no coincide.',
    'date'                 => 'El campo :attribute no es una fecha válida.',
    'date_format'          => 'El campo :attribute no coincide con el formato :format.',
    'different'            => 'El campo :attribute y :other debe ser different.',
    'digits'               => 'El campo :attribute deben ser :digits digitos.',
    'digits_between'       => 'El campo :attribute debe ser entre :min y :max digitos.',
    'email'                => 'El campo :attribute debe ser una dirección de correo válida.',
    'exists'               => 'El selected campo :attribute es invalido.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El campo :attribute es invalido.',
    'integer'              => 'El campo :attribute debe ser un número.',
    'ip'                   => 'El campo :attribute debe ser una IP válida.',
    'json'                 => 'El campo :attribute debe ser un JSON string válido.',
    'max'                  => [
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
        'file'    => 'El campo :attribute no puede ser mayor que :max kilobytes.',
        'string'  => 'El campo :attribute no puede ser mayor que :max characters.',
        'array'   => 'El campo :attribute no puede tener mas de :max objetos.',
    ],
    'mimes'                => 'El campo :attribute debe ser un fichero del tipo: :values.',
    'min'                  => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'file'    => 'El campo :attribute debe ser al menos :min kilobytes.',
        'string'  => 'El campo :attribute debe ser al menos :min carácteres.',
        'array'   => 'El campo :attribute debe tener al menos :min objetos.',
    ],
    'not_in'               => 'El selected campo :attribute is invalid.',
    'numeric'              => 'El campo :attribute debe ser a number.',
    'regex'                => 'El campo :attribute format is invalid.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está present.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ningun :values esta presente.',
    'same'                 => 'El campo :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file'    => 'El campo :attribute debe ser :size kilobytes.',
        'string'  => 'El campo :attribute debe ser :size characters.',
        'array'   => 'El campo :attribute must contain :size items.',
    ],
    'string'               => 'El campo :attribute debe ser una cadena de carácteres.',
    'timezone'             => 'El campo :attribute debe ser una zona valida.',
    'unique'               => 'El campo :attribute ya está resgistrado.',
    'url'                  => 'El formato del campo :attribute es invalido',

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
    | El following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
