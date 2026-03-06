<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    public function store(StoreJobApplicationRequest $request)
    {
        $validated = $request->validated();
        $cvPath = $request->file('cv')->store('job-applications/cv', 'local');

        JobApplication::create([
            ...collect($validated)->except('cv')->toArray(),
            'cv_path' => $cvPath,
            'cv_disk' => 'local',
            'pernyataan_1' => $request->boolean('pernyataan_1'),
            'pernyataan_2' => $request->boolean('pernyataan_2'),
            'pernyataan_3' => $request->boolean('pernyataan_3'),
        ]);

        return redirect()
            ->route('careers.applications.create')
            ->with('status', __('Lamaran berhasil dikirim. Tim kami akan meninjau data Anda.'));
    }
}
