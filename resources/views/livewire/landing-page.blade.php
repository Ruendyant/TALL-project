    <div x-data="{
        showSubs: @entangle('showSubs'),
        showSucc: @entangle('showSucc'),
    }">
        <div
        class="flex flex-col w-full h-screen bg-indigo-900"
        >
            <nav class="container flex justify-between pt-3 mx-auto text-indigo-200">
                <a href="#" class="text-3xl font-bold">
                    <x-application-logo class="w-16 h-16 fill-current"/>
                </a>
                <div class="flex justify-end">
                    @auth
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    @else
                        <a href="{{route('login')}}">Login</a>
                    @endauth
                </div>
            </nav>
            <div class="container flex items-center h-full mx-auto">
                <div class="flex flex-col items-start w-1/3">
                <p class="mb-3 text-5xl leading-tight text-white">
                    Want to start programming?
                </p>
                <p class="mb-4 text-indigo-200">
                    using TALL stack the latest and quite best
                    stack for laravel i think so
                </p>
                <x-button
                class="px-8 py-3 bg-red-500 hover:bg-red-700"
                x-on:click="showSubs = true"
                >
                    Subscribe
                </x-button>
            </div>
            </div>

        </div>
        <x-modal class="bg-pink-500" trigger="showSubs">
                <p class="text-6xl font-extrabold text-center text-white">
                    Let's do it!!
                </p>
                <form
                wire:submit.prevent='subscribe'
                class="flex flex-col items-center p-24">
                    <x-input
                    class="py-3 w-80"
                    placeholder="Email"
                    name="email"
                    type="email"
                    wire:model.defer='email'
                    />
                    <span class="text-sm text-indigo-200">
                        {{
                          $errors->has('email') ?
                            $errors->first('email') :
                            'We will send you the information to your email'
                        }}

                    </span>
                    <x-button
                    x-on:click="showSucc = true"
                    class="justify-center w-48 px-3 py-4 mt-6 text-center">
                        <p class="w-16 animate-spin" wire:loading wire:target='subscribe'>
                            &#9696;
                        </p>
                        <p wire:loading.remove wire:target='subscribe'>
                            Send
                        </p>
                    </x-button>
                </form>
            </x-modal>
        <x-modal class="bg-green-500" trigger="showSucc">
                <p class="mt-10 font-extrabold text-center text-white animate-pulse text-8xl">
                    &check;
                </p>
                <p class="m-8 text-6xl text-center text-white">
                    Success
                </p>
                @if (request()->has('verified') && request()->verified==1)
                <p class="m-8 text-2xl text-center text-white">
                    Thank you for the subscribe
                </p>
                @else
                <p class="m-8 text-2xl text-center text-white">
                    Check inBox
                </p>
                @endif
            </x-modal>
    </div>
