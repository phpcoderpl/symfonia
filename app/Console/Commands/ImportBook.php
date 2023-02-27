<?php

namespace App\Console\Commands;


use App\Http\Resources\CreateBookRequest;
use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImportBook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'book:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import books from National Geographic';

    private $httpClient;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Http $httpClient)
    {
        parent::__construct();
        $this->httpClient = $httpClient;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->importBook();
        return 0;
    }

    public function importBook(): void
    {
        $steamAllGamesUrl = config('book.url');
        /*
         $response = $this->httpClient->get($steamAllGamesUrl);
         if ($response->failed()) {
             $this->error('Request failed. Status code: ' . $response->status());
             exit;
         }
         */

        $xmlObject = simplexml_load_string(Storage::get('books.xml'));
        $progressDb = $this->output->createProgressBar(count($xmlObject->channel->item));

        foreach ($xmlObject->channel->item as $book) {

            $validator = Validator::make([
                'name' => $book->title,
                'description' => $book->description,
                'link' => $book->link
            ], CreateBookRequest::rules());

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }
            } else {
                Book::create($validator->validated());
            }

            $progressDb->advance();

        }

        $progressDb->finish();

        $this->info('End');
    }

}
