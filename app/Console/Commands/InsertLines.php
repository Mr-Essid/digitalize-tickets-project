<?php

namespace App\Console\Commands;

use App\Models\Line;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InsertLines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:insert-lines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert current that defined by the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $content = File::json("init-lines-definded.json");
        
        $this->withProgressBar($content, function($current_line) {
            Line::create($current_line);
        });

    }
}
