<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInternshipStepOneRequest;
use App\Http\Requests\StoreInternshipStepTwoRequest;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;

class InternshipApplicationController extends Controller
{
    public function createStepOne()
    {
        return view('pages.magang-tahap1', [
            'stepOneData' => session('internship_application.step_one', []),
        ]);
    }

    public function storeStepOne(StoreInternshipStepOneRequest $request)
    {
        $request->session()->put('internship_application.step_one', $request->validated());

        return redirect()->route('internships.steps.two');
    }

    public function createStepTwo(Request $request)
    {
        if (! $request->session()->has('internship_application.step_one')) {
            return redirect()
                ->route('internships.steps.one')
                ->with('internship_error', __('Lengkapi Tahap 1 terlebih dahulu sebelum melanjutkan.'));
        }

        return view('pages.magang-tahap2', [
            'stepOneData' => $request->session()->get('internship_application.step_one'),
            'divisions' => config('site.internships.divisions'),
        ]);
    }

    public function storeStepTwo(StoreInternshipStepTwoRequest $request)
    {
        $stepOne = $request->session()->get('internship_application.step_one');

        abort_unless(is_array($stepOne), 403);

        $validated = $request->validated();
        $cvPath = $request->file('cv')->store('internship-applications/cv', 'local');

        InternshipApplication::create([
            ...$stepOne,
            ...collect($validated)->except('cv')->toArray(),
            'cv_path' => $cvPath,
            'cv_disk' => 'local',
            'pernyataan' => $request->boolean('pernyataan'),
        ]);

        $request->session()->forget('internship_application.step_one');

        return redirect()
            ->route('internships.steps.one')
            ->with('internship_status', __('Pendaftaran magang berhasil dikirim. Kami akan menghubungi Anda setelah proses review.'));
    }
}
