<?php

namespace App\Console\Commands;

use App\Imports\StudentsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import students from .xlsx file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new StudentsImport, public_path() . '/imports/students.xlsx');
        $this->info('Students imported');
    }
}
