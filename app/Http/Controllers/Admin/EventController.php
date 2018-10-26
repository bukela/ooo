<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            // 'author_id' => 'required',
            'content' => 'required',
            'flyer' => 'required|image',
        ]);
        $flyer = $request->flyer;
        $flyer_name = time().$flyer->getClientOriginalName();
        $flyer->move('uploads/events', $flyer_name);
        
        
        $event = new Event;
        $event->title = $request->title;
        // $event->autor_id = Auth::user()->id;
        $event->content = $request->content;
        $event->flyer = 'uploads/events/'.$flyer_name;
        $event->slug = str_slug($request->title);
        $event->save();
        // Session::flash('success', 'Event created successfully !');
        return redirect(route('admin.events.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            // 'author_id' => 'required',
            'content' => 'required',
            // 'flyer' => 'required|image'
        ]);

        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->content  = $request->content;

        $event->save();

        if ($request->hasFile('flyer')) {
            File::delete(public_path().'/'.$event->flyer);

            $flyer = $request->flyer;
            
            $flyer_name = time().$flyer->getClientOriginalName();
            $flyer->move('uploads/events', $flyer_name);
            $event->flyer = 'uploads/events/'.$flyer_name;
            $event->save();
        }
        return redirect(route('admin.events.index'));
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        File::delete(public_path().'/'.$event->flyer);
        $event->delete();
        return redirect(route('admin.events.index'));
    }
}
