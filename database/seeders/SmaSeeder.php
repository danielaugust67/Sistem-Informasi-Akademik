<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\{Institution, AcademicYear, Semester, Department, StudyProgram, Curriculum, User, TeacherProfile, Rombel, StudentProfile, Subject, ClassRoom, Enrollment, Payment, PaymentDetail};
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SmaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Institution
        $institution = Institution::create([
            'name' => 'SMA Negeri 1 Nusantara',
            'type' => 'Sekolah Menengah Atas',
            'slug' => 'sman1-nusantara',
            'settings' => ['address' => 'Jl. Pendidikan No. 1, Jakarta']
        ]);

        // Update Super Admin
        User::where('email', 'admin@admin.com')->update(['institution_id' => $institution->id]);

        // 2. Academic Year & Semester
        $academicYear = AcademicYear::create([
            'institution_id' => $institution->id,
            'year' => '2025/2026',
            'status' => 'active'
        ]);

        $semesterGanjil = Semester::create([
            'academic_year_id' => $academicYear->id,
            'type' => 'odd',
            'start_date' => '2025-07-15',
            'end_date' => '2025-12-20'
        ]);

        // 3. Departments & Study Programs
        $deptMIPA = Department::create(['institution_id' => $institution->id, 'code' => 'MIPA', 'name' => 'Matematika dan Ilmu Pengetahuan Alam']);
        $deptIPS = Department::create(['institution_id' => $institution->id, 'code' => 'IPS', 'name' => 'Ilmu Pengetahuan Sosial']);

        $progMIPA = StudyProgram::create(['department_id' => $deptMIPA->id, 'code' => 'MIPA', 'name' => 'MIPA Reguler', 'level' => 'SMA']);
        $progIPS = StudyProgram::create(['department_id' => $deptIPS->id, 'code' => 'IPS', 'name' => 'IPS Reguler', 'level' => 'SMA']);

        // 4. Curriculum
        $curriculum = Curriculum::create(['institution_id' => $institution->id, 'name' => 'Kurikulum Merdeka 2024', 'year' => '2024', 'is_active' => true]);

        // Roles IDs
        $guruRoleId = Role::where('name', 'guru')->first()->id ?? 4;
        $siswaRoleId = Role::where('name', 'siswa')->first()->id ?? 5;

        // 5. Teachers (15 Guru)
        $teachers = [];
        for ($i = 1; $i <= 15; $i++) {
            $user = User::create([
                'institution_id' => $institution->id,
                'name' => $faker->name,
                'email' => "guru{$i}@sman1.sch.id",
                'password' => Hash::make('password'),
                'is_active' => true
            ]);

            DB::table('model_has_roles')->insertOrIgnore([
                'role_id' => $guruRoleId,
                'model_type' => 'App\Models\User',
                'model_id' => $user->id
            ]);

            $teachers[] = TeacherProfile::create([
                'user_id' => $user->id,
                'nip_nidn' => $faker->unique()->numerify('198#######20####'),
                'department_id' => ($i % 2 == 0) ? $deptMIPA->id : $deptIPS->id,
                'specialization' => 'Mata Pelajaran Umum'
            ]);
        }

        // 6. Rombel (6 Kelas)
        $rombels = [
            Rombel::create(['institution_id' => $institution->id, 'academic_year_id' => $academicYear->id, 'name' => 'X-MIPA 1', 'homeroom_teacher_id' => $teachers[0]->id, 'capacity' => 30]),
            Rombel::create(['institution_id' => $institution->id, 'academic_year_id' => $academicYear->id, 'name' => 'X-MIPA 2', 'homeroom_teacher_id' => $teachers[1]->id, 'capacity' => 30]),
            Rombel::create(['institution_id' => $institution->id, 'academic_year_id' => $academicYear->id, 'name' => 'X-IPS 1', 'homeroom_teacher_id' => $teachers[2]->id, 'capacity' => 30]),
            Rombel::create(['institution_id' => $institution->id, 'academic_year_id' => $academicYear->id, 'name' => 'XI-MIPA 1', 'homeroom_teacher_id' => $teachers[3]->id, 'capacity' => 30]),
            Rombel::create(['institution_id' => $institution->id, 'academic_year_id' => $academicYear->id, 'name' => 'XI-IPS 1', 'homeroom_teacher_id' => $teachers[4]->id, 'capacity' => 30]),
            Rombel::create(['institution_id' => $institution->id, 'academic_year_id' => $academicYear->id, 'name' => 'XII-MIPA 1', 'homeroom_teacher_id' => $teachers[5]->id, 'capacity' => 30])
        ];

        // 7. Students (20 siswa per Rombel = Total 120 Siswa)
        $students = [];
        foreach ($rombels as $rombel) {
            $isMIPA = str_contains($rombel->name, 'MIPA');
            $studyProgId = $isMIPA ? $progMIPA->id : $progIPS->id;

            for ($i = 1; $i <= 20; $i++) {
                $user = User::create([
                    'institution_id' => $institution->id,
                    'name' => $faker->firstName . ' ' . $faker->lastName,
                    'email' => "siswa." . strtolower(Str::random(5)) . "@sman1.sch.id",
                    'password' => Hash::make('password'),
                    'is_active' => true
                ]);

                DB::table('model_has_roles')->insertOrIgnore([
                    'role_id' => $siswaRoleId,
                    'model_type' => 'App\Models\User',
                    'model_id' => $user->id
                ]);

                $students[] = StudentProfile::create([
                    'user_id' => $user->id,
                    'nis_nim' => $faker->unique()->numerify('24####'),
                    'study_program_id' => $studyProgId,
                    'rombel_id' => $rombel->id,
                    'academic_advisor_id' => $rombel->homeroom_teacher_id,
                    'status' => 'active',
                    'enrolled_at' => now()
                ]);
            }
        }

        // 8. Subjects
        $subjects = [
            Subject::create(['institution_id' => $institution->id, 'curriculum_id' => $curriculum->id, 'code' => 'MTK01', 'name' => 'Matematika Umum', 'credit_hours' => 4, 'level' => '10']),
            Subject::create(['institution_id' => $institution->id, 'curriculum_id' => $curriculum->id, 'code' => 'IND01', 'name' => 'Bahasa Indonesia', 'credit_hours' => 4, 'level' => '10']),
            Subject::create(['institution_id' => $institution->id, 'curriculum_id' => $curriculum->id, 'code' => 'ENG01', 'name' => 'Bahasa Inggris', 'credit_hours' => 4, 'level' => '10']),
            Subject::create(['institution_id' => $institution->id, 'curriculum_id' => $curriculum->id, 'code' => 'BIO01', 'name' => 'Biologi', 'credit_hours' => 3, 'level' => '10']),
            Subject::create(['institution_id' => $institution->id, 'curriculum_id' => $curriculum->id, 'code' => 'FIS01', 'name' => 'Fisika', 'credit_hours' => 3, 'level' => '10']),
            Subject::create(['institution_id' => $institution->id, 'curriculum_id' => $curriculum->id, 'code' => 'SEJ01', 'name' => 'Sejarah Indonesia', 'credit_hours' => 2, 'level' => '10'])
        ];

        // 9. Ruang Kelas (ClassRooms) & Enrollments (KRS Masal)
        foreach ($rombels as $rombel) {
            foreach ($subjects as $subject) {
                // Biologi/Fisika hanya untuk MIPA
                if (in_array($subject->code, ['BIO01', 'FIS01']) && str_contains($rombel->name, 'IPS')) {
                    continue;
                }

                $classRoom = ClassRoom::create([
                    'subject_id' => $subject->id,
                    'semester_id' => $semesterGanjil->id,
                    'rombel_id' => $rombel->id,
                    'capacity' => 35,
                    'room_code' => 'R.' . rand(100, 300)
                ]);

                // Assign Teacher to ClassRoom
                DB::table('class_room_teacher')->insert([
                    'class_room_id' => $classRoom->id,
                    'teacher_profile_id' => $teachers[rand(0, 14)]->id,
                    'is_primary' => true
                ]);

                // Daftarkan siswa dari rombel ke dalam mapel/ruang kelas ini (Enrollment)
                $rombelStudents = array_filter($students, fn($s) => $s->rombel_id === $rombel->id);
                foreach ($rombelStudents as $student) {
                    Enrollment::create([
                        'student_id' => $student->id,
                        'class_room_id' => $classRoom->id,
                        'status' => 'approved',
                        'enrolled_at' => now()
                    ]);
                }
            }
        }

        // 10. Sample Payments (Tagihan SPP)
        for ($i = 0; $i < 20; $i++) {
            $student = $students[rand(0, count($students) - 1)];
            
            $payment = Payment::create([
                'student_id' => $student->id,
                'semester_id' => $semesterGanjil->id,
                'total_amount' => 500000,
                'status' => rand(0, 1) ? 'paid' : 'unpaid',
                'invoice_no' => 'INV-SPP-' . time() . '-' . $i
            ]);

            PaymentDetail::create([
                'payment_id' => $payment->id,
                'item_name' => 'SPP Bulan Agustus 2025',
                'amount' => 300000
            ]);

            PaymentDetail::create([
                'payment_id' => $payment->id,
                'item_name' => 'Pemeliharaan Gedung',
                'amount' => 200000
            ]);
        }
    }
}
