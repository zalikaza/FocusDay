@extends('layouts.app')

@section('title', 'Pengaturan - FocusDay')

@section('content')
<div class="container-fluid px-0 px-md-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-1">Pengaturan</h2>
            <p class="text-muted mb-0">Sesuaikan preferensi tampilan dan akun Anda</p>
        </div>
    </div>



    <div class="row">
        <!-- KOLOM KIRI: PROFIL PENGGUNA -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <!-- Avatar Placeholder (Ganti src dengan foto user asli nanti) -->
                    <div class="profile-avatar-wrapper d-inline-block mb-3">
                        <img src="{{ !empty($user?->profile) ? asset($user->profile) : ('https://ui-avatars.com/api/?name=' . urlencode($user->username ?? 'User') . '&background=10b981&color=fff&size=128') }}" 
                             alt="User Avatar" 
                             class="rounded-circle shadow-sm"
                             style="width: 100px; height: 100px; object-fit: cover;">
                        <button type="button" class="profile-avatar-edit" aria-label="Edit profile" id="profileAvatarEditBtn">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('settings.profile.photo.update') }}" enctype="multipart/form-data" class="d-none" id="profilePhotoForm">
                        @csrf
                        <input type="file" name="profile_photo" accept="image/*" id="profilePhotoInput">
                    </form>
                    
                    <h5 class="fw-bold text-dark mb-1">{{ $user->username ?? 'Pengguna' }}</h5>
                    <p class="text-muted small mb-4">{{ $user->email ?? '-' }}</p>
                    
                    <hr class="my-3">
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-success btn-sm w-100" type="button" id="editProfileBtn" aria-expanded="false" aria-controls="editProfileCollapse">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profil
                        </button>
                        <button class="btn btn-outline-secondary btn-sm w-100" type="button" id="changePasswordBtn" aria-expanded="false" aria-controls="changePasswordCollapse">
                            <i class="bi bi-key me-2"></i>Ganti Password
                        </button>

                        @if (!empty($user?->profile))
                            <form method="POST" action="{{ route('settings.profile.photo.delete') }}" id="deleteProfilePhotoForm">
                                @csrf
                                <button type="button" class="btn btn-outline-danger btn-sm w-100" id="deleteProfilePhotoBtn">
                                    <i class="bi bi-trash me-2"></i>Hapus Foto Profil
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: OPSI PENGATURAN -->
        <div class="col-lg-8">

            <div class="mb-4 d-none" id="editProfileCollapse">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-person me-2" style="color: #10b981;"></i>Edit Profil
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.profile.update') }}" id="editProfileForm">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark" for="profileUsername">Username</label>
                                <input id="profileUsername" type="text" class="form-control" name="username" value="{{ old('username', $user->username ?? '') }}" required>
                                @error('username')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark" for="profileEmail">Email</label>
                                <input id="profileEmail" type="email" class="form-control" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success btn-sm" type="button" id="submitEditProfileBtn">Ubah Profil</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mb-4 d-none" id="changePasswordCollapse">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-key me-2" style="color: #10b981;"></i>Ganti Password
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.password.update') }}" id="changePasswordForm">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark" for="currentPassword">Password Lama</label>
                                <div class="position-relative">
                                    <input id="currentPassword" type="password" class="form-control" name="current_password" required>
                                    <span class="password-toggle" onclick="toggleCurrentPassword()">
                                        <i class="bi bi-eye" id="toggleCurrentPasswordIcon"></i>
                                    </span>
                                </div>
                                <div class="text-danger small mt-1 d-none" id="currentPasswordClientError"></div>
                                @error('current_password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark" for="newPassword">Password Baru</label>
                                <div class="position-relative">
                                    <input id="newPassword" type="password" class="form-control" name="password" required>
                                    <span class="password-toggle" onclick="toggleNewPassword()">
                                        <i class="bi bi-eye" id="toggleNewPasswordIcon"></i>
                                    </span>
                                </div>
                                <div class="text-danger small mt-1 d-none" id="newPasswordClientError"></div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark" for="newPasswordConfirmation">Konfirmasi Password Baru</label>
                                <div class="position-relative">
                                    <input id="newPasswordConfirmation" type="password" class="form-control" name="password_confirmation" required>
                                    <span class="password-toggle" onclick="toggleNewPasswordConfirmation()">
                                        <i class="bi bi-eye" id="toggleNewPasswordConfirmationIcon"></i>
                                    </span>
                                </div>
                                <div class="text-danger small mt-1 d-none" id="newPasswordConfirmationClientError"></div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success btn-sm" type="button" id="submitChangePasswordBtn">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- 1. PENGATURAN TAMPILAN -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-palette me-2" style="color: #10b981;"></i>Tampilan
                    </h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('settings.preferences.update') }}" id="preferencesForm">
                        @csrf
                        <input type="hidden" name="theme" id="prefTheme" value="{{ old('theme', $user->theme ?? 'light') }}">

                        <!-- Opsi Mode Gelap -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <p class="fw-semibold mb-0 text-dark">Mode Gelap</p>
                                <p class="text-muted small mb-0">Aktifkan tema gelap untuk kenyamanan mata di malam hari.</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="darkModeSwitch" role="switch">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- 3. ZONA BAHAYA -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0 text-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>Zona Bahaya
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                            @csrf
                            <button type="button" class="btn btn-danger btn-sm" id="logoutBtn">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteProfilePhotoModal" tabindex="-1" aria-labelledby="deleteProfilePhotoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="deleteProfilePhotoModalLabel">Hapus Foto Profil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0 text-muted">Foto profil akan dihapus dan tidak dapat dikembalikan.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteProfilePhotoBtn">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="confirmEditProfileModal" tabindex="-1" aria-labelledby="confirmEditProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="confirmEditProfileModalLabel">Konfirmasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0 text-muted">Yakin untuk mengganti profil?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success" id="confirmEditProfileBtn">Yakin</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="confirmChangePasswordModal" tabindex="-1" aria-labelledby="confirmChangePasswordModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="confirmChangePasswordModalLabel">Konfirmasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0 text-muted">Yakin untuk mengganti password?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success" id="confirmChangePasswordBtn">Yakin</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header" style="background: rgba(220, 38, 38, 0.08);">
                            <h5 class="modal-title fw-bold text-danger" id="confirmLogoutModalLabel">
                                <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Logout
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0 text-muted">Yakin ingin logout dari akun ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" id="confirmLogoutBtn">Logout</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="logoutLoadingModal" tabindex="-1" aria-labelledby="logoutLoadingModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-body py-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="spinner-border text-danger" role="status" aria-hidden="true"></div>
                                <div>
                                    <div class="fw-semibold text-dark" id="logoutLoadingModalLabel">Memproses logout...</div>
                                    <div class="text-muted small">Mohon tunggu sebentar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Styling khusus halaman Settings agar konsisten */
    .card {
        border-radius: 12px;
        transition: transform 0.2s ease;
    }

    .profile-avatar-wrapper {
        position: relative;
    }

    .profile-avatar-edit {
        position: absolute;
        left: 2px;
        bottom: 2px;
        width: 28px;
        height: 28px;
        border-radius: 999px;
        border: 1px solid rgba(0,0,0,0.08);
        background: rgba(255,255,255,0.9);
        color: #10b981;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        cursor: pointer;
        box-shadow: 0 6px 14px rgba(0,0,0,0.12);
    }

    html[data-theme="dark"] .profile-avatar-edit {
        background: rgba(31, 41, 55, 0.9);
        border-color: rgba(255,255,255,0.12);
        color: #34d399;
    }

    .form-check-input {
        cursor: pointer;
        width: 3em;
        height: 1.5em;
    }

    /* Warna Switch Toggle Sesuai Brand (Hijau) */
    .form-check-input:checked {
        background-color: #10b981;
        border-color: #10b981;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25);
        border-color: #10b981;
    }

    /* Avatar Hover Effect */
    .rounded-circle {
        transition: transform 0.2s;
    }
    .rounded-circle:hover {
        transform: scale(1.05);
    }

    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6b7280;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #10b981;
    }
