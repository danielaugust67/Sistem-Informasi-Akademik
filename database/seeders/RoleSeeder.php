<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $adminSekolah = Role::firstOrCreate(['name' => 'admin_sekolah', 'guard_name' => 'web']);
        $kepalaSekolah = Role::firstOrCreate(['name' => 'kepala_sekolah', 'guard_name' => 'web']);
        $guru = Role::firstOrCreate(['name' => 'guru', 'guard_name' => 'web']);
        $waliKelas = Role::firstOrCreate(['name' => 'wali_kelas', 'guard_name' => 'web']);
        $siswa = Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);
        $tataUsaha = Role::firstOrCreate(['name' => 'tata_usaha', 'guard_name' => 'web']);

        $allPermissions = Permission::all();

        // 1. Super Admin
        $superAdmin->syncPermissions($allPermissions);

        // 2. Admin Sekolah
        $adminSekolah->syncPermissions($allPermissions->filter(fn($p) => 
            !str_contains($p->name, 'Institution') && !str_contains($p->name, 'Role')
        ));

        // 3. Kepala Sekolah (Hanya bisa VIEW Semua Data + Lihat Widget)
        // Permission pattern: "ViewAny:Model" or "View:Model" or "View:WidgetName"
        $kepalaSekolah->syncPermissions($allPermissions->filter(fn($p) => 
            str_starts_with($p->name, 'ViewAny:') || str_starts_with($p->name, 'View:')
        ));

        // 4. Guru (Hanya bisa akses Jadwal, Kelas, presensi & input nilai)
        $guruPermissions = $allPermissions->filter(function($p) {
            if (in_array($p->name, ['View:DashboardStats', 'View:StudentRombelChart'])) return true;
            
            $allowed = ['ClassRoom', 'StudentProfile', 'Schedule', 'Attendance', 'Grade', 'Syllabus', 'Assessment'];
            foreach ($allowed as $mod) {
                if (str_contains($p->name, ":{$mod}")) {
                    if (str_starts_with($p->name, 'Delete') && !in_array($mod, ['Attendance', 'Grade', 'Syllabus'])) return false;
                    if ((str_starts_with($p->name, 'Create') || str_starts_with($p->name, 'Update')) && in_array($mod, ['ClassRoom', 'Schedule', 'StudentProfile'])) return false;
                    return true;
                }
            }
            return false;
        });
        $guru->syncPermissions($guruPermissions);

        // 5. Wali Kelas (Wewenang Guru + bisa update status Rombel & data Siswa perwakilan)
        $waliKelasPermissions = $allPermissions->filter(function($p) use ($guruPermissions) {
            if ($guruPermissions->contains('name', $p->name)) return true;
            if (str_contains($p->name, 'Rombel') || str_contains($p->name, 'StudentProfile')) {
                if (!str_starts_with($p->name, 'Delete')) return true; // bisa create, update, view
            }
            return false;
        });
        $waliKelas->syncPermissions($waliKelasPermissions);

        // 6. Siswa (Hanya Lihat Nilai, Presensi, Jadwal, Tagihan. Tanpa Graphic Widget)
        $siswaPermissions = $allPermissions->filter(function($p) {
            // No widgets for student
            if (str_contains($p->name, 'Widget')) return false; 
            
            $allowed = ['Enrollment', 'Schedule', 'Attendance', 'Grade', 'Payment', 'PaymentDetail', 'Syllabus'];
            foreach ($allowed as $mod) {
                if (str_contains($p->name, ":{$mod}")) {
                    if (str_starts_with($p->name, 'ViewAny:') || str_starts_with($p->name, 'View:')) return true;
                }
            }
            return false;
        });
        $siswa->syncPermissions($siswaPermissions);

        // 7. Tata Usaha (Penuh ke Billing/Tagihan dan Data Akademik Dasar)
        $tuPermissions = $allPermissions->filter(function($p) {
            if (in_array($p->name, ['View:PaymentStatusChart', 'View:DashboardStats'])) return true;
            
            $allowed = ['Payment', 'PaymentDetail', 'User', 'StudentProfile', 'TeacherProfile', 'Rombel', 'AcademicYear', 'Semester'];
            foreach ($allowed as $mod) {
                if (str_contains($p->name, ":{$mod}")) return true;
            }
            return false;
        });
        $tataUsaha->syncPermissions($tuPermissions);
    }
}
