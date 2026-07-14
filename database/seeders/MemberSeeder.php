<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Member::query()->exists()) {
            return;
        }

        $members = [
            ['name' => 'Tomy', 'age' => 20],
            ['name' => 'Kevin', 'age' => 21],
            ['name' => 'Alex', 'age' => 22],
            ['name' => 'Brian', 'age' => 23],
            ['name' => 'Chris', 'age' => 24],
            ['name' => 'Daniel', 'age' => 25],
            ['name' => 'Eric', 'age' => 26],
            ['name' => 'Frank', 'age' => 27],
            ['name' => 'Gary', 'age' => 28],
            ['name' => 'Henry', 'age' => 29],
            ['name' => 'Ivan', 'age' => 30],
            ['name' => 'Jack', 'age' => 31],
            ['name' => 'Kyle', 'age' => 32],
            ['name' => 'Leo', 'age' => 33],
            ['name' => 'Mike', 'age' => 34],
            ['name' => 'Nate', 'age' => 35],
            ['name' => 'Owen', 'age' => 36],
            ['name' => 'Paul', 'age' => 37],
            ['name' => 'Quinn', 'age' => 38],
            ['name' => 'Ryan', 'age' => 39],
            ['name' => 'Sean', 'age' => 40],
            ['name' => 'Tony', 'age' => 41],
            ['name' => 'Victor', 'age' => 42],
            ['name' => 'Will', 'age' => 43],
            ['name' => 'Zack', 'age' => 44],
            ['name' => 'Kenta', 'age' => 45],
            ['name' => 'Yuta', 'age' => 46],
            ['name' => 'Sota', 'age' => 47],
            ['name' => 'Ren', 'age' => 48],
            ['name' => 'Kaito', 'age' => 49],
            ['name' => 'Riku', 'age' => 50],
            ['name' => 'Daiki', 'age' => 51],
            ['name' => 'Shun', 'age' => 52],
            ['name' => 'Takuya', 'age' => 53],
            ['name' => 'Ryota', 'age' => 54],
            ['name' => 'Sho', 'age' => 55],
            ['name' => 'Kota', 'age' => 56],
            ['name' => 'Masato', 'age' => 57],
            ['name' => 'Yuji', 'age' => 58],
            ['name' => 'Naoki', 'age' => 59],
            ['name' => 'Keita', 'age' => 60],
            ['name' => 'Taichi', 'age' => 61],
            ['name' => 'Jun', 'age' => 62],
            ['name' => 'Akira', 'age' => 63],
            ['name' => 'Koji', 'age' => 64],
            ['name' => 'Tsubasa', 'age' => 65],
            ['name' => 'Hiro', 'age' => 66],
            ['name' => 'Takumi', 'age' => 67],
            ['name' => 'Yusuke', 'age' => 68],
            ['name' => 'Haruto', 'age' => 69],
        ];

        $now = now();

        foreach ($members as $index => &$member) {
            $member['withdrawn_on'] = match ($index % 15) {
                4 => '2024-03-31',
                9 => '2024-12-31',
                14 => '2025-06-30',
                default => null,
            };
            $member['created_at'] = $now;
            $member['updated_at'] = $now;
        }
        unset($member);

        Member::insert($members);
    }
}
