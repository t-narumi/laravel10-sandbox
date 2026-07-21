<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('member_role')->exists()) {
            return;
        }

        if (!Member::query()->exists()) {
            $this->call(MemberSeeder::class);
        }

        if (!Role::query()->exists()) {
            $this->call(RoleSeeder::class);
        }

        $members = Member::query()->orderBy('id')->get(['id']);
        $roleIds = Role::query()->orderBy('id')->pluck('id')->all();

        if ($members->isEmpty() || $roleIds === []) {
            return;
        }

        $now = now();
        $rows = [];
        $roleCount = count($roleIds);

        foreach ($members as $index => $member) {
            $assignCount = match ($index % 4) {
                1 => 2,
                2 => 3,
                default => 1,
            };

            for ($i = 0; $i < $assignCount; $i++) {
                $rows[] = [
                    'member_id' => $member->id,
                    'role_id' => $roleIds[($index + $i) % $roleCount],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        DB::table('member_role')->insert($rows);
    }
}
