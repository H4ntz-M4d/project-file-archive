"use strict";
var KTAddKategori = (function () {
    return {
        init: function () {
            (() => {
                let e;
                const t = document.getElementById(
                        "kt_arsip_form"
                    ),
                    o = document.getElementById(
                        "kt_arsip_form_submit"
                    );
                (e = FormValidation.formValidation(t, {
                    fields: {
                        id_kategori: {
                            validators: {
                                callback: {
                                    message: "ID tidak boleh kosong",
                                }
                            }
                        },
                        nama_kategori: {
                            validators: {
                                callback: {
                                    message: "Nama Kategori tidak boleh kosong",
                                }
                            }
                        },
                        keterangan: {
                            validators: {
                                callback: {
                                    message: "Keterangan tidak boleh kosong",
                                }
                            }
                        },
                    },
                })),
                    o.addEventListener("click", (a) => {
                        a.preventDefault(),
                            e &&
                                e.validate().then(function (e) {
                                    console.log("validated!");
                                    console.log("Form validation result:", e);
                                    if (e === "Valid") {
                                        o.setAttribute(
                                            "data-kt-indicator",
                                            "on"
                                        );
                                        o.disabled = true;

                                        let formData = new FormData(t);

                                        fetch(
                                            t.getAttribute(
                                                "data-store-url"
                                            ),
                                            {
                                                method: "POST",
                                                body: formData,
                                                headers: {
                                                    "X-CSRF-TOKEN":
                                                        document.querySelector(
                                                            'meta[name="csrf-token"]'
                                                        ).content,
                                                    Accept: "application/json",
                                                },
                                            }
                                        )
                                        .then(async response => {
                                            if (!response.ok) {
                                                const errorData = await response.json();
                                                throw { status: response.status, errors: errorData.errors };
                                            }

                                            return response.json();
                                        })
                                        .then((data) => {
                                            o.removeAttribute(
                                                "data-kt-indicator"
                                            );
                                            o.disabled = false;

                                            if (data.success) {
                                                Swal.fire({
                                                    text: "Data berhasil disimpan!",
                                                    icon: "success",
                                                    buttonsStyling: false,
                                                    confirmButtonText:
                                                        "OK",
                                                    customClass: {
                                                        confirmButton:
                                                            "btn btn-primary",
                                                    },
                                                }).then(function () {
                                                    window.location =
                                                        t.getAttribute(
                                                            "data-kt-redirect"
                                                        );
                                                });
                                            } else {
                                                Swal.fire({
                                                    text: "Terjadi kesalahan saat menyimpan data!",
                                                    icon: "error",
                                                    buttonsStyling: false,
                                                    confirmButtonText:
                                                        "Coba lagi",
                                                    customClass: {
                                                        confirmButton:
                                                            "btn btn-primary",
                                                    },
                                                });
                                            }
                                        })
                                        .catch((error) => {
                                            console.log(error);
                                            o.removeAttribute(
                                                "data-kt-indicator"
                                            );
                                            o.disabled = false;
                                            if (error.status === 422) {
                                                let errorMessages = Object.values(error.errors).flat().join('<br>');
                                                Swal.fire({
                                                    html: errorMessages,
                                                    icon: "error",
                                                    buttonsStyling: false,
                                                    confirmButtonText: "OK",
                                                    customClass: { confirmButton: "btn btn-primary" }
                                                });
                                            } else {
                                                Swal.fire({
                                                    text: "Terjadi kesalahan! Periksa kembali inputan Anda.",
                                                    icon: "error",
                                                    buttonsStyling: false,
                                                    confirmButtonText: "OK",
                                                    customClass: { confirmButton: "btn btn-primary" }
                                                });
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            text: "Ada kesalahan pada input, silakan periksa kembali!",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "OK",
                                            customClass: {
                                                confirmButton:
                                                    "btn btn-primary",
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
    KTAddKategori.init();
});
