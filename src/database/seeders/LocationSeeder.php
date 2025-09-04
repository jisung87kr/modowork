<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['city' => '서울시', 'district' => '강남구', 'full_address' => '서울시 강남구', 'latitude' => 37.517235, 'longitude' => 127.047325],
            ['city' => '서울시', 'district' => '강북구', 'full_address' => '서울시 강북구', 'latitude' => 37.639938, 'longitude' => 127.025553],
            ['city' => '서울시', 'district' => '강서구', 'full_address' => '서울시 강서구', 'latitude' => 37.550937, 'longitude' => 126.849642],
            ['city' => '서울시', 'district' => '관악구', 'full_address' => '서울시 관악구', 'latitude' => 37.478403, 'longitude' => 126.951614],
            ['city' => '서울시', 'district' => '광진구', 'full_address' => '서울시 광진구', 'latitude' => 37.538617, 'longitude' => 127.082375],
            ['city' => '부산시', 'district' => '해운대구', 'full_address' => '부산시 해운대구', 'latitude' => 35.163008, 'longitude' => 129.163462],
            ['city' => '부산시', 'district' => '부산진구', 'full_address' => '부산시 부산진구', 'latitude' => 35.162775, 'longitude' => 129.053922],
            ['city' => '인천시', 'district' => '중구', 'full_address' => '인천시 중구', 'latitude' => 37.473728, 'longitude' => 126.621668],
            ['city' => '인천시', 'district' => '남동구', 'full_address' => '인천시 남동구', 'latitude' => 37.448741, 'longitude' => 126.731547],
            ['city' => '경기도', 'district' => '수원시', 'full_address' => '경기도 수원시', 'latitude' => 37.263568, 'longitude' => 127.028606],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}