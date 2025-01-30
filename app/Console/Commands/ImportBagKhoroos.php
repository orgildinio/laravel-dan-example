<?php

namespace App\Console\Commands;

use League\Csv\Reader;
use App\Models\BagKhoroo;
use Illuminate\Console\Command;
use App\Imports\BagKhoroosImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportBagKhoroos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:bagkhoroos {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import bag_khoroos data from a CSV file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File not found: $filePath");
            return;
        }

        // Import the Excel file
        Excel::import(new BagKhoroosImport, $filePath);

        $this->info('Bag Khoroos imported successfully!');
    }
}
