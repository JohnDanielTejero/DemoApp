<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$userId = Auth::id();
        //$notes = Note::where('user_id', $userId)->latest('updated_at')->get();
        $notes = Auth::user()->notes()->latest('updated_at')->paginate('1');
        //$notes = Note::where('user_id', $userId)->latest('updated_at')->paginate('1');
        //dd($notes);
        //$notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate('1');
        return view('Notes.my-notes')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Notes.create-notes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),
            [
                'note_title'=> ['required','string', 'max:255'],
                'notes' => ['required','string'],
                'file_upload'=>['required','image','mimes:jpg,png,gif,jpeg,svg'],
            ]
        )->validate();

        //$filee = new UploadedFile();
        $file = $request->file('file_upload');
        $fileName = $file->getClientOriginalName();
        #$fileExtension = $file->getClientOriginalExtension();
        $destination = 'uploads';
        $file->move($destination, $fileName);

        Note::create([
            'uuid'=> Str::uuid(),
            'note_title' => $request['note_title'],
            'notes' => $request['notes'],
            'user_id'=>Auth::id(),
            'img_url'=>$fileName,
        ]);
        return Redirect::to(route('notes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return $note->user()->is(Auth::user()) ? view('Notes.note-page')->with('note', $note) : abort(403);
        //return !$note->user->is(Auth::user()) ?  : ;
        //$selectedNote = Note::where('uuid', $note->uuid)->where('user_id', Auth::id())->firstOrFail();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note){
        return $note->user_id != Auth::id() ? abort(403) : view('Notes.edit-notes')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note){
        if ($note->user_id != Auth::id()) return abort(403);

        Validator::make($request->all(),
            [
                'note_title'=> ['required','string', 'max:255'],
                'notes' => ['required','string'],
                'file_upload'=>['required','image','mimes:jpg,png,gif,jpeg,svg'],
            ]
        )->validate();

        //$filee = new UploadedFile();
        $file = $request->file('file_upload');
        $fileName = $file->getClientOriginalName();
        #$fileExtension = $file->getClientOriginalExtension();
        $destination = 'uploads';
        #$file->move($destination, $fileName);
        Storage::disk($destination)->put($fileName, $request->file('file_upload'));

        $note->update([
            'note_title' => $request['note_title'],
            'notes' => $request['notes'],
            'img_url'=>$fileName,
        ]);

        return Redirect::to(route('notes.index'))->with('success', 'note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        if ($note->user_id != Auth::id()) return abort(403);
        $note->delete();
        return Redirect::to(route('notes.index'));
    }
}
