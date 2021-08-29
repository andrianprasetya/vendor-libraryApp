<?php


use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new \App\Models\Role();
        $RoleName1 = 'Petugas Layanan';
        $RoleName2 = 'Kepala Perpustakaan';
        $RoleName3 = 'Siswa';
        $RoleName4 = 'Petugas Layanan Teknis';

        $userData1 = User::create([
            'name' => 'testPetugasLayanan',
            'email' => 'testpetugaslayanan@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
            'nis' => '12345678'
        ]);

        $adminRoleModel1 = $role->create([
            'name' => $RoleName1,
            'slug' => \Illuminate\Support\Str::slug($RoleName1)
        ]);

        $userData1->roles()->attach($adminRoleModel1->id, [
            'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $userData2 = User::create([
            'name' => 'testKepalaPerpustakaan',
            'email' => 'testkepalaperpustakaan@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
            'nis' => '1'
        ]);

        $adminRoleModel2 = $role->create([
            'name' => $RoleName2,
            'slug' => \Illuminate\Support\Str::slug($RoleName2)
        ]);

        $userData2->roles()->attach($adminRoleModel2->id, [
            'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $userData3 = User::create([
            'name' => 'testSiswa',
            'email' => 'testsiswa@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
            'nis' => '2'
        ]);

        $adminRoleModel3 = $role->create([
            'name' => $RoleName3,
            'slug' => \Illuminate\Support\Str::slug($RoleName3)
        ]);

        $userData3->roles()->attach($adminRoleModel3->id, [
            'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $userData4 = User::create([
            'name' => 'testPetugasTeknis',
            'email' => 'testpetugasteknis@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
            'nis' => '3'
        ]);

        $adminRoleModel4 = $role->create([
            'name' => $RoleName4,
            'slug' => \Illuminate\Support\Str::slug($RoleName4)
        ]);

        $userData4->roles()->attach($adminRoleModel4->id, [
            'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
