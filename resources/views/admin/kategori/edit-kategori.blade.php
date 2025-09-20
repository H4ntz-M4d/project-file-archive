<x-layouts.app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 pt-lg-1 pb-lg-8">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless flex-column align-items-start fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <span href="index.html" class="text-muted text-hover-primary fs-4 mb-5">
                            Tambahkan kategori untuk arsip surat baru pada form di bawah ini.
                        </span>
                    </li>
                    <li>
                        <span class="text-muted text-hover-primary fs-6">
                            Catatan: <br>
                            * Jangan lupa klik tombol simpan.
                        </span>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Tambah Surat-->
            <form id="kt_arsip_form" data-store-url="{{ route('kategori.update') }}" data-kt-redirect="{{ route('kategori.list') }}">
                <div class="card card-flush mb-7">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Title-->
                            <span class="fw-bold">Form Arsip Surat</span>
                            <!--end::Title-->
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Form-->
                        <div class="d-flex align-items-start">
                            <div class="d-none d-md-flex flex-column align-items-start justify-content-between gap-10 col-md-3 mt-3">
                                <!--begin::Label-->
                                <div class="mb-5">
                                    <label class="fw-bold required">ID kategori</label>
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="mb-5">
                                    <label class="fw-bold required">Nama Kategori</label>
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="mb-5">
                                    <label class="fw-bold required">Keterangan</label>
                                </div>
                                <!--end::Label-->
                            </div>
                            <div class="col-12 d-md-block col-md-9">
                                <!--begin::Input-->
                                <div class="form-floating mb-7">
                                <input type="text" class="form-control form-control-solid" name="id_kategori" required id="floatingInput"
                                value="{{ $kategori->id_kategori }}" readonly/>
                                    <label class="text-muted" for="floatingInput">ID</label>
                                </div>
                                <!--end::Input-->
                                <!--begin::Input-->
                                <div class="form-floating mb-7">
                                    <input type="text" class="form-control" name="nama_kategori" required id="floatingInput"
                                    placeholder="Katgeori" value="{{ $kategori->nama_kategori }}"/>
                                    <label class="text-muted" for="floatingInput">Nama Kategori</label>
                                </div>
                                <!--end::Input-->
                                <!--begin::Input-->
                                <div class="form-floating mb-7">
                                    <textarea type="text" class="form-control h-100px" name="keterangan" required id="floatingInput" 
                                        placeholder="Keterangan">{{ $kategori->keterangan }}</textarea>
                                    <label class="text-muted" for="floatingInput">Keterangan</label>
                                </div>
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--begin::Actions-->
                <div>
                    <button onclick="window.history.back();" class="btn btn-light-danger me-3">
                        Kembali
                    </button>
                    <button id="kt_arsip_form_submit" type="submit" class="btn btn-primary">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Tambah Surat-->
        </div>
        <!--end::Content container-->
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/custom/kategori/store-kategori.js') }}"></script>
    @endpush
</x-layouts.app>
