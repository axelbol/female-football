<?php

namespace App\Http\Controllers;

use App\Http\Requests\TouchRequest;
use App\Models\Touch;
use Illuminate\Http\Request;

class TouchController extends Controller
{
    public function index()
    {
        $touches = Touch::latest()->paginate(15);

        return view('admin.touches.index', compact('touches'));
    }

    public function create()
    {
        return view('touch');
    }

    public function store(TouchRequest $request)
    {
        Touch::create($request->validated());

        return redirect()->route('touch.create')
            ->with('success', 'Thank you for getting in touch! We\'ll contact you soon.');
    }
}
