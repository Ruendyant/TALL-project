@props(['trigger'=>""])

<div
        class="fixed top-0 flex flex-col w-full h-full bg-gray-700 bg-opacity-60"
        x-on:click.self="{{$trigger}} = false"
        x-show="{{$trigger}}"
        x-on:keydown.escape.window="{{$trigger}} = false"
        x-cloak
        >
            <div {{$attributes->merge(['class'=>"m-auto bg-gray-500 bg-opacity-95 rounded-2xl"])}}>
                {{$slot}}
        </div>
    </div>
