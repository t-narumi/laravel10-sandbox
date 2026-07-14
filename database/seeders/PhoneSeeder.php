<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Phone;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Phone::query()->exists()) {
            return;
        }

        if (!Member::query()->exists()) {
            $this->call(MemberSeeder::class);
        }

        $members = Member::query()->orderBy('id')->get(['id']);

        if ($members->isEmpty()) {
            return;
        }

        $models = [
            'iPhone 14',
            'iPhone 15',
            'Pixel 8',
            'Pixel 9',
            'Galaxy S23',
            'Galaxy S24',
            'Xperia 1 V',
            'AQUOS R8',
            'OPPO Reno11 A',
            'Xiaomi 14T',
        ];

        $startDates = [
            '2021-04-01',
            '2021-10-01',
            '2022-04-01',
            '2022-10-01',
            '2023-04-01',
            '2023-10-01',
            '2024-04-01',
            '2024-10-01',
            '2025-04-01',
            '2025-10-01',
        ];

        $now = now();
        $rows = [];

        foreach ($members as $index => $member) {
            $rows[] = [
                'member_id' => $member->id,
                'phone_number' => sprintf('090-%04d-%04d', 1000 + $index, 5000 + $index),
                'phone_model' => $models[$index % count($models)],
                'started_on' => $startDates[$index % count($startDates)],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Phone::insert($rows);
    }
}
