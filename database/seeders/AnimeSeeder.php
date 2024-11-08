<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anime;
use Carbon\Carbon;

class AnimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimeStamp = Carbon::now();
        Anime::insert([
            ['title' => 'Bleach','description'=> 'A world where shinigami fight dangerous creatures called hollows','image'=> 'images/Bleach-cover.jpg','numberOfEp' => 386, 'created_at' => $currentTimeStamp, 'updated_at'=> $currentTimeStamp],
            ['title' => 'One Piece','description'=> 'Follow the story that crosses the seas to fine the greatest treasure','image'=> 'images/one-piece-cover.png','numberOfEp' => 1136, 'created_at' => $currentTimeStamp, 'updated_at'=> $currentTimeStamp]
        ]);
    }
}
