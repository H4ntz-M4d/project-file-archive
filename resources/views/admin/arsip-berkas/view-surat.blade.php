<x-layouts.app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Tambah Surat-->
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
                        <div class="d-flex flex-column align-items-start justify-content-between gap-4 col-md-3 mt-3">
                            <!--begin::Label-->
                            <div class="mb-5">
                                <label class="fw-bold ">Nomor surat</label>
                            </div>
                            <!--end::Label-->
                            <!--begin::Label-->
                            <div class="mb-5">
                                <label class="fw-bold ">Kategori</label>
                            </div>
                            <!--end::Label-->
                            <!--begin::Label-->
                            <div class="mb-5">
                                <label class="fw-bold ">Judul surat</label>
                            </div>
                            <!--end::Label-->
                            <!--begin::Label-->
                            <div class="mb-5">
                                <label class="fw-bold ">Tanggal Pengarsipan</label>
                            </div>
                            <!--end::Label-->
                        </div>
                        <div class="d-flex flex-column align-items-start justify-content-between gap-4 col-md-3 mt-3">
                            <!--begin::Label-->
                            <div class="mb-5">
                                <label class="fw-bold ">: {{ $arsip->nomor_surat }}</label>
                            </div>
                            <!--end::Label-->
                            <!--begin::Label-->
                            <div class="mb-5">
                                <label class="fw-bold ">: {{ $arsip->kategoris->nama_kategori }}</label>
                            </div>
                            <!--end::Label-->
                            <!--begin::Label-->
                            <div class="mb-5">
                                <label class="fw-bold ">: {{ $arsip->judul }}</label>
                            </div>
                            <!--end::Label-->
                            <!--begin::Label-->
                            <div class="mb-5">
                                <label class="fw-bold ">: {{ $arsip->waktu_pengarsipan }}</label>
                            </div>
                            <!--end::Label-->
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <embed src="{{ asset('storage/'. $arsip->berkas) }}" height="600" width="900">
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <div>
                <button onclick="window.history.back();" class="btn btn-light-danger me-3">
                    Kembali
                </button>
                <a href="/arsip-surat/download/{{ $arsip->slug }}" class="btn btn-info me-3">
                    Unduh
                </a>
                <a href="/arsip-surat/edit-surat/{{ $arsip->slug }}" class="btn btn-primary me-3">
                    Edit
                </a>
            </div>
            <!--end::Tambah Surat-->
        </div>
        <!--end::Content container-->
    </div>
</x-layouts.app>
