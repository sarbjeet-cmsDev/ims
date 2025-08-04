<div class="flex items-center space-x-1">
    @for ($i = 1; $i <= 5; $i++)
        <svg class="w-4 h-4 {{ $i <= $rating ? 'text-yellow-300' : 'text-gray-300' }}"
            fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c..." />
        </svg>
    @endfor
</div>
