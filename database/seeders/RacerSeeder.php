<?php

namespace Database\Seeders;


use App\Models\Racer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RacerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $racers = [
            ['name' => 'Алекс Албон', 'country' => 'Таиланд', 'price' => 3000000, 'on_market' => true, 'avatar' => '/storage/racers/albon.webp' ],
            ['name' => 'Фернандо Алонсо', 'country' => 'Испания', 'price' => 5000000, 'on_market' => true, 'avatar' => '/storage/racers/alonso.webp' ],
            ['name' => 'Оливер Берман', 'country' => 'Великобритания', 'price' => 1200000, 'on_market' => true, 'avatar' => '/storage/racers/bearman.webp' ],
            ['name' => 'Валттери Боттас', 'country' => 'Финляндия', 'price' => 10000000, 'on_market' => true, 'avatar' => '/storage/racers/bottas.webp' ],
            ['name' => 'Пьер Гасли', 'country' => 'Франция', 'price' => 5000000, 'on_market' => true, 'avatar' => '/storage/racers/gasly.webp' ],
            ['name' => 'Франко Колапинто', 'country' => 'Аргентина', 'price' => 1500000, 'on_market' => true, 'avatar' => '/storage/racers/colapinto.webp' ],
            ['name' => 'Шарль Леклер', 'country' => 'Монако', 'price' => 36000000, 'on_market' => true, 'avatar' => '/storage/racers/leclerc.webp' ],
            ['name' => 'Кевин Магнуссен', 'country' => 'Дания', 'price' => 5000000, 'on_market' => true, 'avatar' => '/storage/racers/magnussen.webp' ],
            ['name' => 'Ландо Норрис', 'country' => 'Великобритания', 'price' => 20000000, 'on_market' => true, 'avatar' => '/storage/racers/norris.webp' ],
            ['name' => 'Эстебан Окон', 'country' => 'Франция', 'price' => 6000000, 'on_market' => true, 'avatar' => '/storage/racers/ocon.webp' ],
            ['name' => 'Серхио Перес', 'country' => 'Мексика', 'price' => 10000000, 'on_market' => true, 'avatar' => '/storage/racers/perez.webp' ],
            ['name' => 'Оскар Пиастри', 'country' => 'Австралия', 'price' => 15000000, 'on_market' => true, 'avatar' => '/storage/racers/piastri.webp' ],
            ['name' => 'Джордж Расселл', 'country' => 'Великобритания', 'price' => 8000000, 'on_market' => true, 'avatar' => '/storage/racers/russell.webp' ],
            ['name' => 'Даниэль Риккардо', 'country' => 'Австралия', 'price' => 6000000, 'on_market' => true, 'avatar' => '/storage/racers/ricciardo.webp' ],
            ['name' => 'Карлос Сайнс-мл.', 'country' => 'Испания', 'price' => 10000000, 'on_market' => true, 'avatar' => '/storage/racers/sainz.webp' ],
            ['name' => 'Логан Сарджент', 'country' => 'США', 'price' => 1000000, 'on_market' => true, 'avatar' => '/storage/racers/sergant.jpg' ],
            ['name' => 'Лэнс Стролл', 'country' => 'Канада', 'price' => 2000000, 'on_market' => true, 'avatar' => '/storage/racers/stroll.webp' ],
            ['name' => 'Макс Ферстаппен', 'country' => 'Нидерланды', 'price' => 55000000, 'on_market' => true, 'avatar' => '/storage/racers/verstappen.webp' ],
            ['name' => 'Нико Хюлькенберг', 'country' => 'Германия', 'price' => 2000000, 'on_market' => true, 'avatar' => '/storage/racers/hulkenberg.webp' ],
            ['name' => 'Льюис Хэмилтон', 'country' => 'Великобритания', 'price' => 35000000, 'on_market' => true, 'avatar' => '/storage/racers/hamilton.webp' ],
            ['name' => 'Юки Цунода', 'country' => 'Япония', 'price' => 2500000, 'on_market' => true, 'avatar' => '/storage/racers/tsunoda.webp' ],
            ['name' => 'Чжоу Гуаньюй', 'country' => 'Китай', 'price' => 1500000, 'on_market' => true, 'avatar' => '/storage/racers/guanyu.webp' ]
        ];

        Racer::insert($racers);
    }
}
