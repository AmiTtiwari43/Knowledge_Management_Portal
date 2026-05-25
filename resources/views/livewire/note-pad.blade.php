<div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        Your Notes
    </h3>

    <form wire:submit.prevent="saveNote" class="mb-8">
        <textarea wire:model="content" 
                  class="w-full bg-gray-900 border-gray-700 rounded-xl text-gray-300 focus:ring-blue-500 focus:border-blue-500 min-h-[100px] mb-3" 
                  placeholder="Type your notes here..."></textarea>
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700 transition-colors">
                Save Note
            </button>
        </div>
    </form>

    <div class="space-y-4">
        @foreach($notes as $note)
            <div class="p-4 bg-gray-900/50 rounded-xl border border-gray-700 group relative">
                <p class="text-sm text-gray-300">{{ $note->content }}</p>
                <div class="mt-2 flex items-center justify-between">
                    <span class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">{{ $note->created_at->diffForHumans() }}</span>
                    <button wire:click="deleteNote({{ $note->id }})" class="opacity-0 group-hover:opacity-100 text-red-500 hover:text-red-400 transition-opacity">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
