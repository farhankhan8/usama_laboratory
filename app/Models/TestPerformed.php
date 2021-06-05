<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPerformed extends Model
{
    use HasFactory;
    public $table = 'test_performeds';

    protected $fillable = [
        'available_test_id',
        'patient_id',
        'Sname_id',
        'fee',
        'type',
//        'testResult',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);

    }

    public function availableTest()
    {
        return $this->belongsTo(AvailableTest::class);

    }

    public function stat()
    {
        return $this->belongsTo(Status::class, 'Sname_id', 'id');

    }

    public function testReport(){
        return $this->hasMany(TestReport::class);
    }
}
