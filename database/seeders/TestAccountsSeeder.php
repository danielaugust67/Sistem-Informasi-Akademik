<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Institution;

class TestAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $institution = Institution::first();
        $instId = $institution ? $institution->id : null;

        $accounts = [
            ['name' => 'Bpk. Kepala Sekolah', 'email' => 'kepsek@sman1.sch.id', 'role_name' => 'kepala_sekolah'],
            ['name' => 'Budi Guru', 'email' => 'guru@sman1.sch.id', 'role_name' => 'guru'],
            ['name' => 'Ibu Sita (Wali Kelas)', 'email' => 'walikelas@sman1.sch.id', 'role_name' => 'wali_kelas'],
            ['name' => 'Agus Siswa', 'email' => 'siswa@sman1.sch.id', 'role_name' => 'siswa'],
            ['name' => 'Bagas TU (Tata Usaha)', 'email' => 'tu@sman1.sch.id', 'role_name' => 'tata_usaha'],
            ['name' => 'Admin Sekolah', 'email' => 'admin_sekolah@sman1.sch.id', 'role_name' => 'admin_sekolah']
        ];

        foreach ($accounts as $acc) {
            $user = User::updateOrCreate(
                ['email' => $acc['email']],
                [
                    'name' => $acc['name'],
                    'password' => Hash::make('password'),
                    'is_active' => true,
                    'institution_id' => $instId
                ]
            );

            // Dapatkan role berdasarkan nama (mis: 'guru') dan pasang ke pivot DB 
            $roleModel = \Spatie\Permission\Models\Role::where('name', $acc['role_name'])->first();
            if ($roleModel) {
                // Bersihkan role sebelumnya jika ada, just in case
                DB::table('model_has_roles')->where('model_id', $user->id)->delete();
                
                DB::table('model_has_roles')->insert([
                    'role_id' => $roleModel->id,
                    'model_type' => 'App\Models\User',
                    'model_id' => $user->id
                ]);
            }
        }
    }
}