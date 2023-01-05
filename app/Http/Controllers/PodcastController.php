<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['podcasts'] = Podcast::paginate(10);
        return view('podcast.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('podcast.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = [
            'author' => 'required|string|max:100',
            'title' => 'required|string|max:100',
            'cover' => 'required|max:10000|mimes:jpeg,jpg,png',
            'thumbnail' => 'required|max:10000|mimes:jpeg,jpg,png',
            'enabled' => 'nullable|string|max:100',
        ];

        $message = [
            'required' => 'El :attribute es requerido',
        ];

        $this->validate($request, $fields, $message);

        $data = $request->except('_token');



        if($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('upload', 'public');
        }
        if($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('upload', 'public');
        }
        if($request->hasFile('audio')) {
            $data['audio'] = $request->file('audio')->store('upload', 'public');
        }
        Podcast::insert($data);
        return redirect('podcast')->with('message', 'podcast agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function show(Podcast $podcast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $podcast = Podcast::findOrFail($id);
        return view('podcast.edit', compact('podcast'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $fields = [
            'author' => 'required|string|max:100',
            'title' => 'required|string|max:100',
            'enabled' => 'nullable|string|max:100',
        ];

        $message = [
            'required' => 'El :attribute es requerido',
        ];

        if($request->hasFile('thumbnail')) {
            $fields = ['thumbnail' => 'required|max:10000|mimes:jpeg,jpg,png'];
            $message = ['thumbnail.required' => 'El thumbnail es requerido'];
        }

        if($request->hasFile('cover')) {
            $fields = ['cover' => 'required|max:10000|mimes:jpeg,jpg,png'];
            $message = ['cover.required' => 'El cover es requerido'];
        }

        if($request->hasFile('audio')) {
            $fields = ['audio' => 'required|max:10000|mimes:jpeg,jpg,png'];
            $message = ['audio.required' => 'El cover es requerido'];
        }

        $this->validate($request, $fields, $message);


        $data = $request->except('_token', '_method');
        if($request->hasFile('thumbnail')) {
            $podcast = Podcast::findOrFail($id);
            Storage::delete('public/'.$podcast->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('upload', 'public');
        }
        if($request->hasFile('cover')) {
            $podcast = Podcast::findOrFail($id);
            Storage::delete('public/'.$podcast->cover);
            $data['cover'] = $request->file('cover')->store('upload', 'public');
        }
        if($request->hasFile('audio')) {
            $podcast = Podcast::findOrFail($id);
            Storage::delete('public/'.$podcast->audio);
            $data['audio'] = $request->file('audio')->store('upload', 'public');
        }
        Podcast::where('id', '=', $id)->update($data);
        return redirect('podcast')->with('message', 'Podcast editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $podcast = Podcast::findOrFail($id);
        if(Storage::delete('public/'. $podcast->cover) && Storage::delete('public/'. $podcast->thumbnail) && Storage::delete('public/'. $podcast->audio)) {
            Podcast::destroy($id);
        }
        return redirect('podcast')->with('message', 'Podcast borrado');
    }
}
