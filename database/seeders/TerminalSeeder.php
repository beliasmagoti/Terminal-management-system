<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Terminal;

class TerminalSeeder extends Seeder
{
    public function run(): void
    {
        Terminal::create([
            'name' => 'Dar Es Salaam Terminal',
            'location' => 'Dar es Salaam',
            'code' => 'xx-12',
            'status' => 'active'

        ]);

        Terminal::create([
            'name' => 'Mwanza Terminal',
            'location' => 'Mwanza',
             'code' => 'Tx-12',
             'status' => 'active'

        ]);
    }
}