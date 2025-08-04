<div x-data="{ open: false }" class="relative inline-block text-left">
  <button
    @click="open = !open"
    class="px-4 py-2 bg-blue-600 text-white rounded-md"
  >
    Actions
  </button>

  <div
    x-show="open"
    @click.away="open = false"
    x-transition
    class="absolute mt-2 w-32 bg-white border border-gray-200 rounded-md shadow-md z-10"
  >
    <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Edit</a>
    <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Delete</a>
  </div>
</div>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>



