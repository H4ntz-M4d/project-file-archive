<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        return view('admin.kategori.list-kategori', [
            'title' => 'Kategori'
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Kategori::get();
            return DataTables::of($data)
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" class="form-check-input" value="'.$row->id_kategori.'">';
                })
                ->addColumn('action', function($row){
                    return '
                        <div class="d-flex justify-content-center gap-2 align-items-center">
                            <a href="/#" data-slug="'.$row->slug.'" data-kt-kategori-table-filter="delete_row" class="btn btn-sm btn-danger">
                                Hapus
                            <a>
                            <a href="/kategori-surat/edit-kategori/'.$row->slug.'" class="btn btn-sm btn-primary">Edit</a>
                        </div>
                    ';
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
    }

    public function create()
    {
        $nextId = Kategori::max('id_kategori') + 1;
        return view('admin.kategori.create-kategori', [
            'title' => 'Tambah Kategori',
            'nextID' => $nextId
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50',
            'keterangan' => 'required|string',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json(['success' => 'Kategori berhasil ditambahkan.']);
    }

    public function edit($slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();
        return view('admin.kategori.edit-kategori',[
            'title' => 'Edit Kategori',
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50',
            'keterangan' => 'required|string',
        ]);

        Kategori::where('id_kategori', $request->id_kategori)->update([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json(['success' => 'Kategori berhasil diupdate.']);
    }

    public function destroy($slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();
        $kategori->delete();

        return response()->json(['success' => 'Kategori berhasil dihapus.']);
    }

    public function destroySelected(Request $request)
    {
        $ids = $request->ids;
        if (!$ids || !is_array($ids)) {
            return response()->json(['success' => false, 'message' => 'ID tidak valid'], 400);
        }

        Kategori::whereIn('slug', $ids)->delete();
        return response()->json(['success' => 'Kategori terpilih berhasil dihapus.']);
    }
}
