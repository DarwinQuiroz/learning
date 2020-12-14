<?php

use App\Category;
use App\Course;
use App\Goal;
use App\Level;
use App\Requirement;
use App\Role;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('courses');
        Storage::deleteDirectory('users');

        Storage::makeDirectory('courses');
        Storage::makeDirectory('users');

        factory(Role::class, 1)->create(['name' => 'admin']);
        factory(Role::class, 1)->create(['name' => 'teacher']);
        factory(Role::class, 1)->create(['name' => 'student']);

        factory(User::class, 1)->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789'),
            'role_id' => Role::ADMIN
        ])->each(function($user) {
            factory(Student::class, 1)->create(['user_id' => $user->id]);
        });

        factory(User::class, 50)->create()->each(function($user) {
            factory(Student::class, 1)->create(['user_id' => $user->id]);
        });

        factory(User::class, 10)->create()->each(function($user) {
            factory(Student::class, 1)->create(['user_id' => $user->id]);
            factory(Teacher::class, 1)->create(['user_id' => $user->id]);
        });

        factory(Level::class, 1)->create(['name' => 'Beginner']);
        factory(Level::class, 1)->create(['name' => 'Intermediate']);
        factory(Level::class, 1)->create(['name' => 'Advance']);

        factory(Category::class, 5)->create();

        factory(Course::class, 50)->create()->each(function($course) {
            $course->goals()->saveMany(factory(Goal::class, 2)->create());
            $course->requirements()->saveMany(factory(Requirement::class, 4)->create());
        });
    }
}
