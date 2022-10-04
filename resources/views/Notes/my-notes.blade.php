@extends('layouts.app')
@section('content')
    <div class="row">
        <div class = "col-2">

        </div>
        <div class = "col-8 row gy-3">
            <a href = "{{ route('notes.create') }}" class ="btn btn-primary">Add notes</a>
            @if (session('success'))
                <div class = "alert alert-success">
                    <h1>
                        {{ session('success') }}
                    </h1>
                </div>
            @endif
            @forelse ($notes as $note)

                <div class ="col-12 card p-5">
                    <div class = "card-body">
                        <h1>
                            {{ $note->note_title }}
                        </h1>
                        <span class = "card-img-top w-100">
                            <img src = '{{ asset("uploads/$note->img_url") }}'class = "w-100"/>
                        </span>
                        <p>
                            {{ Str::limit($note->notes, 3) }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href = "{{ route('notes.show', $note) }}" class="btn btn-primary">View Notes</a>
                        <form method="POST" action="{{route('notes.destroy', $note)}}" class="ms-3">
                            @csrf
                            @method('DELETE')
                            <button class = "btn btn-danger">Delete Notes</button>
                        </form>
                    </div>
                </div>

                @empty
                    <p>
                        No notes yet
                    </p>

             @endforelse

             {{ $notes->links() }}
        </div>
        <div class = "col-2">

        </div>
    </div>
@endsection
