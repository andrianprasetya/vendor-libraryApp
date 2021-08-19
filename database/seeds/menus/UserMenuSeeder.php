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

        $roles = \App\Models\Role::where('slug','petugas-layanan')->pluck('id')->toArray();

        $menu = new \App\Models\Menu();

        $name = 'Kelola User';
        $menus = [
            'Member',
        ];
        $parent = $menu->create([
            'name' => $name,
            'icon' => 'ion ion-person'
        ]);
        foreach ($menus as $menuItem) {
            $menuData = $parent->children()->create([
                'name' => $menuItem,
                'slug' => 'web/' . \Illuminate\Support\Str::slug($menuItem),
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

        $name = 'Sirkulasi Menu';
        $menus = [
            'Peminjaman',
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
        $menus = [
            'Daftar Buku',
        ];
        $parent = $menu->create([
            'name' => $name,
            'icon' => 'fas fa-book'
        ]);
        foreach ($menus as $menuItem) {
            $menuData = $parent->children()->create([
                'name' => $menuItem,
                'slug' => 'web/book',
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
    }
}
