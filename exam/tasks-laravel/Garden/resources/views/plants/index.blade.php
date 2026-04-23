{{-- TODO (L1): Wrap this page in <x-app-layout> with a header slot, then list $plants in a responsive Tailwind grid (name, spot, care_note). --}}
<div class="p-6">
    <p class="text-sm text-amber-800">This file should use the same layout as the dashboard (<code>x-app-layout</code>).</p>
    <div class="mt-4 grid gap-4 sm:grid-cols-2">
        <div class="rounded border border-dashed border-gray-300 p-4 text-gray-500">
            Placeholder card — replace with <code>@foreach ($plants as $plant)</code>.
        </div>
    </div>
</div>
