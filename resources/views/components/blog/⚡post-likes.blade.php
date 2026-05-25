<?php

use App\Models\Post;
use App\Models\PostLike;
use Livewire\Attributes\Locked;

new class extends \Livewire\Component
{
    #[Locked]
    public Post $post;
    
    public $userLike;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->loadUserLike();
    }

    public function loadUserLike()
    {
        if (auth()->check()) {
            $this->userLike = PostLike::where('user_id', auth()->id())
                ->where('post_id', $this->post->id)
                ->first();
        }
    }

    public function toggleLike($type)
    {
        if (!auth()->check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        $existing = PostLike::where('user_id', auth()->id())
            ->where('post_id', $this->post->id)
            ->first();

        if ($existing) {
            if ($existing->type === $type) {
                // Remove like
                $existing->delete();
                if ($type === 'like') $this->post->decrement('likes_count');
                else $this->post->decrement('dislikes_count');
                $this->userLike = null;
            } else {
                // Change type
                $existing->update(['type' => $type]);
                if ($type === 'like') {
                    $this->post->increment('likes_count');
                    $this->post->decrement('dislikes_count');
                } else {
                    $this->post->increment('dislikes_count');
                    $this->post->decrement('likes_count');
                }
                $this->userLike = $existing;
            }
        } else {
            // New like
            $this->userLike = PostLike::create([
                'user_id' => auth()->id(),
                'post_id' => $this->post->id,
                'type' => $type
            ]);
            if ($type === 'like') $this->post->increment('likes_count');
            else $this->post->increment('dislikes_count');
        }

        $this->post->refresh();
    }
};
?>

<div class="flex items-center gap-6">
    <button wire:click="toggleLike('like')" class="flex items-center gap-2 group transition-all {{ $userLike && $userLike->type === 'like' ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">
        <div class="p-2 rounded-full {{ $userLike && $userLike->type === 'like' ? 'bg-blue-50 dark:bg-blue-900/30' : 'group-hover:bg-gray-100 dark:group-hover:bg-gray-800' }}">
            <svg class="w-6 h-6 {{ $userLike && $userLike->type === 'like' ? 'fill-current' : 'fill-none' }}" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.708C19.412 10 20 10.588 20 11.292c0 .304-.108.591-.304.814l-2.735 3.125A2 2 0 0115.451 16H9M14 10V6a2 2 0 00-2-2H9a2 2 0 00-2 2v10m7-6H9m7 6H9" />
            </svg>
        </div>
        <span class="text-sm font-black">{{ number_format($post->likes_count) }}</span>
    </button>

    <button wire:click="toggleLike('dislike')" class="flex items-center gap-2 group transition-all {{ $userLike && $userLike->type === 'dislike' ? 'text-red-600' : 'text-gray-500 hover:text-red-600' }}">
        <div class="p-2 rounded-full {{ $userLike && $userLike->type === 'dislike' ? 'bg-red-50 dark:bg-red-900/30' : 'group-hover:bg-gray-100 dark:group-hover:bg-gray-800' }}">
            <svg class="w-6 h-6 {{ $userLike && $userLike->type === 'dislike' ? 'fill-current' : 'fill-none' }}" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.292C4.588 14 4 13.412 4 12.708c0-.304.108-.591.304-.814l2.735-3.125A2 2 0 018.549 8H15M10 14V18a2 2 0 002 2h3a2 2 0 002-2V8m-7 6h7m-7-6h7" />
            </svg>
        </div>
        <span class="text-sm font-black">{{ number_format($post->dislikes_count) }}</span>
    </button>
</div>