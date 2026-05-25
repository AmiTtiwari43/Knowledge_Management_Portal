<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::set('site_name', 'Knowledge Portal', 'text', 'general');
        \App\Models\Setting::set('site_description', 'The ultimate learning management system for modern teams.', 'textarea', 'general');
        \App\Models\Setting::set('hero_title', 'Master Your Skills with Expert Courses', 'text', 'hero');
        \App\Models\Setting::set('hero_subtitle', 'Join thousands of students learning today from industry leaders.', 'text', 'hero');
        \App\Models\Setting::set('contact_email', 'support@knowledgeportal.com', 'text', 'contact');
        \App\Models\Setting::set('primary_color', '#4F46E5', 'text', 'appearance');
    }
}
