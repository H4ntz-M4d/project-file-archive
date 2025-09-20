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
                            Unggah surat yang telah terbit pada form ini untuk diarsipkan. <br>
                        </span>
                    </li>
                    <li>
                        <span class="text-muted text-hover-primary fs-6">
                            Catatan: <br>
                            * Gunakan file berformat PDF.
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
            <form id="kt_arsip_form" data-store-url="{{ route('arsip.update') }}" data-kt-redirect="{{ route('arsip.list') }}">
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
                                    <label class="fw-bold required">Nomor surat</label>
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="mb-5">
                                    <label class="fw-bold required">Kategori</label>
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="mb-5">
                                    <label class="fw-bold required">Judul surat</label>
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="mb-5">
                                    <label class="fw-bold required">Tanggal Pengarsipan</label>
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="mb-5">
                                    <label class="fw-bold required">Unggah surat</label>
                                </div>
                                <!--end::Label-->
                            </div>
                            <div class="col-12 d-md-block col-md-9">
                                <!--begin::Input-->
                                <div class="mb-7">
                                    <input type="text" class="form-control" name="slug" required
                                    value="{{ $arsip->slug }}" hidden readonly/>
                                </div>
                                <!--end::Input-->
                                <!--begin::Input-->
                                <div class="form-floating mb-7">
                                    <input type="text" class="form-control" name="nomor_surat" required id="floatingInput"
                                    value="{{ $arsip->nomor_surat }}" placeholder="Nomor Surat"/>
                                    <label class="text-muted" for="floatingInput">Nomor surat</label>
                                </div>
                                <!--end::Input-->
                                <!--begin::Select2-->
                                <select class="form-select mb-7" name="id_kategori" data-control="select2" data-placeholder="Pilih Kategori">
                                    <option></option>
                                    @foreach ($kategori as $item) 
                                        <option value="{{ $item->id_kategori }}" {{ $arsip->id_kategori == $item->id_kategori ? 'selected' : '' }}>
                                            {{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <!--begin::Select2-->
                                <!--begin::Input-->
                                <div class="form-floating mb-7">
                                    <input type="text" class="form-control" name="judul" required id="floatingInput"
                                    value="{{ $arsip->judul }}" placeholder="Judul Surat"/>
                                    <label class="text-muted" for="floatingInput">Judul surat</label>
                                </div>
                                <!--end::Input-->
                                <!--begin::Input-->
                                <div class="mb-7">
                                    <input type="text" class="form-control" name="waktu_pengarsipan" required id="kt_daterangepicker_3"
                                    value="{{ $arsip->waktu_pengarsipan }}" placeholder="Tanggal Pengarsipan"/>
                                </div>
                                <!--end::Input-->
                                <!--begin::Input-->
                                <div class="mb-7">
                                    <input type="hidden" id="edit_mode" value="1">
                                    <div class="dropzone dropzone-queue mb-2" id="kt_dropzonejs_example_3"
                                        data-existing-file="{{ $arsip->berkas ?? '' }}"
                                        data-existing-url="{{ $arsip->berkas ? asset('storage/'.$arsip->berkas) : '' }}">

                                        <!--begin::Controls-->
                                        <div class="dropzone-panel mb-lg-0 mb-2">
                                            <a class="dropzone-select btn btn-sm btn-primary me-2">Masukkan file</a>
                                            <a class="dropzone-remove-all btn btn-sm btn-light-primary">Hapus file</a>
                                        </div>
                                        <!--end::Controls-->

                                        <!--begin::Items-->
                                        <div class="dropzone-items wm-200px">
                                            <div class="dropzone-item" style="display:none">
                                                <!--begin::File-->
                                                <div class="dropzone-file">
                                                    <div class="dropzone-filename" title="some_image_file_name.jpg">
                                                        <span data-dz-name>some_image_file_name.jpg</span>
                                                        <strong>(<span data-dz-size>340kb</span>)</strong>
                                                    </div>

                                                    <div class="dropzone-error" data-dz-errormessage></div>
                                                </div>
                                                <!--end::File-->

                                                <!--begin::Progress-->
                                                <div class="dropzone-progress">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar bg-primary"
                                                            role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Progress-->

                                                <!--begin::Toolbar-->
                                                <div class="dropzone-toolbar">
                                                    <span class="dropzone-delete" data-dz-remove><i class="bi bi-x fs-1"></i></span>
                                                </div>
                                                <!--end::Toolbar-->
                                            </div>
                                        </div>
                                        <!--end::Items-->
                                    </div>

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
                    <a href="{{ route('arsip.list') }}" class="btn btn-light-danger me-3">
                        Kembali
                    </a>
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
        <script src="{{ asset('assets/js/custom/arsip/store-arsip.js') }}"></script>
    @endpush
</x-layouts.app>
