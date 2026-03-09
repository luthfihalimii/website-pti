<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateInternshipApplicationStatusRequest;
use App\Models\InternshipApplication;
use Illuminate\Support\Facades\Storage;

class InternshipApplicationController extends Controller
{
    public function index()
    {
        return view('admin.internship-applications-index', [
            'applications' => InternshipApplication::query()->latest()->get(),
            'statusOptions' => InternshipApplication::statuses(),
        ]);
    }

    public function show(InternshipApplication $internshipApplication)
    {
        return view('admin.internship-applications-show', [
            'application' => $internshipApplication,
            'statusOptions' => InternshipApplication::statuses(),
        ]);
    }

    public function download(InternshipApplication $internshipApplication)
    {
        return Storage::disk($internshipApplication->cv_disk)->download(
            $internshipApplication->cv_path,
            basename($internshipApplication->cv_path)
        );
    }

    public function updateStatus(UpdateInternshipApplicationStatusRequest $request, InternshipApplication $internshipApplication)
    {
        $internshipApplication->update([
            'status' => $request->validated('status'),
        ]);

        return redirect()
            ->route('admin.internship-applications.show', $internshipApplication)
            ->with('status', 'Status pendaftaran magang berhasil diperbarui.');
    }

    public function destroy(InternshipApplication $internshipApplication)
    {
        if ($internshipApplication->cv_path && $internshipApplication->cv_disk) {
            Storage::disk($internshipApplication->cv_disk)->delete($internshipApplication->cv_path);
        }

        $internshipApplication->delete();

        return redirect()
            ->route('admin.internship-applications.index')
            ->with('status', 'Pendaftaran magang berhasil dihapus.');
    }
}
