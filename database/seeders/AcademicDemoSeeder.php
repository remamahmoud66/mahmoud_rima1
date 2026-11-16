<?php

namespace Database\Seeders;

use App\Models\Lecture;
use App\Models\Lecturers;
use App\Models\User;
use App\Models\courses as Course;
use Illuminate\Database\Seeder;

class AcademicDemoSeeder extends Seeder
{
    public function run(): void
    {
        // حساب مدير للتجربة. كلمة المرور: password
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => 'password',
            ]
        );

        $admin->forceFill(['role' => 'admin'])->save();

        // ستة حسابات تجريبية؛ أول ثلاثة سيكونون محاضرين
        $demoUsers = collect();

        for ($number = 1; $number <= 6; $number++) {
            $demoUsers->push(
                User::firstOrCreate(
                    ['email' => "student{$number}@example.com"],
                    [
                        'name' => "Demo Student {$number}",
                        'password' => 'password',
                    ]
                )
            );
        }

        $lecturerUsers = $demoUsers->take(3);
        $studentUsers = $demoUsers->skip(3);
        $courses = collect();

        foreach ($lecturerUsers as $index => $user) {
            $lecturer = Lecturers::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'employee_number' => 'EMP-' . $user->id,
                    'department' => 'Computer Science',
                    'academic_rank' => 'Assistant Professor',
                    'office_room' => 'Room ' . (100 + $index),
                    'photo' => null,
                    'is_active' => '1',
                ]
            );

            for ($number = 1; $number <= 2; $number++) {
                $course = Course::firstOrCreate(
                    ['course_code' => "CRS-{$lecturer->id}-{$number}"],
                    [
                        'lecturer_id' => $lecturer->id,
                        'title' => "Course {$number} - {$user->name}",
                        'credit_hours' => '3',
                        'semester' => 'Fall 2026',
                    ]
                );

                $courses->push($course);

                for ($lectureNumber = 1; $lectureNumber <= 2; $lectureNumber++) {
                    Lecture::firstOrCreate(
                        [
                            'course_id' => $course->id,
                            'title' => "Lecture {$lectureNumber}",
                        ],
                        [
                            'topic_summary' => 'Introduction to the course topic',
                            'hall_name' => 'Hall 101',
                            'scheduled_at' => now()->addDays($lectureNumber),
                        ]
                    );
                }
            }
        }

        // تسجيل الطلاب الثلاثة الأخيرين في كل مساق
        foreach ($studentUsers as $student) {
            foreach ($courses as $course) {
                $course->users()->syncWithoutDetaching([
                    $student->id => [
                        'enrollment_date' => now()->toDateString(),
                        'grade' => null,
                    ],
                ]);
            }
        }
    }
}