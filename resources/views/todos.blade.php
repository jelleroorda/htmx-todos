@extends('layout')

@section('content')
    <div class="bg-white shadow p-6 flex flex-col gap-6">
        <header class="flex gap-4" hx-boost="true">
            <a href="/todos">
                Allemaal
            </a>

            <a href="/todos?finished=false">
                Te doen
            </a>

            <a href="/todos?finished=true">
                Klaar
            </a>
        </header>

        <div>
            @if ($todos->isNotEmpty())
                <ul class="flex flex-col gap-2">
                    @foreach($todos as $todo)
                        @include('single-todo', ['todo' => $todo])
                    @endforeach
                </ul>
            @else
                Je hebt nog geen to do's!
            @endif
        </div>

        <form action="/todos" method="POST"  hx-boost="true">
            @csrf

            <input name="content" class="border border-gray-400 px-1 py-0.5" autofocus>

            <input
                type="submit"
                value="Nieuwe maken"
                class="border border-gray-400 px-1 py-0.5  hover:bg-gray-50 cursor-pointer"
            >
        </form>
    </div>
@endsection
