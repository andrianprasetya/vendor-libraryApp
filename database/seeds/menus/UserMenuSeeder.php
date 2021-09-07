<?php


use Illuminate\Database\Seeder;

class UserMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        \App\Models\MenuRole::query();
        \App\Models\Menu::query();

        $roles = \App\Models\Role::where('slug', 'petugas-layanan')->pluck('id')->toArray();
        $role_siswa = \App\Models\Role::where('slug', 'siswa')->pluck('id')->toArray();
        $role_petugas_layanan_teknis = \App\Models\Role::where('slug', 'petugas-layanan-teknis')->pluck('id')->toArray();
        $role_kepala_perpustakaan = \App\Models\Role::where('slug', 'kepala-perpustakaan')->pluck('id')->toArray();


        $menu = new \App\Models\Menu();

        $name = 'Member';
        $menuData = $menu->create([
            'name' => $name,
            'icon' => 'fas fa-users nav-icon',
            'slug' => 'web/member',
        ]);

        foreach ($roles as $role) {
            $menuData->roles()->attach($role, [
                'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                'accesses' => implode(config('access.delimiter'), config('access.menu.' . $menuData->slug . '.action')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            foreach ($role_petugas_layanan_teknis as $role) {
                $menuData->roles()->attach($role, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'accesses' => implode(config('access.delimiter'), config('access.menu.' . $menuData->slug . '.action')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $name = 'Sirkulasi Menu';
        $menus = [
            'Peminjaman',
            'Perpanjangan',
            'Denda',
        ];
        $parent = $menu->create([
            'name' => $name,
            'icon' => 'fas fa-bars'
        ]);
        foreach ($menus as $menuItem) {
            $menuData = $parent->children()->create([
                'name' => $menuItem,
                'slug' => 'web/sirkulasi/' . \Illuminate\Support\Str::slug($menuItem),
            ]);
            foreach ($roles as $role) {
                $menuData->roles()->attach($role, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'accesses' => implode(config('access.delimiter'), config('access.menu.' . $menuData->slug . '.action')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $name = 'Buku';
        $menuData = $menu->create([
            'name' => $name,
            'icon' => 'fas fa-book nav-icon',
            'slug' => 'web/book',
        ]);
            foreach ($role_petugas_layanan_teknis as $role) {
                $menuData->roles()->attach($role, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'accesses' => implode(config('access.delimiter'), config('access.menu.' . $menuData->slug . '.action')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }


        $name = 'OPAC';
        $menuData = $menu->create([
            'name' => $name,
            'icon' => 'far fa-circle nav-icon',
            'slug' => 'web/opac',
        ]);

        foreach ($roles as $role) {
            $menuData->roles()->attach($role, [
                'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                'accesses' => implode(config('access.delimiter'), config('access.menu.' . $menuData->slug . '.action')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        foreach ($role_kepala_perpustakaan as $role) {
            $menuData->roles()->attach($role, [
                'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                'accesses' => implode(config('access.delimiter'), config('access.menu.' . $menuData->slug . '.action')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        foreach ($role_siswa as $role) {
            $menuData->roles()->attach($role, [
                'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                'accesses' => implode(config('access.delimiter'), config('access.menu.' . $menuData->slug . '.action')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        $name = 'Laporan';
        $menus = [
            'name' => [
                0 => 'Report Member',
                1 => 'Report Koleksi',
                2 => 'Report Bahasa',
                3 => 'Report GMD'],
            'slug' => [
                0 => 'web/report/member',
                1 => 'web/report/collection',
                2 => 'web/report/language',
                3 => 'web/report/gmd']
        ];
        $parent = $menu->create([
            'name' => $name,
            'icon' => 'nav-icon far fa-file-alt'
        ]);
        for ($i = 0; $i < 4; $i++) {
            $menuData = $parent->children()->create([
                'name' => $menus['name'][$i],
                'slug' => $menus['slug'][$i],
            ]);
            foreach ($roles as $role) {
                $menuData->roles()->attach($role, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'accesses' => implode(config('access.delimiter'), config('access.menu.' . $menuData->slug . '.action')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            foreach ($role_kepala_perpustakaan as $role) {
                $menuData->roles()->attach($role, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'accesses' => implode(config('access.delimiter'), config('access.menu.' . $menuData->slug . '.action')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            foreach ($role_siswa as $role) {
                $menuData->roles()->attach($role, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'accesses' => implode(config('access.delimiter'), config('access.menu.' . $menuData->slug . '.action')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            foreach ($role_petugas_layanan_teknis as $role) {
                $menuData->roles()->attach($role, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'accesses' => implode(config('access.delimiter'), config('access.menu.' . $menuData->slug . '.action')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

        }
    }
}
