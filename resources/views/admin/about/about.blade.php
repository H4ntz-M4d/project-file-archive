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
                        <span class="fw-bold">Profile </span>
                        <!--end::Title-->
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Form-->
                    <div class="d-flex align-items-start">
                        <div class="col-3">
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                                <!--begin::Image preview wrapper-->
                                <div class="image-input-wrapper w-300px h-300px" style="background-position: center; background-position-y: -5rem; background-size: cover; background-image: url({{ asset('assets/media/avatars/IMG20240620102633.jpg') }})"></div>
                                <!--end::Image preview wrapper-->
                            </div>
                            
                        </div>
                        <div class="col-9 ps-10">
                            <div class="mb-5">
                                <span class="fw-bold fs-5">Aplikasi ini dibuat oleh:</span>
                            </div>
                            <div class="mb-10">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="10%">
                                            <h2 class="text-gray-700">Nama</h2>
                                        </td>
                                        <td>
                                            <h2 class="text-gray-700"> : Ince Ahmad Muhadi Ulilalbab</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <h2 class="text-gray-700">Prodi</h2>
                                        </td>
                                        <td>
                                            <h2 class="text-gray-700"> : D3 Manajemen Informatika PSDKU Pamekasan</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <h2 class="text-gray-700">NIM</h2>
                                        </td>
                                        <td>
                                            <h2 class="text-gray-700"> : 2231750008</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <h2 class="text-gray-700">Tanggal</h2>
                                        </td>
                                        <td>
                                            <h2 class="text-gray-700"> : 18 September 2025</h2>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <div>
                <button onclick="window.history.back();" class="btn btn-light-danger me-3">
                    Kembali
                </button>
            </div>
            <!--end::Tambah Surat-->
        </div>
        <!--end::Content container-->
    </div>
</x-layouts.app>
