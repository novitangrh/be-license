<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            BillingSchoolyears::class,
            BillingSchoolGrades::class,
            BillingSelectionPaths::class,
            BillingComponents::class,
            BillingRevisionHistory::class,
            BillingSchools::class,
            BillingSchoolRates::class,
            BillingStudents::class,
            BillingStudentRates::class,
        ]);
    }
}
