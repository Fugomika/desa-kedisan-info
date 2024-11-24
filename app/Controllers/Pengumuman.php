<?php

namespace App\Controllers;

use App\Models\PengumumanModel;

class Pengumuman extends BaseController
{
    protected $pengumumanModel;

    public function __construct()
    {
        $this->pengumumanModel = new PengumumanModel();
    }

    // Show all pengumuman
    public function index()
    {
        $data['pengumuman'] = $this->pengumumanModel->findAllDescending();
        return view('pengumuman/index', $data);
    }

    // Show the form to create a new pengumuman
    public function create()
    {
        return view('pengumuman/form');
    }

    // Store a new pengumuman
    public function store()
    {
        // Validate the input
        $rules = [
            'judul' => 'required',
            'isi' => 'required',
            'image' => 'permit_empty|uploaded[image]|is_image[image]|max_size[image,2048]',
        ];

        $messages = [
            'judul' => [
                'required' => 'Judul wajib diisi.',
            ],
            'isi' => [
                'required' => 'Isi wajib diisi.',
            ],
            'image' => [
                'uploaded' => 'Gambar wajib diunggah.',
                'is_image' => 'Gambar harus berupa file gambar.',
                'max_size' => 'Ukuran gambar maksimal 2MB.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare the data
        if ($this->request->getFile('image') != "") {
            $image = $this->request->getFile('image');
            $imageName = $image->getName();
            $image->move('uploads/', $imageName);
            $create['image'] = $imageName;
        }

        $create['judul'] = $this->request->getPost('judul');
        $create['isi'] = $this->request->getPost('isi');
        $create['created_by'] = session()->get('id');

        // Save the pengumuman
        $this->pengumumanModel->save($create);

        return redirect()->to('/pengumuman')->with('message', 'Pengumuman baru berhasil ditambahkan.');
    }

    // Show the form to edit an existing pengumuman
    public function edit($id)
    {
        $data['pengumuman'] = $this->pengumumanModel->find($id);
        return view('pengumuman/form', $data);
    }

    // Update an existing pengumuman
    public function update($id)
    {
        // Validate the input
        $rules = [
            'judul' => 'required',
            'isi' => 'required',
            'image' => 'permit_empty|uploaded[image]|is_image[image]|max_size[image,2048]',
        ];

        $messages = [
            'judul' => [
                'required' => 'Judul wajib diisi.',
            ],
            'isi' => [
                'required' => 'Isi wajib diisi.',
            ],
            'image' => [
                'uploaded' => 'Gambar wajib diunggah.',
                'is_image' => 'Gambar harus berupa file gambar.',
                'max_size' => 'Ukuran gambar maksimal 2MB.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($this->request->getFile('image') != "") {
            $image = $this->request->getFile('image');
            $imageName = $image->getName();
            $image->move('uploads/', $imageName);
            $update['image'] = $imageName;
        }

        $update['judul'] = $this->request->getPost('judul');
        $update['isi'] = $this->request->getPost('isi');

        // Update the pengumuman
        $this->pengumumanModel->update($id, $update);

        return redirect()->to('/pengumuman')->with('message', 'Pengumuman berhasil diperbarui.');
    }

    // Delete an existing pengumuman
    public function delete($id)
    {
        $this->pengumumanModel->delete($id);
        return redirect()->to('/pengumuman')->with('message', 'Pengumuman berhasil dihapus.');
    }
}
