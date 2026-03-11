@csrf
@if (($method ?? 'POST') === 'PUT')
  @method('PUT')
@endif

<div class="grid gap-5 md:grid-cols-2">
  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Judul Posisi</span>
    <input type="text" name="title" value="{{ old('title', $vacancy->title ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
  </label>

  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Slug</span>
    <input type="text" name="slug" value="{{ old('slug', $vacancy->slug ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
  </label>
</div>

<div class="mt-5 grid gap-5 md:grid-cols-2">
  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Tipe Pekerjaan</span>
    <input type="text" name="employment_type" value="{{ old('employment_type', $vacancy->employment_type ?? 'Full Time') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
  </label>

  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Range Gaji</span>
    <input type="text" name="salary_range" value="{{ old('salary_range', $vacancy->salary_range ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
  </label>
</div>

<label class="mt-5 block">
  <span class="mb-2 block text-sm font-medium text-slate-700">Headline</span>
  <input type="text" name="headline" value="{{ old('headline', $vacancy->headline ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
</label>

<label class="mt-5 block">
  <span class="mb-2 block text-sm font-medium text-slate-700">Ringkasan</span>
  <textarea name="summary" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>{{ old('summary', $vacancy->summary ?? '') }}</textarea>
</label>

<label class="mt-5 block">
  <span class="mb-2 block text-sm font-medium text-slate-700">Deskripsi</span>
  <textarea name="description" rows="6" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>{{ old('description', $vacancy->description ?? '') }}</textarea>
</label>

<div class="mt-5 grid gap-5 md:grid-cols-3">
  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Kualifikasi (1 baris = 1 poin)</span>
    <textarea name="qualifications" rows="8" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>{{ old('qualifications', isset($vacancy) ? implode(PHP_EOL, $vacancy->qualifications ?? []) : '') }}</textarea>
  </label>

  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Skill (1 baris = 1 poin)</span>
    <textarea name="skills" rows="8" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>{{ old('skills', isset($vacancy) ? implode(PHP_EOL, $vacancy->skills ?? []) : '') }}</textarea>
  </label>

  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Benefit (1 baris = 1 poin)</span>
    <textarea name="benefits" rows="8" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>{{ old('benefits', isset($vacancy) ? implode(PHP_EOL, $vacancy->benefits ?? []) : '') }}</textarea>
  </label>
</div>

<div class="mt-5 grid gap-5 md:grid-cols-2">
  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Catatan Gaji</span>
    <input type="text" name="salary_note" value="{{ old('salary_note', $vacancy->salary_note ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
  </label>

  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Konteks Gaji</span>
    <input type="text" name="salary_context" value="{{ old('salary_context', $vacancy->salary_context ?? '') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
  </label>
</div>

<div class="mt-5 grid gap-5 md:grid-cols-3">
  <label class="block md:col-span-2">
    <span class="mb-2 block text-sm font-medium text-slate-700">Path Poster (public)</span>
    <input type="text" name="poster_path" value="{{ old('poster_path', $vacancy->poster_path ?? 'assets/images/poster-lowongan.png') }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
  </label>

  <label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Urutan</span>
    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $vacancy->sort_order ?? 0) }}" class="h-12 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">
  </label>
</div>

<label class="mt-5 inline-flex items-center gap-3 text-sm font-medium text-slate-700">
  <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $vacancy->is_active ?? true)) class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-200">
  <span>Aktifkan lowongan ini</span>
</label>

<div class="mt-8 flex gap-3">
  <button type="submit" class="inline-flex h-12 items-center justify-center rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
    {{ $submitLabel ?? 'Simpan Lowongan' }}
  </button>
  <a href="{{ route('admin.vacancies.index') }}" class="inline-flex h-12 items-center justify-center rounded-xl border border-slate-300 px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
    Kembali
  </a>
</div>
