<?php

namespace App\Console\Commands;

use App\Http\Resources\DaysFromJson;
use App\Models\Day;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use JsonCustomHelper;

class InsertDaysCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:insert-days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert existant days in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      $content = File::json('days.define-application-days.json');        //

      $this->withProgressBar($content, function($day) {
        Day::create(JsonCustomHelper::camel_to_snake($day));
      });

    }
}
