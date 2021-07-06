<div class="p-6 bg-white border-b border-gray-200">
    <p class="mb-4 text-2xl underline">Subscribers</p>
    @if ($subs->isEmpty())
    <div class="flex flex-col">
    <x-input
    type="text"
    class="self-end w-1/3 mb-6"
    placeholder="Search..."
    wire:model='search'
    />
        <p class="flex self-stretch p-5 text-black bg-red-200 rounded-lg">
            No Subscribers
        </p>
    </div>
    @else
        <x-input
        type="text"
        class="float-right w-1/3 mb-6"
        placeholder="Search..."
        wire:model='search'
        />
        <table class="w-full">
            <thead class="border-b-2 border-gray-300">
                <th class="p-3 text-left text-indigo-500">
                    Email
                </th>
                <th class="p-3 text-left text-indigo-500">
                    Verified
                </th>
            </thead>
            <tbody>
                @foreach ($subs as $s)
                    <tr class="text-sm border-b-2 border-blue-400">
                        <td class="px-4 py-4">
                            {{$s->email}}
                        </td>
                        <td class="px-4 py-4">
                            {{optional($s->email_verified_at)->diffForHumans() ?? "No"}}
                        </td>
                        <td>
                            <x-button
                            wire:click='delete({{$s->id}})'
                            class="bg-red-500 hover:bg-red-400">
                                Delete
                            </x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
