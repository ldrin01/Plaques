<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PlaquesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->users(); 
        $this->services();
        $this->carousel();
        $this->servicesPictures();
    }

    function users(){
        echo "  USERS\n";
        $name = array("Eldrin Bernardino","Ronnel Avila","Charlie Quiza");
        $name2 = array("eldrinbernardino01","ronnelavila","charliequiza");

        $i=0;
        while ($i < 3) {
            DB::table('users')->insert([
                'name' => $name[$i],
                'avatar' => "",
                'is_what' => 0,
                'email' => $name2[$i]."@gmail.com",
                'password' => bcrypt('qwerty'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            echo "    |Name: ".$name[$i]."\n    |Password: qwerty\n\n";
            $i++;
        }
    }

    function services(){
        echo "  SERVICES\n";
        $services = array("Plaques","Trophies");

        $i=0;
        while ($i < 2) {
            DB::table('services')->insert([
                'service' => $services[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            echo "    | ".($i+1).") ".$services[$i]."\n";
            $i++;
        }
    }

    function carousel(){
        echo "  CAROUSEL\n";
        $path = array("carousel/pic1.jpg","carousel/pic2.jpg");

        $i=0;
        while ($i < 2) {
            DB::table('carousel')->insert([
                'path' => $path[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            echo "    | ".($i+1).") ".$path[$i]."\n";
            $i++;
        }
    }

    function servicesPictures(){
        echo "  SERVICES PICTURES\n";
        $path = array("services/plaques/plaques1.jpg",
            "services/plaques/plaques2.jpg",
            "services/plaques/plaques3.jpg",
            "services/plaques/plaques4.jpg",
            "services/plaques/plaques5.jpg",
            "services/plaques/plaques6.jpg",
            "services/plaques/plaques7.jpg",
            "services/trophies/trophies1.jpg",
            "services/trophies/trophies2.jpg",
            "services/trophies/trophies3.jpg",
            "services/trophies/trophies4.jpg",
            "services/trophies/trophies5.jpg",
            "services/trophies/trophies6.jpg",
            "services/trophies/trophies7.jpg"
        );

        $i=0;
        $a=0;
        $count=0;
        while ($a < 2){
            while ($i < 7) {
                DB::table('pictures')->insert([
                    'name' => str_random(7),
                    'path' => $path[$count],
                    'service_id' => $a+1,
                    'price' => rand(800, 1500),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                echo "    | ".($count+1).") ".$path[$count]."\n";
                $i++;
                $count++;
            }
            $a++;
            $i = 0;
        }
    }
}
