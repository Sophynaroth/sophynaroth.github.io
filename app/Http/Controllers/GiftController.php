<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{

    public function index()
    {
        $gifts = Gift::paginate(2);
        return view('backend.gift', compact('gifts'));
    }

    public function create()
    {
        return view('backend.gift-add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'giftName' => 'required',
            'typeGift' => 'required',
        ]);

        $filename = null;

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
        }

        $gift = new Gift;
        $gift->giftName = $request->giftName;
        $gift->typeLevel = $request->typeGift;
        $gift->image = $filename;
        $gift->save();

        return redirect()->route('gift.index')->with('success', 'New Gift Added Succefully!');
    }

    public function edit(string $id)
    {
        $gift = Gift::find($id);
        return view('backend.gift-edit', compact('gift'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'giftName' => 'required',
            'typeGift' => 'required',
        ]);

        $id = $request->input('id');
        $gift = Gift::find($id);

        $filename = $gift->image;
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
            if (isset($gift->image)) {
                $path = public_path() . '/images/' . $gift->image;
                unlink($path);
            }
        }
        $gift->giftName = $request->giftName;
        $gift->typeLevel = $request->typeGift;
        $gift->image = $filename;
        $gift->save();

        return redirect()->route('gift.index')->with('success', 'Gift Updated Succefully!');
    }

    public function destroy(string $id)
    {
        $gift = Gift::find($id);
        if (isset($gift->image)) {
            $path = public_path() . '/images/' . $gift->image;
            unlink($path);
        }
        $gift->delete();

        return redirect()->route('gift.index')->with('success', 'Gift Deleted Succefully!');
    }
}
