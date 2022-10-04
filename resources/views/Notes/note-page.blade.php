@extends('layouts.app')
@section('content')
    <div class="row">
        <div class = "col-2">

        </div>
        <div class = "col-8 row gy-3">
            <a href = "{{ route('notes.create') }}" class ="btn btn-primary">Add notes</a>

                <div class ="col-12 card">
                    <div class = "card-body">
                        <h1>
                            {{ $note->note_title }}
                        </h1>
                        <span class = "card-img-top w-100">
                            <img src = '{{ asset("uploads/$note->img_url") }}'class = "w-100"/>
                        </span>
                        <p>
                            {{ $note->notes }}
                        </p>
                        {{-- @isAdmin($note->id)
                            <div>
                                Hello
                            </div>
                        @endIsAdmin --}}
                        <a href = "{{ route('notes.edit', $note) }}" class = "btn btn-primary w-100">Edit note</a>
                    </div>
                </div>

        </div>
        <div class = "col-2">

        </div>

    </div>
@endsection
