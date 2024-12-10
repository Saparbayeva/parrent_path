<?php
namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function index()
    {
        $query = Auth::user()->hasRole('admin') ?
            Resource::query() : Resource::where('user_id', Auth::id());

        $resources = $query->get();
        return view('resources.index', compact('resources'));
    }

    public function create()
    {
        return view('resources.create');
    }

    public function store(ResourceRequest $request)
    {
        $params = $request->validated();
        $params['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $params['image'] = $request->file('image')->store('resources');
        }
        $resource = Resource::create($params);

        return redirect()->route('resources.index')->with('success', 'Resource created successfully and pending approval.');
    }


    public function show($id)
    {
        $resource = Resource::findOrFail($id);
        return view('resources.show', compact('resource'));
    }

    public function edit($id)
    {
        $resource = Resource::findOrFail($id);

        // Foydalanuvchi faqat o'z resursini tahrirlashga ruxsat beriladi
        if ($resource->user_id != auth()->id()) {
            return redirect()->route('resources.index')->with('error', 'You can only edit your own resources.');
        }

        return view('resources.edit', compact('resource'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:resources,slug,' . $id,
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $resource = Resource::findOrFail($id);

        $imagePath = $resource->image;
        if ($request->hasFile('image')) {
            if ($resource->image) {
                Storage::delete('public/' . $resource->image);
            }
            $imagePath = $request->file('image')->store('resources', 'public');
        }

        $resource->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('resources.index');
    }

    public function destroy($id)
    {
        $resource = Resource::findOrFail($id);

        // Foydalanuvchi faqat o'z resursini o'chirishi mumkin
        if ($resource->user_id != auth()->id()) {
            return redirect()->route('resources.index')->with('error', 'You can only delete your own resources.');
        }

        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Resource deleted successfully.');
    }

    public function approve($id)
    {
        $resource = Resource::findOrFail($id);

        // Foydalanuvchi faqat o'z resursini o'chirishi mumkin
//        if (!Auth::user()->hasRole('admin')) {
//            return redirect()->route('resources.index')->with('error', 'Faqat admin tasdiqlay oladi!');
//        }

        $resource->update([ 'status' => Resource::STATUS_APPROVED ]);

        return redirect()->route('resources.index')->with('success', 'Resource approved successfully.');
    }

    public function reject($id)
    {
        $resource = Resource::findOrFail($id);

        // Foydalanuvchi faqat o'z resursini o'chirishi mumkin
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('resources.index')->with('error', 'Faqat admin rad eta oladi!');
        }

        $resource->update([ 'status' => Resource::STATUS_REJECTED ]);

        return redirect()->route('resources.index')->with('success', 'Resource rejected successfully.');
    }
}
