{{-- TODO (L1): Use Breeze’s <x-app-layout> around this page (like dashboard), add <x-slot name="header">…</x-slot> for the title strip, then @foreach $plants in a responsive Tailwind grid (name, spot, care_note). --}}
<div class="p-6">
    <p class="text-sm text-amber-800">Replace this block: the plants list must live inside <code>&lt;x-app-layout&gt;</code> with a <code>&lt;x-slot name="header"&gt;</code> section, not a standalone <code>&lt;div&gt;</code>.</p>
    <div class="mt-4 grid gap-4 sm:grid-cols-2">
        <div class="rounded border border-dashed border-gray-300 p-4 text-gray-500">
            Placeholder card — replace with <code>@foreach ($plants as $plant)</code>.
        </div>
    </div>
</div>
