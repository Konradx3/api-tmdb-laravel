<?php

namespace App\Console\Commands;

use App\Services\TMDBService;
use Illuminate\Console\Command;

class FetchTMDBData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-tmdb-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets data from TMDB and saves to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tmdbService = new TMDBService();

        $this->info('Fetching MOVIES...');
        $tmdbService->fetchData('movies', 50);

        $this->info('Fetching SERIES...');
        $tmdbService->fetchData('series', 10);

        $this->info('Fetching GENRES...');
        $tmdbService->fetchData('genres');

        $this->info('Done!');
    }
}
