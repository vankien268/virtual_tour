<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataP = [
            [
                'name' => 'Danh sách tài khoản'
            ],
            [
                'name' => 'Thêm tài khoản'
            ],
            [
                'name' => 'Sửa tài khoản'
            ],
            [
                'name' => 'Xóa tài khoản'
            ],
            [
                'name' => 'Danh sách khu vực'
            ],
            [
                'name' => 'Thêm khu vực'
            ],
            [
                'name' => 'Sửa khu vực'
            ],
            [
                'name' => 'Xóa khu vực'
            ],
            [
                'name' => 'Danh sách địa điểm'
            ],
            [
                'name' => 'Thêm địa điểm'
            ],
            [
                'name' => 'Sửa địa điểm'
            ],
            [
                'name' => 'Xóa địa điểm'
            ],
            [
                'name' => 'Sửa bài thuyết trình'
            ],
            [
                'name' => 'Thêm bài thuyết trình'
            ],
            [
                'name' => 'Danh sách tin tức'
            ],
            [
                'name' => 'Thêm tin tức'
            ],
            [
                'name' => 'Sửa tin tức'
            ],
            [
                'name' => 'Xóa tin tức'
            ],
            [
                'name' => 'Danh sách ngôn ngữ'
            ],
            [
                'name' => 'Thêm ngôn ngữ'
            ],
            [
                'name' => 'Sửa ngôn ngữ'
            ],
            [
                'name' => 'Xóa ngôn ngữ'
            ],
        ];
        foreach ($dataP as $key => $value) {
            Permission::create($value);
        }

        $dataR = [
            [
                'name' => 'Super Admin'
            ],
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Editor'
            ],
        ];
        foreach ($dataR as $key => $value) {
            Role::create($value);
        }
        $userSAdmin = User::find(1);//s-admin
        $roleSAdmin = Role::find(1);
        $userSAdmin->assignRole($roleSAdmin);
        $roleSAdmin->givePermissionTo($dataP);

        //admin
        $dataPAdmin = [
            [
                'name' => 'Danh sách tài khoản'
            ],
            [
                'name' => 'Thêm tài khoản'
            ],
            [
                'name' => 'Sửa tài khoản'
            ],
            [
                'name' => 'Xóa tài khoản'
            ],
            [
                'name' => 'Danh sách địa điểm'
            ],
            [
                'name' => 'Thêm địa điểm'
            ],
            [
                'name' => 'Sửa địa điểm'
            ],
            [
                'name' => 'Xóa địa điểm'
            ],
            [
                'name' => 'Sửa bài thuyết trình'
            ],
            [
                'name' => 'Thêm bài thuyết trình'
            ],
            [
                'name' => 'Danh sách tin tức'
            ],
            [
                'name' => 'Thêm tin tức'
            ],
            [
                'name' => 'Sửa tin tức'
            ],
            [
                'name' => 'Xóa tin tức'
            ],
        ];
        $userAdmin = User::find(2);//admin
        $roleAdmin = Role::find(2);
        $userAdmin->assignRole($roleAdmin);
        $roleAdmin->givePermissionTo($dataPAdmin);

        //user
        $dataPEditor = [
            [
                'name' => 'Danh sách địa điểm'
            ],
            [
                'name' => 'Thêm địa điểm'
            ],
            [
                'name' => 'Sửa địa điểm'
            ],
            [
                'name' => 'Xóa địa điểm'
            ],
            [
                'name' => 'Sửa bài thuyết trình'
            ],
            [
                'name' => 'Thêm bài thuyết trình'
            ],
            [
                'name' => 'Danh sách tin tức'
            ],
            [
                'name' => 'Thêm tin tức'
            ],
            [
                'name' => 'Sửa tin tức'
            ],
            [
                'name' => 'Xóa tin tức'
            ],
        ];
        $user = User::find(3);//user
        $roleEditor = Role::find(3);
        $user->assignRole($roleEditor);
        $roleEditor->givePermissionTo($dataPEditor);
    }
}
