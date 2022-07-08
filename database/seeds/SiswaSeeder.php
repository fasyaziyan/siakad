<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 90; $i++){
            $faker = Faker::create('id_ID');
            $nama_siswa = $faker->name;
            $tanggal_lahir = $faker->date('Y-m-d');
            $password = strtok($nama_siswa, " ")."123";
            $bypass = Hash::make($password);
            $email = strtok($nama_siswa, " ").'@gmail.com';
            $jenis_kelamin = $faker->randomElement(['Laki-laki', 'Perempuan']);

            DB::table('siswa')->insert([
                'nisn' => $faker->randomDigitNotNull().$faker->numerify('#######'),
                'nama' => $nama_siswa,
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $tanggal_lahir,
                'nama_ayah' => $faker->firstName($jenis_kelamin),
                'nama_ibu' => $faker->firstName($jenis_kelamin),
                'alamat' => $faker->address,
                'telepon' => $faker->numerify('###############'),
                'agama' => 'Islam',
                'id_kelas' => $faker->randomElement(['KLS-000001', 'KLS-000002', 'KLS-000003', 'KLS-000004', 'KLS-000005', 'KLS-000006']),
                'created_at' => $faker->dateTimeBetween('now'),
                'updated_at' => $faker->dateTimeBetween('now'),
                'email' => $email,
                'password' => $bypass,
                'remember_token' => Str::random(10),
                'level' => 'siswa',
            ]);
        }
    }
}
