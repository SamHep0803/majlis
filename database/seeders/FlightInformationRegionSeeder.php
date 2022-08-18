<?php

namespace Database\Seeders;

use App\Models\FlightInformationRegion;
use App\Models\vACC;
use Illuminate\Database\Seeder;

class FlightInformationRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $FIRs = [
            [
                'identifier' => 'OBBB',
                'name' => 'Bahrain',
                "vACC" => "ARB"
            ],
            [
                'identifier' => 'OTXX',
                'name' => 'Doha',
                "vACC" => "ARB"
            ],
            [
                'identifier' => 'OMAE',
                'name' => 'Emirates',
                "vACC" => "ARB"
            ],
            [
                'identifier' => 'OOMM',
                'name' => 'Muscat',
                "vACC" => "ARB"
            ],
            [
                'identifier' => 'OIIX',
                'name' => 'Tehran',
                'vACC' => 'IRN'
            ],
            [
                'identifier' => 'OKAC',
                'name' => 'Kuwait',
                'vACC' => 'KWIQ'
            ],
            [
                'identifier' => 'ORBB',
                'name' => 'Baghdad',
                'vACC' => 'KWIQ'
            ],
            [
                'identifier' => 'OEJD',
                'name' => 'Jeddah',
                'vACC' => 'SAU'
            ],
            [
                'identifier' => 'OJAC',
                'name' => 'Amman',
                'vACC' => 'JOR'
            ],
            [
                'identifier' => 'HECC',
                'name' => 'Cairo',
                'vACC' => 'EGYPT'
            ],
            [
                'identifier' => 'HSSS',
                'name' => 'Khartoum',
                'vACC' => 'NEA'
            ],
            [
                'identifier' => 'HJJJ',
                'name' => 'Juba [up to FL245]',
                'vACC' => 'NEA'
            ],
            [
                'identifier' => 'HHAA',
                'name' => 'Asmara',
                'vACC' => 'NEA'
            ],
            [
                'identifier' => 'HAAA',
                'name' => 'Addis Ababa',
                'vACC' => 'NEA'
            ],
            [
                'identifier' => 'HCSM',
                'name' => 'Mogadishu',
                'vACC' => 'NEA'
            ],
            [
                'identifier' => 'GMMM',
                'name' => 'Casablanca',
                'vACC' => 'MAR'
            ],
            [
                'identifier' => 'OSTT',
                'name' => 'Syria, Damascus',
                'vACC' => 'OSK'
            ],
            [
                'identifier' => 'OLBB',
                'name' => 'Lebanon, Beirut',
                'vACC' => 'OSK'
            ],
            [
                'identifier' => 'OSYC',
                'name' => 'Yemen, Sanaa',
                'vACC' => 'OSK'
            ],
            [
                'identifier' => 'HLLL',
                'name' => 'Libya, Tripoli',
                'vACC' => 'OSK'
            ],
            [
                'identifier' => 'FTTT',
                'name' => "Chad, N'Djamena",
                'vACC' => 'OSK'
            ],
            [
                'identifier' => 'DTTC',
                'name' => 'Tunisia, Tunis',
                'vACC' => 'OSK'
            ],
            [
                'identifier' => 'DAAA',
                'name' => 'Algeria, Algiers',
                'vACC' => 'OSK'
            ],
            [
                'identifier' => 'DRRR',
                'name' => 'Niger, Niamey',
                'vACC' => 'OSK'
            ],
        ];

        foreach ($FIRs as $FIR) {
            $newFIR = FlightInformationRegion::create([
                'identifier' => $FIR['identifier'],
                'name' => $FIR['name'],
            ]);
            $vACC = vACC::query()->where("code", $FIR['vACC'])->first();
            $vACC->flight_information_regions()->save($newFIR);
        }
    }
}
