<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArsipSuratController extends Controller
{
    public function index()
    {
        return view('admin.arsip-berkas.arsip-surat', [
            'title' => 'Arsip Surat'
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $query = ArsipSurat::with('kategoris:id_kategori,nama_kategori')
                ->select('arsip_surats.*');

            $data = $query->get()->map(function($item) {
                $item->nama_kategori = $item->kategoris->nama_kategori;
                return $item;
            });
            return DataTables::collection($data)
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" class="form-check-input" value="'.$row->slug.'">';
                })
                ->addColumn('action', function($row){
                    return '
                        <div class="d-flex justify-content-center gap-2 align-items-center">
                            <a href="/#" data-slug="'.$row->slug.'" data-kt-arsip-table-filter="delete_row" class="btn btn-sm btn-danger">
                                Hapus
                            <a>
                            <a href="/arsip-surat/download/'.$row->slug.'" class="btn btn-sm btn-info">Unduh</a>
                            <a href="/arsip-surat/lihat-surat/'.$row->slug.'" class="btn btn-sm btn-primary">Lihat</a>
                        </div>
                    ';
                })
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
    }

    public function create()
    {
        $kategori = Kategori::select('id_kategori', 'nama_kategori')->get();
        return view('admin.arsip-berkas.create-surat', [
            'title' => 'Tambah Arsip >> Unggah',
            'kategori' => $kategori
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:arsip_surats,nomor_surat',
            'id_kategori' => 'required',
            'judul' => 'required',
            'waktu_pengarsipan' => 'required',
            'berkas' => 'required|mimes:pdf|max:2048', // Maksimal 2MB
        ]);

        $file = $request->file('berkas')->store('arsip_surat', 'public');

        ArsipSurat::create([
            'nomor_surat' => $request->nomor_surat,
            'id_kategori' => $request->id_kategori,
            'judul' => $request->judul,
            'waktu_pengarsipan' => $request->waktu_pengarsipan,
            'berkas' => $file,
        ]);
    }

    public function view($slug) {
        $arsip = ArsipSurat::with('kategoris:id_kategori,nama_kategori')
            ->select('id_arsip_surat','nomor_surat', 'id_kategori', 'judul', 'waktu_pengarsipan', 'berkas', 'slug')
            ->where('slug', $slug)->firstOrFail();

        return view('admin.arsip-berkas.view-surat',[
            'title' => 'Arsip Surat >> Lihat',
            'arsip' => $arsip,
        ]);
    }

    public function edit($slug)
    {
        $kategori = Kategori::select('id_kategori', 'nama_kategori')->get();
        $arsip = ArsipSurat::where('slug', $slug)->firstOrFail();

        return view('admin.arsip-berkas.edit-surat',[
            'title' => 'Arsip Surat >> Edit',
            'kategori' => $kategori,
            'arsip' => $arsip,
        ]);
    }

    public function update(Request $request)
    {
        $arsip = ArsipSurat::where('slug', $request->slug)->firstOrFail();
        
        $request->validate([
            'nomor_surat' => 'required|unique:arsip_surats,nomor_surat,'.$arsip->id_arsip_surat.',id_arsip_surat',
            'id_kategori' => 'required',
            'judul' => 'required',
            'waktu_pengarsipan' => 'required',
            'berkas' => 'required|mimes:pdf|max:2048', // Maksimal 2MB
        ]);

        $berkas = $request->berkas;

        if ($request->hasFile('berkas')) {
            if (Storage::disk('public')->exists($arsip->berkas)) {
                Storage::disk('public')->delete($arsip->berkas);
            }

            $berkas = $request->file('berkas')->store('arsip_surat', 'public');
        }

        $arsip->update([
            'nomor_surat' => $request->nomor_surat,
            'id_kategori' => $request->id_kategori,
            'judul' => $request->judul,
            'waktu_pengarsipan' => $request->waktu_pengarsipan,
            'berkas' => $berkas,
        ]);
    }

    public function destroy($slug)
    {
        $arsip = ArsipSurat::where('slug', $slug)->firstOrFail();
        if (Storage::disk('public')->exists($arsip->berkas)) {
            Storage::disk('public')->delete($arsip->berkas);
        }
        $arsip->delete();


        return response()->json(['success' => 'Arsip berhasil dihapus.']);
    }

    public function destroySelected(Request $request)
    {
        $ids = $request->ids;
        if (!$ids || !is_array($ids)) {
            return response()->json(['success' => false, 'message' => 'ID tidak valid'], 400);
        }

        $arsip = ArsipSurat::whereIn('slug', $ids);
        foreach ($arsip->get() as $item) {
            if (Storage::disk('public')->exists($item->berkas)) {
                Storage::disk('public')->delete($item->berkas);
            }
        }        
        $arsip->delete();
        return response()->json(['success' => 'Arsip terpilih berhasil dihapus.']);
    }

    public function download($slug)
    {
        $surat = ArsipSurat::where('slug',$slug)->firstOrFail();

        if (!Storage::disk('public')->exists($surat->berkas)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download($surat->berkas, $surat->judul.'.pdf');
    }

}
