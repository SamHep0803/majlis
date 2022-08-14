<?php

namespace Database\Seeders;

use App\Models\vACC;
use function array_push;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;
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
        $allvACCs = json_decode($allvACCs, true);
        // $menavACCs = [];
        // foreach ($allvACCs as $vACC) {
        //     if ($vACC['parentdivision'] == 'MENA') {
        //         array_push($menavACCs, $vACC);
        //     }
        // }

        foreach ($allvACCs as $vACC) {
            $newvACC = new vACC;
            $newvACC->code = $vACC['code'];
            $newvACC->name = $vACC['fullname'];
            if ($vACC['parentdivision'] == 'MENA') {
                $newvACC->isMENA = true;
            }
            $newvACC->save();
        }
    }
}
