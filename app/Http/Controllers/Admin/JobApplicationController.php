<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateJobApplicationStatusRequest;
use App\Models\JobApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function index()
    {
        return view('admin.job-applications-index', [
            'applications' => JobApplication::query()->latest('id')->paginate(15),
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
        abort_unless(
            $jobApplication->cv_path
                && $jobApplication->cv_disk
                && Storage::disk($jobApplication->cv_disk)->exists($jobApplication->cv_path),
            404
        );

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

    public function destroy(JobApplication $jobApplication)
    {
        $fileToDelete = $jobApplication->cv_path && $jobApplication->cv_disk
            ? ['disk' => $jobApplication->cv_disk, 'path' => $jobApplication->cv_path]
            : null;

        DB::transaction(function () use ($jobApplication): void {
            $jobApplication->delete();
        });

        if ($fileToDelete && Storage::disk($fileToDelete['disk'])->exists($fileToDelete['path'])) {
            Storage::disk($fileToDelete['disk'])->delete($fileToDelete['path']);
        }

        return redirect()
            ->route('admin.job-applications.index')
            ->with('status', 'Lamaran kerja berhasil dihapus.');
    }
}
