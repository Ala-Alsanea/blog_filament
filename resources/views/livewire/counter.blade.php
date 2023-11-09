<div class="container mx-auto my-10">


    <h1 class="my-3 text-2xl font-black">testing
        <span class="text-transparent bg-clip-text bg-gradient-to-bl from-purple-700 to-pink-500">
            {{ $name }}
        </span>
    </h1>


    <h1>count:{{ $count }}</h1>


    <livewire:utility.btn />


    <form class="fixed flex-col form">
        <label for="title">Title:{{$title}}</label>
        <input type="text" class="border rounded-lg" id="title" wire:model.live="title">
    </form>
</div>
