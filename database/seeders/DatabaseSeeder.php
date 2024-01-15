<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Choice;
use App\Models\Member;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $subdomain = "user{$i}";

            $tenant = Tenant::create(['id' => $subdomain]);
            $tenant->domains()->create(['domain' => "{$subdomain}.localhost"]);

            $tenant->run(function () use ($subdomain) {
                User::factory()->create([
                    'name' => $subdomain,
                    'email' => "{$subdomain}@quiz.com",
                ]);

                Member::factory()->create([
                    'name' => 'member1',
                    'email' => "member1@quiz.com",
                ]);

                Quiz::factory()
                    ->count(rand(2, 10))
                    ->has(
                        Question::factory()
                            ->count(rand(5, 10))
                            ->has(
                                Choice::factory()
                                    ->count(5)
                                    ->sequence(fn (Sequence $sequence) => ['order' => ($sequence->index + 1) % 5])
                            )
                    )
                    ->create();
            });
        }
    }
}
