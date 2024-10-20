<?php

return [
    'en' => [
        'username' => [
            'unique'=> 'Inserted username already exists',
            'min' => 'You must insert at least 4 characters for username',
            'required'=> ':attribute in required',
        ],
        'name' => [
            'required'=> ':attribute is required',
        ],
        'email' =>[
            'email' => 'Interted email is incorrect',
            'unique' => 'Interted email already exists',
            'required'=> ':attribute is required',
        ],
        'surname' => [
            'required'=> ':attribute is required',
        ],
        'password' =>[
            'min' => 'You must insert at least 6 characters for password',
            'required'=> ':attribute is required',
        ],
    ],
    
    'it' => [
        'username' => [
            'unique'=> 'Lo :attribute esiste già',
            'min' => 'Inserire almeno 4 caratteri per :attribute',
            'required'=> ':attribute è obbligatorio',
        ],
        'name' => [
            'required'=> ':attribute è obbligatorio',
        ],
        'email' =>[
            'email' => 'Il formato :attribute non è corretto',
            'unique' => 'la :attribute inserita esiste già',
            'required'=> ':attribute è obbligatorio',
        ],
        'surname' => [
            'required'=> ':attribute è obbligatorio',
        ],
        'password' =>[
            'min' => 'Inserire almeno 6 caratteri per :attribute',
            'required'=> ':attribute è obbligatorio',
        ],
    ]
];
