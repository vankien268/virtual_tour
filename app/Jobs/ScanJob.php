<?php

namespace App\Jobs;

use App\Models\Presentation;
use App\Models\Scanning;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ScanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 3;
    // public $timeout = 5;

    protected $presentation;
    protected $ip;
    protected $userAgent;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Presentation $presentation, $ip, $userAgent)
    {
        $this->presentation = $presentation;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Chạy job ScanJob');
        $location = $this->presentation->location;
        $data = [
            'zone_id' => $location->zone? $location->zone->id : null,
            'language_id' => $this->presentation->language->id,
            'location_id' => $this->presentation->location->id,
            'presentation_id' => $this->presentation->id,
            'scanned_at' => date('Y-m-d H:i:s'),
            'ip' => $this->ip,
            'user_agent' => $this->userAgent,
        ];
        Scanning::create($data);
    }


    /**
     * failed
     *
     * @param  mixed $exception
     * @return void
     */
    public function failed(\Throwable $exception) {
        Log::error("Lỗi: ". $exception);
    }
}
