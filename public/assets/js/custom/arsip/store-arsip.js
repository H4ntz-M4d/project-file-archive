"use strict";
var KTAddArsipSurat = (function () {
    $("#kt_daterangepicker_3").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
        timePicker24Hour: true,
        timePickerSeconds: true,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"), 10),
        locale: {
            format: "YYYY-MM-DD HH:mm:ss" // format output yang dihasilkan
        }
    });


    return {
        init: function () {
            // Dropzone container
            const id = "#kt_dropzonejs_example_3";
            const dropzone = document.querySelector(id);

            // Template preview
            var previewNode = dropzone.querySelector(".dropzone-item");
            previewNode.id = "";
            var previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);

            // Init Dropzone
            var myDropzone = new Dropzone(id, {
                url: document.getElementById('kt_arsip_form').getAttribute('data-store-url'),
                paramName: "berkas",
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                parallelUploads: 1,
                acceptedFiles: ".pdf",
                autoProcessQueue: false,
                addRemoveLinks: true,
                maxFilesize: 2,
                previewTemplate: previewTemplate,
                previewsContainer: id + " .dropzone-items",
                clickable: id + " .dropzone-select",
                init: function () {
                    const myDropzone = this;
                    const isEdit = !!document.getElementById("edit_mode");
                    myDropzone.removedFiles = [];

                    myDropzone.on("removedfile", function (file) {
                        if (file.name && !file.upload) {
                            myDropzone.removedFiles.push(file.name); // ⬅ pastikan masuk ke properti
                        }
                    });

                    if (isEdit) {
                        const existingFileName = dropzone.getAttribute("data-existing-file");
                        const existingFileUrl = dropzone.getAttribute("data-existing-url");

                        if (existingFileName && existingFileUrl) {
                            // Mock file yang mewakili file lama
                            const mockFile = {
                                name: existingFileName,
                                size: 123456, // Opsional, bisa ambil dari DB
                                accepted: true
                            };

                            // Tambahkan ke Dropzone
                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("complete", mockFile);
                            myDropzone.files.push(mockFile);

                            // Menambahkan link download/view ke preview
                            const previewEls = dropzone.querySelectorAll('.dropzone-item');
                            previewEls.forEach(item => {
                                item.style.display = '';

                                const downloadLink = document.createElement('a');
                                downloadLink.href = existingFileUrl;
                                downloadLink.target = "_blank";
                                downloadLink.className = "d-flex justify-content-center align-items-center";
                                downloadLink.innerHTML = '<i class="ki-solid ki-eye fs-2"></i>';

                                const actionsContainer = item.querySelector('.dropzone-toolbar');
                                if (actionsContainer) {
                                    actionsContainer.appendChild(downloadLink);
                                } else {
                                    item.appendChild(downloadLink);
                                }
                            });
                        }
                    }

                }
            });

            myDropzone.on("addedfile", function () {
                const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
                dropzoneItems.forEach(item => {
                    item.style.display = '';
                });
            });

            // Tambahkan semua field form ke FormData
            myDropzone.on("sending", function (file, xhr, formData) {
                const formFields = document.querySelectorAll("#kt_arsip_form input, #kt_arsip_form select, #kt_arsip_form textarea");
                formFields.forEach(field => {
                    formData.append(field.name, field.value);
                });
            });

            // Event jika upload sukses
            myDropzone.on("success", function () {
                myDropzone.removeAllFiles(true); // reset dropzone
                Swal.fire({
                    text: "Data berhasil disimpan!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "OK",
                    customClass: { confirmButton: "btn btn-primary" }
                }).then(function () {
                    window.location = document.getElementById("kt_arsip_form").getAttribute("data-kt-redirect");
                });
            });

            myDropzone.on("error", function (file, response) {
                Swal.fire({
                    text: response.message || "Terjadi kesalahan saat upload!",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "OK",
                    customClass: { confirmButton: "btn btn-primary" }
                });
            });

            (() => {
                let e;
                const t = document.getElementById("kt_arsip_form"),
                    o = document.getElementById("kt_arsip_form_submit");

                e = FormValidation.formValidation(t, {
                    fields: {
                        judul: {
                            validators: {
                                callback: {
                                    message: "Judul tidak boleh kosong",
                                    callback: function () {
                                        return t.querySelector('[name="judul"]').value.trim() !== "";
                                    }
                                }
                            }
                        },
                        nomor_surat: {
                            validators: {
                                callback: {
                                    message: "Nomor surat tidak boleh kosong",
                                    callback: function () {
                                        return t.querySelector('[name="nomor_surat"]').value.trim() !== "";
                                    }
                                }
                            }
                        },
                        berkas: {
                            validators: {
                                callback: {
                                    message: "Berkas wajib diunggah",
                                    callback: function () {
                                        const isEdit = !!t.querySelector('[name="id_arsip"]').value;
                                        return isEdit || myDropzone.getAcceptedFiles().length > 0;
                                    }
                                }
                            }
                        }
                    },
                });

                o.addEventListener("click", (a) => {
                    a.preventDefault();
                    e.validate().then(function (result) {
                        if (result === "Valid") {
                            if (myDropzone.getQueuedFiles().length > 0) {
                                // Proses upload Dropzone
                                myDropzone.processQueue();
                            } else {
                                Swal.fire({
                                    text: "Silakan unggah file PDF terlebih dahulu!",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "OK",
                                    customClass: { confirmButton: "btn btn-primary" }
                                });
                            }
                        } else {
                            Swal.fire({
                                text: "Ada kesalahan pada input, silakan periksa kembali!",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "OK",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        }
                    });
                });
            })();
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTAddArsipSurat.init();
});
