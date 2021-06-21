<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Consonantscore extends Model{

  use sortable;

  protected $table = 'consonantscore';

  protected $primaryKey = 'id';

  protected $fillable = ['consonant', 'name','initial_score','final_score'];

  public $sortable = ['consonant', 'name','initial_score','final_score'];

}