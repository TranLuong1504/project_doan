<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\SetField\BillDetailField;

class BillDetail extends Model
{
    public $prefix = 'bid';
    protected $table = 'bill_details';

    public $fieldClass = BillDetailField::class;

    protected $guarded = [];

}
