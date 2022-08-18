<?php

namespace Database\Seeders;

use App\Models\vACC;
use GuzzleHttp\Client;
use GuzzleHttp\Utils;
use Illuminate\Database\Seeder;

class vACCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $vACCsQuery = $client->get('https://api.vatsim.net/api/subdivisions/');
        $allvACCs = $vACCsQuery->getBody();
        $allvACCs = Utils::jsonDecode($allvACCs, true);
        // $menavACCs = [];
        // foreach ($allvACCs as $vACC) {
        //     if ($vACC['parentdivision'] == 'MENA') {
        //         array_push($menavACCs, $vACC);
        //     }
        // }

        vACC::create([
            'code' => 'OSK',
            'name' => 'OpenSkies',
            'isMENA' => true
        ]);

        foreach ($allvACCs as $vACC) {
            $newvACC = new vACC();
            $newvACC->code = $vACC['code'];
            $newvACC->name = $vACC['fullname'];
            if ($vACC['parentdivision'] == 'MENA') {
                $newvACC->isMENA = true;
            }
            $newvACC->save();
        }
    }
}
