@props(['course'])

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 flex flex-col h-full group">
    <div class="relative aspect-video overflow-hidden">
        <img src="{{ $course->thumbnail_url }}" 
             alt="{{ $course->title }}" 
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        <div class="absolute top-4 left-4">
            <span class="px-3 py-1 rounded-full text-xs font-semibold text-white shadow-sm" 
                  style="background-color: {{ $course->category->color ?? '#3b82f6' }}">
                {{ $course->category->name ?? 'Uncategorized' }}
            </span>
        </div>
    </div>
    
    <div class="p-5 flex flex-col flex-grow">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white line-clamp-2 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
            <a href="{{ route('courses.show', $course->slug) }}">
                {{ $course->title }}
            </a>
        </h3>
        
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
            {{ $course->description }}
        </p>
        

        
        <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-400 text-xs font-bold mr-2">
                    {{ substr($course->instructor->name, 0, 1) }}
                </div>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 truncate max-w-[100px]">
                    {{ $course->instructor->name }}
                </span>
            </div>
            
            <div class="text-lg font-black text-gray-900 dark:text-white">
                {{ $course->price > 0 ? '₹' . number_format($course->price, 2) : 'Free' }}
            </div>
        </div>
    </div>
</div>
