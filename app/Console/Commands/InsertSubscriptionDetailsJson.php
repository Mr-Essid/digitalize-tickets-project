<?php

namespace App\Console\Commands;

use App\Models\SubscriptionDetail;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\File;
use Ramsey\Collection\Map\AssociativeArrayMap;

class InsertSubscriptionDetailsJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:insert-subscription-details';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert all json subscription details to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {

       $content = File::json('init-subscription-details.json');
        $this->withProgressBar($content, function ($array) {
            SubscriptionDetail::create($array);
        });
    }
}
