<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            CategorySeeder::class,
            SettingSeeder::class,
        ]);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        $admin->assignRole('admin');

        $instructor = User::create([
            'name' => 'Instructor User',
            'email' => 'instructor@example.com',
            'password' => bcrypt('password'),
            'role' => 'instructor',
        ]);
        $instructor->assignRole('instructor');

        $student = User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);
        $student->assignRole('student');

        $this->call([
            RealisticSeeder::class,
        ]);

        // Add 4 genuine-looking students
        $extraStudents = [
            ['name' => 'Emily Chen', 'email' => 'emily.chen@example.com'],
            ['name' => 'Marcus Johnson', 'email' => 'marcus.j@example.com'],
            ['name' => 'Sophia Martinez', 'email' => 'sophia.m@example.com'],
            ['name' => 'Liam O\'Connor', 'email' => 'liam.o@example.com'],
        ];

        $studentUsers = [$student];

        foreach ($extraStudents as $sData) {
            $newStudent = User::create([
                'name' => $sData['name'],
                'email' => $sData['email'],
                'password' => bcrypt('password'),
                'role' => 'student',
            ]);
            $newStudent->assignRole('student');
            $studentUsers[] = $newStudent;
        }

        // Enroll students in random courses and create completed orders for selling analytics
        $courses = \App\Models\Course::inRandomOrder()->take(10)->get();

        if ($courses->isNotEmpty()) {
            foreach ($studentUsers as $su) {
                // Each student buys 2 to 4 random courses
                $purchasedCourses = $courses->random(rand(2, 4));
                foreach ($purchasedCourses as $course) {
                    \App\Models\Enrollment::create([
                        'user_id' => $su->id,
                        'course_id' => $course->id,
                        'progress_percent' => rand(0, 50)
                    ]);

                    \App\Models\Order::create([
                        'user_id' => $su->id,
                        'course_id' => $course->id,
                        'amount' => $course->price,
                        'status' => 'completed',
                        'stripe_payment_id' => 'SEED_' . uniqid()
                    ]);
                }
            }
        }
    }
}
