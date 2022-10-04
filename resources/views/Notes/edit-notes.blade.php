@extends('layouts.app')
@section('content')
    <div class="row">
        <div class = "col-2">

        </div>
        <div class = "col-8 row gy-3">
            <a href = "{{ route('notes.index') }}" class ="btn btn-primary">View Notes</a>
            <div>
                <div class="card mx-5">
                    <div class = "card-body">

                        <form class = "row gy-2" method="POST" action="{{ route('notes.update', $note) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class = "col-12 form-floating">
                                <input class ="form-control w-100 @error('note_title') is-invalid @enderror" name = "note_title" value ="{{ old( 'note_title', $note->note_title) }}"/>
                                <label for = "note_title" class = "ms-2">Note Title:</label>
                                @error('note_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class = "col-12">
                                <label for = "file_upload" class = "fw-bold">Note Image:</label>
                                <input class ="form-control w-100 @error('file_upload') is-invalid @enderror" name = "file_upload" type="file"  accept="image/png, image/gif, image/jpeg" value ="{{old( 'file_upload') }}"/>
                                @error('file_upload')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class = "col-12 form-floating">
                                <textarea class ="form-control w-100 @error('notes') is-invalid @enderror" style="height:20rem;" name = "notes" value ="{{ old( 'notes') != null ? $note->notes : old( 'notes') }}"></textarea>
                                <label for = "note_title" class = "ms-2">Notes:</label>
                                @error('notes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class = "col-12">
                                <button class = "btn btn-outline-primary w-100">
                                    {{__('Edit Note')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class = "col-2">

        </div>
    </div>
@endsection
