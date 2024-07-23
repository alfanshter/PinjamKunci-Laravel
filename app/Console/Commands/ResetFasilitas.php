<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\Mode;
use App\Models\Rfid;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ResetFasilitas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:status';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Fasilitas apabila melebihi jam ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $expired = Booking::where('waktu_selesai', '<=', $now)
            ->where('status', 0)
            ->first();
        if ($expired != null) {
            //ubahlah ke mode reset
            //update data  
            $update = Mode::query()->update(['mode' => 'reset']);
            //update booking
            $updateBooking = Booking::where('waktu_selesai', '<=', $now)
            ->where('status', 0)->update([
                'status'=> 1
            ]);
            //ubah status alat
            $updateAlat = Rfid::where('id',$expired->id_rfid)->update([
                'status' => 1
            ]);
        }
    }
}
