<nav class="hidden md:flex items-center justify-between text-xs text-gray-400">
    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li>
            <a
                href="#"
                class="hover:border-blue border-b-4 pb-3 @if($status === 'All') border-blue text-gray-900 @endif"
                wire:click.prevent="setStatus('All')"
            >
                All Ideas (87)
            </a>
        </li>
        <li>
            <a
                href="#"
                class="@if($status === 'Considering') border-blue text-gray-900 @endif transition duration-150 ease-in border-b-4 pb-3 hover:border-blue"
                wire:click.prevent="setStatus('Considering')"
            >
                Considering (6)
            </a>
        </li>
        <li>
            <a
                href="#"
                class="@if($status === 'In Progress') border-blue text-gray-900 @endif transition duration-150 ease-in border-b-4 pb-3 hover:border-blue"
                wire:click.prevent="setStatus('In Progress')"
            >
                In Progress (1)
            </a>
        </li>
    </ul>

    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li>
            <a
                href="#"
                class="@if($status === 'Implemented') border-blue text-gray-900 @endif transition duration-150 ease-in border-b-4 pb-3 hover:border-blue"
                wire:click.prevent="setStatus('Implemented')"
            >
                Implemented (10)
            </a>
        </li>
        <li>
            <a
                href="#"
                class="@if($status === 'Closed') border-blue text-gray-900 @endif transition duration-150 ease-in border-b-4 pb-3 hover:border-blue"
                wire:click.prevent="setStatus('Closed')"
            >
                Closed (55)
            </a>
        </li>
    </ul>
</nav>
