import './bootstrap';
import collapse from '@alpinejs/collapse';

// In Livewire 3, Alpine is handled automatically. 
// You should not call Alpine.start() here as it causes conflicts.

document.addEventListener('livewire:init', () => {
    window.Alpine.plugin(collapse);
});
