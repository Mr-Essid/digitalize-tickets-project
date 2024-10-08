<?php

namespace App\Jobs;

use App\Models\ForgetPasswordTokens;
use App\Models\RestPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ClearForgetPasswordRow implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $email,
        public $code_ved = false
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->code_ved) {
            ForgetPasswordTokens::where('email', $this->email)->delete();
        } else
            RestPassword::where('email', $this->email)->delete();
    }
}
