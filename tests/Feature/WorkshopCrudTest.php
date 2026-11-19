<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkshopCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_crud(): void
    {
        $this->post('/students', [
            'name' => 'Test Student',
            'email' => 'student@example.com',
            'phone' => '123456789',
            'address' => 'Test Address',
            'date_of_birth' => '2000-01-01',
        ])->assertRedirect('/students');

        $student = Student::where('email', 'student@example.com')->firstOrFail();

        $this->get('/students')->assertOk()->assertSee('Test Student');
        $this->get("/students/{$student->id}")->assertOk()->assertSee('Test Student');

        $this->put("/students/{$student->id}", [
            'name' => 'Updated Student',
            'email' => 'student@example.com',
            'phone' => '987654321',
            'address' => 'Updated Address',
            'date_of_birth' => '2000-01-01',
        ])->assertRedirect("/students/{$student->id}");

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Updated Student',
            'phone' => '987654321',
        ]);

        $this->delete("/students/{$student->id}")
            ->assertRedirect('/students');
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_course_crud(): void
    {
        $this->post('/courses', [
            'name' => 'Laravel Basics',
            'description' => 'Learn Laravel',
            'duration' => 12,
            'fee' => 499.99,
            'difficulty' => 'Easy',
            'is_active' => 1,
        ])->assertRedirect('/courses');

        $course = Course::where('name', 'Laravel Basics')->firstOrFail();

        $this->get('/courses')->assertOk()->assertSee('Laravel Basics');
        $this->get("/courses/{$course->id}")->assertOk()->assertSee('Learn Laravel');

        $this->put("/courses/{$course->id}", [
            'name' => 'Advanced Laravel',
            'description' => 'Advanced topics',
            'duration' => 16,
            'fee' => 599.99,
            'difficulty' => 'Hard',
            'is_active' => 1,
        ])->assertRedirect("/courses/{$course->id}");

        $this->assertDatabaseHas('courses', [
            'id' => $course->id,
            'name' => 'Advanced Laravel',
            'duration' => 16,
            'difficulty' => 'Hard',
        ]);

        $this->delete("/courses/{$course->id}")
            ->assertRedirect('/courses');
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }

    public function test_student_validation_is_enforced(): void
    {
        $this->from('/students/create')
            ->post('/students', [])
            ->assertRedirect('/students/create')
            ->assertSessionHasErrors(['name', 'email', 'phone']);
    }

    public function test_course_validation_is_enforced(): void
    {
        $this->from('/courses/create')
            ->post('/courses', [])
            ->assertRedirect('/courses/create')
            ->assertSessionHasErrors(['name', 'duration', 'fee', 'difficulty']);
    }
}
