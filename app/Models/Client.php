<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'date_profiled',
        'primary_legal_counsel',
        'date_of_birth',
        'profile_image',
        'last_notification',
        'case_detail'
    ];

    public function trap($event, $data = []) {
        $log = [
            'event' => $event,
            'data' => json_encode($data),
            'created_at' => now()
        ];

        // Save the log to the database
        DB::table('client_logs')->insert($log);
    }
}
