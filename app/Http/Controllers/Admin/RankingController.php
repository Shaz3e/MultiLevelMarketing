<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ranking\StoreRankingRequest;
use App\Models\Ranking;
use App\Trait\Admin\FormHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class RankingController extends Controller
{
    use FormHelper;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check Authorize
        Gate::authorize('viewAny', Ranking::class);

        return view('admin.ranking.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check Authorize
        Gate::authorize('create', Ranking::class);

        return view('admin.ranking.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRankingRequest $request)
    {
        // Check Authorize
        Gate::authorize('create', Ranking::class);

        // Validate data
        $validated = $request->validated();

        // Update record in database
        $ranking = Ranking::create($validated);

        // Upload Icon
        if ($request->hasFile('icon')) {
            $filename = time() . '.' . $request->file('icon')->extension();
            $icon = $request->file('icon')->storeAs('rankings/icons', $filename, 'public');
            $ranking->icon = $icon;
        }

        // Upload Reward Image
        if ($request->hasFile('reward_image')) {
            $filename = time() . '.' . $request->file('reward_image')->extension();
            $reward_image = $request->file('reward_image')->storeAs('rankings/rewards', $filename, 'public');
            $ranking->reward_image = $reward_image;
        }

        $ranking->save();

        session()->flash('success', 'Ranking has been created successfully!');

        return $this->saveAndRedirect($request, 'rankings', $ranking->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ranking $ranking)
    {
        // Check Authorize
        Gate::authorize('read', $ranking);

        return view('admin.ranking.show', [
            'ranking' => $ranking,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ranking $ranking)
    {
        // Check Authorize
        Gate::authorize('update', $ranking);

        return view('admin.ranking.edit', [
            'ranking' => $ranking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRankingRequest $request, Ranking $ranking)
    {
        // Check Authorize
        Gate::authorize('update', $ranking);

        // Validate data
        $validated = $request->validated();

        // Update record in database
        $ranking->update($validated);

        // Upload Icon
        if ($request->hasFile('icon')) {
            File::delete('storage/' . $ranking->icon);
            $filename = time() . '.' . $request->file('icon')->extension();
            $icon = $request->file('icon')->storeAs('rankings/icons', $filename, 'public');
            $ranking->icon = $icon;
        }
        
        // Upload Reward Image
        if ($request->hasFile('reward_image')) {
            File::delete('storage/' . $ranking->reward_image);
            $filename = time() . '.' . $request->file('reward_image')->extension();
            $reward_image = $request->file('reward_image')->storeAs('rankings/rewards', $filename, 'public');
            $ranking->reward_image = $reward_image;
        }

        $ranking->save();

        // Flash message
        session()->flash('success', 'Ranking has been updated successfully!');

        return $this->saveAndRedirect($request, 'rankings', $ranking->id);
    }
}
