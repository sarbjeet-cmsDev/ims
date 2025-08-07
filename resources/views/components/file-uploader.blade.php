<div>
    <label class="block mb-2 font-medium">
        {{ $label ?? 'Select CSV file to import:' }}
    </label>
    <input 
        type="file" 
        name="{{ $name ?? 'csv_file' }}" 
        accept=".csv" 
        required 
        class="border px-3 py-2 mb-2 w-full rounded"
    >
</div>
