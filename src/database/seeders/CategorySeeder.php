<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => '건설/토목', 'slug' => 'construction', 'description' => '건축, 토목, 인테리어 관련 일자리', 'sort_order' => 1],
            ['name' => '제조/생산', 'slug' => 'manufacturing', 'description' => '공장, 제조업 관련 일자리', 'sort_order' => 2],
            ['name' => '물류/배송', 'slug' => 'logistics', 'description' => '택배, 배송, 운송 관련 일자리', 'sort_order' => 3],
            ['name' => '서비스/판매', 'slug' => 'service', 'description' => '판매, 서비스업 관련 일자리', 'sort_order' => 4],
            ['name' => '청소/환경', 'slug' => 'cleaning', 'description' => '청소, 환경 관리 관련 일자리', 'sort_order' => 5],
            ['name' => '농업/어업', 'slug' => 'agriculture', 'description' => '농업, 어업, 축산업 관련 일자리', 'sort_order' => 6],
            ['name' => '요식업', 'slug' => 'food-service', 'description' => '식당, 카페, 요식업 관련 일자리', 'sort_order' => 7],
            ['name' => '기타', 'slug' => 'others', 'description' => '기타 일용직 일자리', 'sort_order' => 8],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}