</style>
@endpush

@push('scripts')
<script>
    const preferencesForm = document.getElementById('preferencesForm');
    const darkModeSwitch = document.getElementById('darkModeSwitch');
    const prefTheme = document.getElementById('prefTheme');

    const editProfileForm = document.getElementById('editProfileForm');
    const submitEditProfileBtn = document.getElementById('submitEditProfileBtn');
    const confirmEditProfileBtn = document.getElementById('confirmEditProfileBtn');

    const changePasswordForm = document.getElementById('changePasswordForm');
    const submitChangePasswordBtn = document.getElementById('submitChangePasswordBtn');
    const confirmChangePasswordBtn = document.getElementById('confirmChangePasswordBtn');

    const logoutForm = document.getElementById('logoutForm');
    const logoutBtn = document.getElementById('logoutBtn');
    const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');

    const profileAvatarEditBtn = document.getElementById('profileAvatarEditBtn');
    const profilePhotoForm = document.getElementById('profilePhotoForm');
    const profilePhotoInput = document.getElementById('profilePhotoInput');

    const deleteProfilePhotoBtn = document.getElementById('deleteProfilePhotoBtn');
    const deleteProfilePhotoForm = document.getElementById('deleteProfilePhotoForm');
    const confirmDeleteProfilePhotoBtn = document.getElementById('confirmDeleteProfilePhotoBtn');

    if (profileAvatarEditBtn && profilePhotoInput && profilePhotoForm) {
        profileAvatarEditBtn.addEventListener('click', function(e) {
            e.preventDefault();
            profilePhotoInput.click();
        });

        profilePhotoInput.addEventListener('change', function() {
            if (!this.files || !this.files.length) return;
            profilePhotoForm.submit();
        });
    }

    if (deleteProfilePhotoBtn && deleteProfilePhotoForm && confirmDeleteProfilePhotoBtn) {
        const deleteModalEl = document.getElementById('deleteProfilePhotoModal');
        const deleteModal = deleteModalEl ? new bootstrap.Modal(deleteModalEl) : null;

        deleteProfilePhotoBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (deleteModal) {
                deleteModal.show();
            } else {
                deleteProfilePhotoForm.submit();
            }
        });

        confirmDeleteProfilePhotoBtn.addEventListener('click', function() {
            deleteProfilePhotoForm.submit();
        });
    }

    if (editProfileForm && submitEditProfileBtn && confirmEditProfileBtn) {
        const modalEl = document.getElementById('confirmEditProfileModal');
        const modal = modalEl ? new bootstrap.Modal(modalEl) : null;

        submitEditProfileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (modal) {
                modal.show();
            } else {
                editProfileForm.submit();
            }
        });

        confirmEditProfileBtn.addEventListener('click', function() {
            editProfileForm.submit();
        });
    }

    if (changePasswordForm && submitChangePasswordBtn && confirmChangePasswordBtn) {
        const modalEl = document.getElementById('confirmChangePasswordModal');
        const modal = modalEl ? new bootstrap.Modal(modalEl) : null;

        const currentPasswordInput = document.getElementById('currentPassword');
        const newPasswordInput = document.getElementById('newPassword');
        const newPasswordConfirmationInput = document.getElementById('newPasswordConfirmation');

        const currentPasswordClientError = document.getElementById('currentPasswordClientError');
        const newPasswordClientError = document.getElementById('newPasswordClientError');
        const newPasswordConfirmationClientError = document.getElementById('newPasswordConfirmationClientError');

        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        const hideClientError = (el) => {
            if (!el) return;
            el.textContent = '';
            el.classList.add('d-none');
        };

        const showClientError = (el, message) => {
            if (!el) return;
            el.textContent = String(message || '');
            el.classList.remove('d-none');
        };

        const validateNewPasswordClient = () => {
            hideClientError(currentPasswordClientError);
            hideClientError(newPasswordClientError);
            hideClientError(newPasswordConfirmationClientError);

            const currentPassword = currentPasswordInput ? String(currentPasswordInput.value || '') : '';
            const newPassword = newPasswordInput ? String(newPasswordInput.value || '') : '';
            const newPasswordConfirmation = newPasswordConfirmationInput ? String(newPasswordConfirmationInput.value || '') : '';

            if (!currentPassword) {
                showClientError(currentPasswordClientError, 'Password lama wajib diisi.');
                if (currentPasswordInput) currentPasswordInput.focus();
                return { ok: false };
            }

            if (newPassword.length < 8) {
                showClientError(newPasswordClientError, 'Password baru minimal 8 karakter.');
                if (newPasswordInput) newPasswordInput.focus();
                return { ok: false };
            }

            if (newPasswordConfirmation !== newPassword) {
                showClientError(newPasswordConfirmationClientError, 'Konfirmasi password tidak sama.');
                if (newPasswordConfirmationInput) newPasswordConfirmationInput.focus();
                return { ok: false };
            }

            return { ok: true, currentPassword };
        };

        submitChangePasswordBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const clientCheck = validateNewPasswordClient();
            if (!clientCheck.ok) return;

            fetch('{{ route('settings.password.check') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ current_password: clientCheck.currentPassword }),
            })
                .then(res => {
                    if (!res.ok) throw new Error('Gagal memverifikasi password');
                    return res.json().catch(() => ({}));
                })
                .then(data => {
                    if (!data || data.ok !== true) {
                        showClientError(currentPasswordClientError, 'Password lama tidak sesuai.');
                        if (currentPasswordInput) currentPasswordInput.focus();
                        return;
                    }

                    if (modal) {
                        modal.show();
                    } else {
                        changePasswordForm.submit();
                    }
                })
                .catch(() => {
                    showClientError(currentPasswordClientError, 'Gagal memverifikasi password lama. Coba lagi.');
                });
        });

        confirmChangePasswordBtn.addEventListener('click', function() {
            changePasswordForm.submit();
        });
    }

    if (logoutForm && logoutBtn && confirmLogoutBtn) {
        const confirmLogoutModalEl = document.getElementById('confirmLogoutModal');
        const confirmLogoutModal = confirmLogoutModalEl ? new bootstrap.Modal(confirmLogoutModalEl) : null;

        const loadingModalEl = document.getElementById('logoutLoadingModal');
        const loadingModal = loadingModalEl ? new bootstrap.Modal(loadingModalEl) : null;

        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirmLogoutModal) {
                confirmLogoutModal.show();
            } else {
                logoutForm.submit();
            }
        });

        confirmLogoutBtn.addEventListener('click', function() {
            if (confirmLogoutModal) {
                confirmLogoutModal.hide();
            }

            if (loadingModal) {
                loadingModal.show();
                setTimeout(function() {
                    logoutForm.submit();
                }, 1400);
            } else {
                setTimeout(function() {
                    logoutForm.submit();
                }, 600);
            }
        });
    }

    if (preferencesForm && darkModeSwitch && prefTheme) {
        const root = document.documentElement;
        const storedTheme = localStorage.getItem('theme');
        const domTheme = root.getAttribute('data-theme');
        const initialTheme = (domTheme || storedTheme || prefTheme.value || 'light');

        darkModeSwitch.checked = initialTheme === 'dark';
        prefTheme.value = initialTheme;

        darkModeSwitch.addEventListener('change', function() {
            const nextTheme = this.checked ? 'dark' : 'light';
            prefTheme.value = nextTheme;
            root.setAttribute('data-theme', nextTheme);
            localStorage.setItem('theme', nextTheme);
        });

        window.addEventListener('storage', function(e) {
            if (e.key !== 'theme') return;
            const nextTheme = e.newValue || 'light';
            prefTheme.value = nextTheme;
            darkModeSwitch.checked = nextTheme === 'dark';
            root.setAttribute('data-theme', nextTheme);
        });
    }

    const editProfileBtn = document.getElementById('editProfileBtn');
    const changePasswordBtn = document.getElementById('changePasswordBtn');
    const editProfileCollapseEl = document.getElementById('editProfileCollapse');
    const changePasswordCollapseEl = document.getElementById('changePasswordCollapse');

    if (editProfileBtn && changePasswordBtn && editProfileCollapseEl && changePasswordCollapseEl) {
        const togglePanel = (panelEl) => {
            panelEl.classList.toggle('d-none');
        };

        editProfileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            togglePanel(editProfileCollapseEl);
        });

        changePasswordBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            togglePanel(changePasswordCollapseEl);
        });
    }

    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (!input || !icon) return;

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }

    function toggleCurrentPassword() {
        togglePassword('currentPassword', 'toggleCurrentPasswordIcon');
    }

    function toggleNewPassword() {
        togglePassword('newPassword', 'toggleNewPasswordIcon');
    }

    function toggleNewPasswordConfirmation() {
        togglePassword('newPasswordConfirmation', 'toggleNewPasswordConfirmationIcon');
    }
</script>
@endpush