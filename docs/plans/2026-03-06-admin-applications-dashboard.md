# Admin Applications And Dashboard Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Add admin modules for job applications and internship applications, and refresh the admin dashboard into an operational control tower.

**Architecture:** Keep Laravel monolith + Blade. Store operational data in existing tables, add review status to job and internship application records, expose protected admin routes for inbox/list/detail/download/status update, and redesign the admin shell/dashboard to surface summary metrics and recent activity. Public form flows stay unchanged.

**Tech Stack:** Laravel 12, Blade, PHPUnit feature tests, Vite, Bun, SQLite test database.

---

### Task 1: Lock behavior with failing tests

**Files:**
- Modify: `tests/Feature/AdminAuthenticationTest.php`
- Create: `tests/Feature/AdminDashboardOperationalTest.php`
- Create: `tests/Feature/AdminJobApplicationManagementTest.php`
- Create: `tests/Feature/AdminInternshipApplicationManagementTest.php`

**Step 1: Write failing tests**
- Dashboard shows counts for product inquiries, job applications, and internship applications.
- Dashboard shows recent activity cards or table rows for recent job and internship submissions.
- Admin can open job application index, detail, and download CV.
- Admin can open internship application index, detail, and download CV.
- Admin can update job and internship review statuses.

**Step 2: Run tests to verify red**
Run: `php artisan test tests/Feature/AdminDashboardOperationalTest.php tests/Feature/AdminJobApplicationManagementTest.php tests/Feature/AdminInternshipApplicationManagementTest.php`
Expected: FAIL because routes/controllers/status fields/views do not exist yet.

### Task 2: Add backend support for admin application modules

**Files:**
- Create: `database/migrations/2026_03_06_130000_add_status_to_job_applications_table.php`
- Create: `database/migrations/2026_03_06_130100_add_status_to_internship_applications_table.php`
- Modify: `app/Models/JobApplication.php`
- Modify: `app/Models/InternshipApplication.php`
- Create: `app/Http/Controllers/Admin/JobApplicationController.php`
- Create: `app/Http/Controllers/Admin/InternshipApplicationController.php`
- Create: `app/Http/Requests/Admin/UpdateJobApplicationStatusRequest.php`
- Create: `app/Http/Requests/Admin/UpdateInternshipApplicationStatusRequest.php`
- Modify: `routes/web.php`

**Step 1: Implement minimal backend**
- Add `status` column with sensible default (`baru`).
- Add constants / casts / helpers in models.
- Add admin routes for index, show, download CV, and status update.
- Keep file downloads on existing `local` disk.

**Step 2: Run targeted tests**
Run: `php artisan test tests/Feature/AdminJobApplicationManagementTest.php tests/Feature/AdminInternshipApplicationManagementTest.php`
Expected: PASS.

### Task 3: Refresh admin shell and dashboard UI

**Files:**
- Modify: `app/Http/Controllers/Admin/DashboardController.php`
- Modify: `resources/views/layouts/admin.blade.php`
- Modify: `resources/views/admin/dashboard.blade.php`
- Optionally modify: `resources/css/app.css`

**Step 1: Implement dashboard refresh**
- Add stronger sidebar navigation for products, job applications, internship applications, and product inquiries.
- Add top summary cards and recent activity sections.
- Keep the aesthetic consistent with existing site, but make admin feel like a focused operational workspace.

**Step 2: Run dashboard tests**
Run: `php artisan test tests/Feature/AdminDashboardOperationalTest.php`
Expected: PASS.

### Task 4: Add admin views for application inboxes

**Files:**
- Create: `resources/views/admin/job-applications/index.blade.php`
- Create: `resources/views/admin/job-applications/show.blade.php`
- Create: `resources/views/admin/internship-applications/index.blade.php`
- Create: `resources/views/admin/internship-applications/show.blade.php`
- Optionally modify: `resources/views/admin/product-inquiries/index.blade.php`

**Step 1: Build views**
- Use clean data tables, status badges, metadata blocks, and action controls.
- Expose detail and download actions clearly.
- Keep mobile fallback readable.

**Step 2: Re-run targeted tests**
Run: `php artisan test tests/Feature/AdminDashboardOperationalTest.php tests/Feature/AdminJobApplicationManagementTest.php tests/Feature/AdminInternshipApplicationManagementTest.php`
Expected: PASS.

### Task 5: Full verification

**Files:**
- Verify only

**Step 1: Run full test suite**
Run: `php artisan test`
Expected: PASS.

**Step 2: Run frontend build**
Run: `bun run build`
Expected: PASS.

**Step 3: Verify preview routes**
- `/admin`
- `/admin/dashboard`
- `/admin/job-applications`
- `/admin/internship-applications`
Expected: render/redirect correctly with updated admin shell.
