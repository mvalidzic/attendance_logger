<?php

namespace App\Console\Commands;

use App\Imports\CompaniesImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import companies from .xlsx file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new CompaniesImport, public_path() . '/imports/companies.xlsx');
        $this->info('Companies imported');
    }
}
