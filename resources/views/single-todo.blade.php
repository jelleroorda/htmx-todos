@php
    /** @var \App\Models\Todo $todo */
@endphp

<li class="flex items-center justify-between" id="todo-{{ $todo->id }}" hx-swap="outerHTML">
    <form
        action="/todos/{{ $todo->id }}/finished"
        method="POST"
        hx-put="/todos/{{ $todo->id }}/finished"
        hx-target="#todo-{{ $todo->id }}"
    >
        @method('PUT')
        @csrf

        <div class="relative">
            <div class="-z-10 hover:bg-gray-100">
                @if ($todo->finished_at)
                    <svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                        stroke="currentColor" class="w-4 h-4 text-white bg-blue-600"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                @else
                    <div class="w-4 h-4 border border-gray-500"></div>
                @endif
            </div>

            <input type="submit" class="absolute h-4 w-4 inset-0 z-0 outline-red-500" value="">
        </div>
    </form>

    <p class="px-2 w-full @if($todo->finished_at) line-through @endif">{{ $todo->content }}</p>

    <form action="/todos/{{ $todo->id }}" method="POST">
        @method('DELETE')
        @csrf

        <input
            type="submit"
            value="verwijderen"
            hx-delete="/todos/{{ $todo->id }}"
            hx-target="#todo-{{ $todo->id }}"
            hx-swap="outerHTML"
            class="border border-gray-400 px-1 py-0.5 hover:bg-gray-50 cursor-pointer"
        >
    </form>
</li>
