<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardingModel extends Model
{
    protected $table = "boarding_models";
    protected $fillable = ['client', 'fat', 'date_doc', 'date_delivery', 'date_loading', 'date_boarding', 'agent', 'date_prod', 'obs'];
    public $timestamps = true;
}
