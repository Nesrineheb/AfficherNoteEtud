<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Full_text_search extends Model
{
    use Notifiable;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'full_text_searches.CodeMod' 	=> 10,
            'full_text_searches.NCC' 		=> 10,
            'full_text_searches.NCI' 		=> 10,
            'full_text_searches.NCF' 			=> 10,
            'full_text_searches.NTP' 	=> 10,
            'full_text_searches.Moy' 		=> 10,
            //'full_text_searches.id' 			=> 10,
        ]
    ];

    protected $fillable = [
        'CodeMod', 'NCC', 'NCI', 'NCF', 'NTP', 'Moy',
    ];
}
