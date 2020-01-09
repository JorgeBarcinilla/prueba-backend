<?php

use Illuminate\Database\Seeder;
use Faker\Factory  as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    //esta funcion ejecuta el seeder para guardar los paises y ciudades definidas.
    public function run()
    {
        $locations = [
            ['country'=>'Alemania', 'cities'=>['Berlin','Munich','Frankfurt','Dusseldoft']],
            ['country'=>'Argentina', 'cities'=>['Mendoza','Buenos aires','Rosario','Cordoba']],
            ['country'=>'Brasil', 'cities'=>['Sao paulo','Rio de janeiro','Recife','Brasilia']],
            ['country'=>'Canada', 'cities'=>['Otawa','Toronto','Montreal','Quebec']],
            ['country'=>'Colombia', 'cities'=>['Barranquilla','Bogotá','Cali','Medellin']],
            ['country'=>'España', 'cities'=>['Madrid','Valencia','Barcelona','Sevilla']],
            ['country'=>'Estados unidos', 'cities'=>['Washinton','Nueva york','Chicago','Los angeles']],
            ['country'=>'Francia', 'cities'=>['Paris','Lyon','Marsella','Niza']],
            ['country'=>'Italia', 'cities'=>['Roma','Milan','Turin','Venesia']],
            ['country'=>'Mexico', 'cities'=>['Ciudad de mexico','Monterrey','Guadalajara','Puebla']]
        ];

        // Este foreach recorre el arreglo de lugares.
        $country_id = 1;
        foreach ($locations as $location) {

            DB::table('countries')->insert([
                'name' => $location['country']
            ]);

            //Este foreach recorre las ciudades de un pais y las guarda con la respectiva llave forranea del pais
            $city_id = 1;
            foreach($location['cities'] as $city){

                DB::table('cities')->insert([
                    'name' => $city,
                    'country_id' => $country_id,
                ]);

                $city_id ++;
            }

            $country_id ++;
        }

        //Se usa faker para generar datos de personas con fines de prueba
        $faker = Faker::create();
        for ($i=0; $i < 10; $i++) {
            $id_country = $faker->numberBetween(1,10);
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'surnames' => $faker->lastName.' '.$faker->lastName,
                'identification' => $faker->unique()->numberBetween(1000000,9999999999),
                'date_birth' => $faker->date,
                'country_id' => $id_country,
                'city_id' => ($faker->numberBetween(1,4)+$id_country)
            ]);
        }
        
    }
}
