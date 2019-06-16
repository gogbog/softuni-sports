<?php

namespace App\Console\Commands;

use App\Modules\Fixtures\Models\Fixture;
use App\Modules\Leagues\Models\League;
use App\Modules\Sports\Models\Sport;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;
use function Schnittstabil\JsonDecodeFile\jsonDecodeFile;

class SyncJsonData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:json';
    private $path;
    private $data;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command imports all of the json data to mysql';

    /**
     * Create a new command instance.
     *
     * @throws \KHerGe\File\Exception\ResourceException
     * @throws \Seld\JsonLint\ParsingException
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = storage_path('data/sport-events.json');
        $this->data = jsonDecodeFile($this->path);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $starttime = microtime(true);
        $this->info('Command starting now - ' . Carbon::now());

        foreach ($this->data as $api_fixture) {

            $fixture = Fixture::firstOrNew(['title' => $api_fixture->eventName]);
            $sport = Sport::firstOrNew(['api_id' => $api_fixture->sport->id]);
            $league = League::firstOrNew(['api_id' => $api_fixture->league->id]);

            //checks if the sport already exists
            if (empty($sport->id)) {
                $sport->title = $api_fixture->sport->name;
                $sport->api_id = $api_fixture->sport->id;
                $sport->save();
            }

            //checks if the league already exists
            if (empty($league->id)) {
                $league->title = utf8_encode($api_fixture->league->name);
                $league->api_id = $api_fixture->league->id;
                $league->sport_api_id = $api_fixture->league->sportId;
                $league->save();
            }

            //checks if the fixture already exists
            if (empty($fixture->id)) {

                $teams = explode('vs', $api_fixture->eventName);
                $newDate = DateTime::createFromFormat("Y-m-d\TH:i:s.uO",$api_fixture->eventDate);
                $fixture->title = utf8_encode($api_fixture->eventName);
                $fixture->date = $newDate->format("Y-m-d H:i:s");
                $fixture->league_api_id = $api_fixture->league->id;
                $fixture->homeTeam = trim($teams[0]);
                $fixture->enemyTeam = trim($teams[1]);
                $fixture->homeTeamScore = $api_fixture->homeTeamScore;
                $fixture->awayTeamScore = $api_fixture->awayTeamScore;

                if (!empty($api_fixture->homeTeamOdds)) {
                    $fixture->homeTeamOdds = $api_fixture->homeTeamOdds;
                }

                if (!empty($api_fixture->awayTeamOdds)) {
                    $fixture->awayTeamOdds = $api_fixture->awayTeamOdds;
                }

                if (!empty($api_fixture->drawOdds)) {
                    $fixture->drawOdds = $api_fixture->drawOdds;
                }
                $fixture->save();
            }


        }
        $endtime = microtime(true);
        $timediff = $endtime - $starttime;
        $this->info($this->secondsToTime($timediff) . ' - ' . Carbon::now());
    }

    private function secondsToTime($s)
    {
        $h = floor($s / 3600);
        $s -= $h * 3600;
        $m = floor($s / 60);
        $s -= $m * 60;
        return $h . ':' . sprintf('%02d', $m) . ':' . sprintf('%02d', $s);
    }
}
