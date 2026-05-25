<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Post;
use App\Models\Section;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RealisticSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        $instructors = [
            ['name' => 'Dr. Alan Turing', 'email' => 'alan@example.com', 'topic' => 'Computer Science'],
            ['name' => 'Grace Hopper', 'email' => 'grace@example.com', 'topic' => 'Software Engineering'],
            ['name' => 'Linus Torvalds', 'email' => 'linus@example.com', 'topic' => 'Operating Systems'],
            ['name' => 'Ada Lovelace', 'email' => 'ada@example.com', 'topic' => 'Algorithms'],
            ['name' => 'Tim Berners-Lee', 'email' => 'tim@example.com', 'topic' => 'Web Technologies'],
        ];

        $courseTemplates = [
            ['title' => 'Mastering Algorithms in PHP', 'cat' => 'Web Development'],
            ['title' => 'Advanced Database Design', 'cat' => 'Data Science'],
            ['title' => 'The Art of Clean Code', 'cat' => 'Development'],
            ['title' => 'Modern UI/UX Principles', 'cat' => 'Design'],
            ['title' => 'Full-Stack Performance Tuning', 'cat' => 'Web Development'],
            ['title' => 'Python for AI and ML', 'cat' => 'Data Science'],
            ['title' => 'Building Scalable APIs', 'cat' => 'Web Development'],
            ['title' => 'Cloud Architecture Patterns', 'cat' => 'Development'],
            ['title' => 'The Business of Freelancing', 'cat' => 'Business'],
            ['title' => 'Digital Marketing Strategy', 'cat' => 'Marketing'],
            ['title' => 'React and Next.js Masterclass', 'cat' => 'Web Development'],
            ['title' => 'Cybersecurity Essentials', 'cat' => 'Development'],
            ['title' => 'Mastering Git and GitHub', 'cat' => 'Development'],
            ['title' => 'TypeScript in Depth', 'cat' => 'Web Development'],
            ['title' => 'Docker for Developers', 'cat' => 'Development'],
            ['title' => 'Kubernetes Orchestration', 'cat' => 'Development'],
            ['title' => 'Data Visualization with D3.js', 'cat' => 'Design'],
            ['title' => 'Swift for iOS Apps', 'cat' => 'Development'],
            ['title' => 'Kotlin for Android', 'cat' => 'Development'],
            ['title' => 'Unity Game Development', 'cat' => 'Development'],
        ];

        $techImages = [
            '1517694712202-14dd9538aa97', // Laptop/Code
            '1587620962725-abab7fe55159', // Coding
            '1558494949-ef010cbdcc4b', // Server
            '1485827404703-89b55fcc595e', // AI
            '1586717791821-3f44a563de42', // Design
            '1522202176988-66273c2fd55f', // Team
            '1460925895917-afdab827c52f', // Marketing
            '1550751827-4bd374c3f58b', // Cyber
            '1551288049-bbda38a66195', // Data
            '1512941937669-90a1b58e7e9c', // Mobile
            '1526374965328-7f61d4dc18c5', // Python
            '1451187580459-43490279c0fa', // Cloud
            '1504384308090-c894fdcc538d', // Setup
            '1518770660439-4636190af475', // Hardware
            '1498050108023-c5249f4df085', // Web Dev
            '1555066931-4365d14bab8c', // Code blocks
            '1531297484001-80022131f5a1', // Futuristic Tech
            '1508873696983-2df758a1f0ce', // Math/Alg
            '1504639725590-34d0984388bd', // Modern Desk
            '1633356122544-f134324a6cee', // React icon style
        ];

        $youtubeVideos = [
            'https://www.youtube.com/watch?v=kYI9UqWv9Sg', // JS
            'https://www.youtube.com/watch?v=hQAHSlTtcmY', // React
            'https://www.youtube.com/watch?v=9He4UBLp820', // Next.js
            'https://www.youtube.com/watch?v=u4ovE8aTvnM', // Python
            'https://www.youtube.com/watch?v=7S_tz1z_5bA', // SQL
            'https://www.youtube.com/watch?v=Gu6z6kIukgg', // Figma
            'https://www.youtube.com/watch?v=F3zw1Gvn4Mk', // Node
            'https://www.youtube.com/watch?v=MYyJ4PuL4pY', // Laravel
        ];

        $student = User::where('email', 'student@example.com')->first();

        foreach ($instructors as $idx => $iData) {
            $user = User::firstOrCreate(
                ['email' => $iData['email']],
                [
                    'name' => $iData['name'],
                    'password' => bcrypt('password'),
                    'role' => 'instructor',
                    'bio' => "Expert in {$iData['topic']} with over 15 years of industry experience."
                ]
            );
            $user->assignRole('instructor');

            // Create 4 courses for this instructor
            $instructorCourses = array_splice($courseTemplates, 0, 4);
            foreach ($instructorCourses as $cIdx => $cData) {
                $category = $categories->where('name', $cData['cat'])->first() ?? $categories->first();
                $imgId = $techImages[($idx * 4 + $cIdx) % count($techImages)];
                
                $course = Course::create([
                    'instructor_id' => $user->id,
                    'category_id' => $category->id,
                    'title' => $cData['title'],
                    'slug' => Str::slug($cData['title']),
                    'description' => "Comprehensive guide to {$cData['title']}. This course covers everything from basic concepts to advanced implementations in {$iData['topic']}.",
                    'price' => rand(29, 99) . '.99',
                    'level' => collect(['beginner', 'intermediate', 'advanced'])->random(),
                    'thumbnail' => "https://images.unsplash.com/photo-{$imgId}?auto=format&fit=crop&w=800&q=80",
                    'preview_video_url' => $youtubeVideos[array_rand($youtubeVideos)],
                    'status' => 'published',
                ]);

                // Enroll student automatically
                if ($student) {
                    \App\Models\Enrollment::firstOrCreate([
                        'user_id' => $student->id,
                        'course_id' => $course->id,
                    ], [
                        'progress_percent' => 0
                    ]);
                }

                // Realistic Question Pool based on Category
                $questionPool = [
                    'Web Development' => [
                        ['q' => 'What does the "box-sizing: border-box" property do?', 'options' => ['Includes padding and border in the element\'s total width/height', 'Excludes padding from the width', 'Only affects the margin', 'Makes the box invisible']],
                        ['q' => 'Which HTTP method is typically used to create a new resource?', 'options' => ['POST', 'GET', 'PUT', 'DELETE']],
                        ['q' => 'What is the purpose of a "Virtual DOM" in frameworks like React?', 'options' => ['To optimize UI updates by minimizing direct DOM manipulation', 'To replace the actual HTML DOM', 'To store user passwords securely', 'To handle server-side routing']],
                        ['q' => 'Which of these is NOT a valid JavaScript primitive type?', 'options' => ['Array', 'String', 'Boolean', 'Undefined']],
                        ['q' => 'In CSS Flexbox, which property controls the alignment of items along the main axis?', 'options' => ['justify-content', 'align-items', 'flex-direction', 'gap']],
                    ],
                    'Data Science' => [
                        ['q' => 'What is the primary goal of "Supervised Learning"?', 'options' => ['To predict an output variable based on labeled input data', 'To find hidden patterns in unlabeled data', 'To reduce the number of features in a dataset', 'To clean missing values from a table']],
                        ['q' => 'Which Python library is most commonly used for data manipulation and analysis?', 'options' => ['Pandas', 'Flask', 'Requests', 'Pytest']],
                        ['q' => 'What does a "Correlation Coefficient" of -1 indicate?', 'options' => ['A perfect negative linear relationship', 'No relationship at all', 'A perfect positive relationship', 'A calculation error']],
                        ['q' => 'Which SQL clause is used to filter results based on an aggregate function?', 'options' => ['HAVING', 'WHERE', 'GROUP BY', 'ORDER BY']],
                        ['q' => 'In Machine Learning, what is "Overfitting"?', 'options' => ['When a model performs well on training data but poorly on new data', 'When a model is too simple to capture patterns', 'When the dataset is too small', 'When the training takes too long']],
                    ],
                    'Design' => [
                        ['q' => 'What does "Kerning" refer to in typography?', 'options' => ['The spacing between individual character pairs', 'The vertical spacing between lines of text', 'The weight of a font', 'The slant of italic characters']],
                        ['q' => 'Which of these is a "Complementary" color scheme?', 'options' => ['Colors opposite each other on the color wheel', 'Colors next to each other on the color wheel', 'Different shades of the same color', 'Three colors equally spaced apart']],
                        ['q' => 'What is the primary purpose of a "Wireframe"?', 'options' => ['To outline the structure and layout without visual design', 'To create high-fidelity animations', 'To test the final code performance', 'To choose the color palette']],
                        ['q' => 'In UI Design, what does "Affordance" mean?', 'options' => ['Properties of an object that suggest how it can be used', 'The price of a design tool license', 'The loading speed of a website', 'The accessibility contrast ratio']],
                        ['q' => 'What is the standard resolution for web-based images?', 'options' => ['72 PPI', '300 PPI', '1200 PPI', '16 PPI']],
                    ]
                ];

                $defaultQuestions = [
                    ['q' => 'What is the primary benefit of using this technology?', 'options' => ['Increased efficiency and scalability', 'It is the only option available', 'It makes the code run slower', 'It requires no maintenance']],
                    ['q' => 'Which best practice should be followed here?', 'options' => ['Consistent naming conventions', 'Writing everything in one file', 'Ignoring error messages', 'Hardcoding all values']],
                    ['q' => 'What is a common pitfall to avoid?', 'options' => ['Premature optimization', 'Writing too much documentation', 'Using version control', 'Testing your code too often']],
                    ['q' => 'How can performance be improved?', 'options' => ['By implementing caching mechanisms', 'By adding more complex loops', 'By removing all comments', 'By using larger image files']],
                    ['q' => 'Which tool is essential for this workflow?', 'options' => ['A modern IDE or Code Editor', 'A spreadsheet application', 'A physical notebook only', 'A calculator']],
                ];

                $activePool = $questionPool[$cData['cat']] ?? $defaultQuestions;

                // Create Quiz for the course
                $quiz = Quiz::create([
                    'course_id' => $course->id,
                    'title' => "Final Assessment: {$course->title}",
                    'passing_percentage' => 60,
                    'max_attempts' => 3,
                ]);

                // Create questions from pool
                foreach ($activePool as $qData) {
                    $question = Question::create([
                        'quiz_id' => $quiz->id,
                        'question_text' => $qData['q'],
                        'points' => 20,
                    ]);

                    foreach ($qData['options'] as $oIdx => $oText) {
                        Option::create([
                            'question_id' => $question->id,
                            'option_text' => $oText,
                            'is_correct' => ($oIdx === 0), // First option in our pool is the correct one
                        ]);
                    }
                }

                // Create 3 sections per course
                for ($s = 1; $s <= 3; $s++) {
                    $section = Section::create([
                        'course_id' => $course->id,
                        'title' => "Phase {$s}: " . ($s === 1 ? 'Foundations' : ($s === 2 ? 'Intermediate Concepts' : 'Advanced Projects')),
                        'position' => $s,
                    ]);

                    // Create 3 lectures per section
                    for ($l = 1; $l <= 3; $l++) {
                        Lecture::create([
                            'section_id' => $section->id,
                            'title' => "Chapter {$s}.{$l}: " . Str::headline("concept " . Str::random(5)),
                            'type' => 'video',
                            'video_url' => $youtubeVideos[array_rand($youtubeVideos)],
                            'duration_seconds' => rand(300, 1200),
                            'position' => $l,
                            'is_preview' => ($s === 1 && $l === 1),
                        ]);
                    }
                }
            }

            // Create 2 blog posts per instructor
            for ($p = 1; $p <= 2; $p++) {
                $title = "Why " . ($p === 1 ? 'Continuous Learning' : $iData['topic']) . " matters in 2026";
                $imgId = $techImages[($idx * 2 + $p + 10) % count($techImages)];
                Post::create([
                    'user_id' => $user->id,
                    'title' => $title,
                    'slug' => Str::slug($title) . '-' . uniqid(),
                    'content' => "In this post, we explore the deep nuances of " . strtolower($iData['topic']) . ". As technology evolves, the way we approach problems must also change. This article dives into the best practices and emerging trends that every professional should be aware of.\n\n" . fake()->paragraphs(4, true),
                    'thumbnail' => "https://images.unsplash.com/photo-{$imgId}?auto=format&fit=crop&w=800&q=80",
                    'status' => 'published',
                    'likes_count' => rand(10, 100),
                    'dislikes_count' => rand(0, 5),
                ]);
            }
        }
    }
}
