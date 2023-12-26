<div>
    <form wire:submit.prevent="createPoll">
        <label>Poll Title</label>

        <input type="text" wire:model.live.debounce.500ms="title">
        @error('title')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        Current Title: {{ $title }}

        <div class="mt-4">
            <button class="btn" wire:click.prevent="addOption">Add Options</button>
        </div>

        <div class="mt-4">
            <div class="mt-4">
                @foreach ($options as $index => $option)
                    <div class="mt-2">
                        <label>Option {{ $index+1 }}</label>
                        <div class="flex gap-2">
                            <input type="text" wire:model="options.{{ $index }}"/>
                            <button class="btn" wire:click.prevent="removeOption({{ $index }})">Remove</button>
                        </div>
                        @error("options.{$index}")
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn">Create Poll</button>
    </form>
</div>
