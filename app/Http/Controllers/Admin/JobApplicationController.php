<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateJobApplicationStatusRequest;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function index()
    {
        return view('admin.job-applications-index', [
            'applications' => JobApplication::query()->latest()->get(),
            'statusOptions' => JobApplication::statuses(),
        ]);
    }

    public function show(JobApplication $jobApplication)
    {
        return view('admin.job-applications-show', [
            'application' => $jobApplication,
            'statusOptions' => JobApplication::statuses(),
        ]);
    }

    public function download(JobApplication $jobApplication)
    {
        return Storage::disk($jobApplication->cv_disk)->download(
            $jobApplication->cv_path,
            basename($jobApplication->cv_path)
        );
    }

    public function updateStatus(UpdateJobApplicationStatusRequest $request, JobApplication $jobApplication)
    {
        $jobApplication->update([
            'status' => $request->validated('status'),
        ]);

        return redirect()
            ->route('admin.job-applications.show', $jobApplication)
            ->with('status', 'Status lamaran kerja berhasil diperbarui.');
    }
}
