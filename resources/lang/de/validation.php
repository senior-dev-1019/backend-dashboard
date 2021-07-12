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

    'accepted'             => ':attribute muss akzeptiert werden.',
    'active_url'           => ':attribute ist keine gültige URL.',
    'after'                => ':attribute muss ein Datum nach :date sein.',
    'after_or_equal' => ':attribute muss ein Datum nach oder gleich :date sein.',
    'alpha'                => ':attribute darf nur Buchstaben enthalten.',
    'alpha_dash'           => ':attribute darf nur Buchstabn, Ziffern und Bindestriche enthalten.',
    'alpha_num'            => ':attribute darf nur Buchstaben und Ziffern enthalten.',
    'array'                => ':attribute muss eine Auflistung sein.',
    'before'               => ':attribute muss ein Datum vor :date sein.',
    'before_or_equal' => ':attribute muss ein Datum vor oder gleich :date sein.',
    'between'              => [
        'numeric' => ':attribute muss von :min bis :max liegen.',
        'file'    => ':attribute muss eine Grösse von :min bis :max kilobytes aufweisen.',
        'string'  => ':attribute muss von :min bis :max Zeichen umfassen.',
        'array'   => ':attribute muss von :min bis :max Einträge umfassen.',
    ],
    'boolean'              => ':attribute muss wahr oder falsch sein.',
    'confirmed'            => ':attribute Bestätigung stimmt nicht überein.',
    'date'                 => ':attribute ist kein gültiges Datum.',
    'date_equals' => ':attribute muss ein Datum sein, das gleich :date ist.',
    'date_format'          => ':attribute entspricht nicht dem Format :format.',
    'different'            => ':attribute und :other müssen sich unterscheiden.',
    'digits'               => ':attribute muss :digits Ziffern umfassen.',
    'digits_between'       => ':attribute muss von :min bis :max Ziffern umfassen.',
    'dimensions' => ':attribute hat ungültige Bildabmessungen.',
    'distinct' => ':attribute hat einen doppelten Wert.',
    'email'                => ':attribute muss eine gültige E-Mail-Adresse sein.',
    'ends_with' => ':attribute muss mit einem der folgenden Werte enden :values.',
    'exists'               => 'Der gewählte Wert für :attribute ist ungültig.',
    'file' => ':attribute muss eine Datei sein.',
    'filled'               => ':attribute ist erforderlich.',
    'gt' => [
        'numeric' => ':attribute muss größer als :value sein.',
        'file' => ':attribute muss größer sein als :vale Kilobyte.',
        'string' => ':attribute muss mehr als :value Zeichen enthalten.',
        'array' => ':attribute muss mehr als :value Elemente enthalten.',
    ],
    'gte' => [
        'numeric' => ':attribute muss größer oder gleich :value sein.',
        'file' => ':attribute muss größer oder gleich :value Kilobyte sein.',
        'string' => ':attribute muss :value oder mehr Zeichen enthalten.',
        'array' => ':attribute muss mindestens :value Elemente enthalten.',
    ],
    'image'                => ':attribute muss ein Bild sein.',
    'in'                   => 'Der gewählte Wert für :attribute ist ungültig.',
    'in_array' => ':attribute existiert nicht in :other.',
    'integer'              => ':attribute muss eine Ganzzahl sein.',
    'ip'                   => ':attribute muss eine gültige IP Adresse sein.',
    'ipv4' => ':attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6' => ':attribute muss eine gültige IPv6-Adresse sein.',
    'json'                 => ':attribute muss ein gültiger JSON string sein.',
    'lt' => [
        'numeric' => ':attribute muss kleiner als :value sein.',
        'file' => ':attribute muss kleiner als :value Kilobyte sein.',
        'string' => ':attribute muss weniger als :value Zeichen enthalten.',
        'array' => ':attribute muss weniger als :value Elemente enthalten.',
    ],
    'lte' => [
        'numeric' => ':attribute muss kleiner oder gleich :value sein.',
        'file' => ':attribute muss kleiner oder gleich :value Kilobyte sein.',
        'string' => ':attribute muss :value oder weniger Zeichen enthalten.',
        'array' => ':attribute darf nicht mehr als :value Elemente enthalten.',
    ],
    'max'                  => [
        'numeric' => ':attribute darf höchstens :max sein.',
        'file'    => ':attribute darf nicht mehr als :max kilobytes sein.',
        'string'  => ':attribute darf nicht mehr als :max Zeichen lang sein.',
        'array'   => ':attribute darf nicht mehr als :max Elemente umfassen.',
    ],
    'mimes'                => ':attribute muss eine Datei des Typs: :values sein.',
    'mimetypes' => ':attribute muss eine Datei vom Typ :values sein.',
    'min'                  => [
        'numeric' => ':attribute muss mindestens :min sein.',
        'file'    => ':attribute muss mindestens :min kilobytes gross sein.',
        'string'  => ':attribute muss mindestens :min Zeichen lang sein.',
        'array'   => ':attribute muss mindestens :min Elemente umfassen.',
    ],
    'not_in'               => 'Der gewählte Wert für :attribute ist ungültig.',
    'not_regex' => 'Das Format von :attribute ist ungültig.',
    'numeric'              => ':attribute muss eine Zahl sein.',
    'password' => 'Das Passwort ist falsch.',
    'present' => ':attribute muss vorhanden sein.',
    'regex'                => 'Das Format von :attribute ist ungültig.',
    'required'             => ':attribute ist erforderlich.',
    'required_if'          => ':attribute ist erforderlich wenn :other :value ist.',
    'required_unless'      => ':attribute ist erforderlich wenn :other nicht in  :values ist.',
    'required_with'        => ':attribute ist erforderlich wenn :values vorhanden ist.',
    'required_with_all'    => ':attribute ist erforderlich wenn :values vorhanden ist.',
    'required_without'     => ':attribute ist erforderlich wenn :values nicht vorhanden ist.',
    'required_without_all' => ':attribute ist erforderlich wenn keiner der Werte :values are vorhanden sind.',
    'same'                 => ':attribute und :other müssen übereinstimmen.',
    'size'                 => [
        'numeric' => ':attribute muss :size sein.',
        'file'    => ':attribute muss :size kilobytes gross sein.',
        'string'  => ':attribute muss :size Zeichen lang sein.',
        'array'   => ':attribute muss :size Elemente umfassen.',
    ],
    'starts_with' => ':attribut muss mit einem der folgenden Werte beginnen: :values',
    'string'               => ':attribute muss eine Zeichenfolge sein.',
    'timezone'             => ':attribute muss eine gültige Zone sein.',
    'unique'               => ':attribute ist bereits benutzt.',
    'uploaded' => ':attribute konnte nicht hochgeladen werden.',
    'url'                  => 'Das Format von :attribute ist ungültig.',
    'uuid' => ':attribute muss eine gültige UUID sein.',

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
            'rule-name' => 'benutzerdefinierte Nachricht',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
