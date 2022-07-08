<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i = 1; $i <= 10; $i++){
            $faker = Faker::create('id_ID');
            $nama_guru = $faker->name;
            $tanggal_lahir = $faker->date('Y-m-d');
            $password = strtok($nama_guru, " ")."123";
            $bypass = Hash::make($password);
            $email = strtok($nama_guru, " ").'@gmail.com';

    		DB::table('guru')->insert([
                'nip' => $faker->randomDigitNotNull().$faker->numerify('######'),
                'nama_guru' => $nama_guru,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => $faker->streetName,
                'tanggal_lahir' => $tanggal_lahir,
                'alamat' => $faker->address,
                'telepon' => $faker->numerify('###############'),
                'agama' => 'Islam',
                'pendidikan' => $faker->randomElement(['SMA', 'SMP', 'SMA/SMAK', 'SMP/SMPK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3']),
                'email' => $email,
                'password' => $bypass,
                'remember_token' => Str::random(10),
                'level' => 'guru',
                'created_at' => $faker->dateTimeBetween('now'),
                'updated_at' => $faker->dateTimeBetween('now'),
    		]);
    	}
    }
}
