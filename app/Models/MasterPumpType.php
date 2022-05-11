<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPumpType extends Model
{
    use HasFactory;

    protected $table = 'master_pump_types';
    protected $fillable = [
        'serial_no',
        'pump_type',
        'hpkw',
        'suction_size',
        'delivery_size',
        'phase',
        'voltage',
        'room_temp',
        'total_head',
        'discharge',
        'overall_efficiency',
        'max_current',
        'h_range_one',
        'h_range_two',
        'frequency',
        'efficiency_calc'
    ];
}