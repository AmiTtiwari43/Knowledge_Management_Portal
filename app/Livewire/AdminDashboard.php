<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;

class AdminDashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_users' => User::where('role', '!=', 'admin')->count(),
            'total_instructors' => User::where('role', 'instructor')->count(),
            'total_students' => User::where('role', 'student')->count(),
            'total_courses' => Course::count(),
            'pending_approvals' => Course::where('status', 'pending')->count(),
            'total_enrollments' => Enrollment::count(),
            'total_revenue' => \App\Models\Order::where('status', 'completed')->sum('amount'),
        ];
        
        $recentCourses = Course::with(['instructor', 'category'])->latest()->take(5)->get();
        $recentOrders = \App\Models\Order::with(['user', 'course'])->where('status', 'completed')->latest()->take(5)->get();
        
        $instructorSales = \App\Models\Order::join('courses', 'orders.course_id', '=', 'courses.id')
            ->join('users', 'courses.instructor_id', '=', 'users.id')
            ->where('orders.status', 'completed')
            ->select('users.name', 'users.email', \DB::raw('SUM(orders.amount) as total_earnings'), \DB::raw('COUNT(orders.id) as total_enrollments'))
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderByDesc('total_earnings')
            ->take(5)
            ->get();
            
        return view('livewire.admin-dashboard', compact('stats', 'recentCourses', 'recentOrders', 'instructorSales'));
    }
}
