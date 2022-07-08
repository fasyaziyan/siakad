<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Guru;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

$factory->define(Guru::class, function (Faker $faker) {
    $nama_guru = $faker->firstName;
    $tanggal_lahir = $faker->date('d/m/Y');
    $password = strtok($nama_guru, " ").substr($tanggal_lahir, -4);
    $bypass = Hash::make($password);
    $email = strtok($nama_guru, " ").'@gmail.com';
    // $faker = Faker::create('id_ID');

    return [
        'nip' => $faker->numerify('##################'),
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
    ];
});
