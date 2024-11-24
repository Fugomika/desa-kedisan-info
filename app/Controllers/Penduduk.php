<?php

namespace App\Controllers;

use App\Models\PendudukModel;

class Penduduk extends BaseController
{
    protected $pendudukModel;

    public function __construct()
    {
        $this->pendudukModel = new PendudukModel();
    }

    // Display all penduduk
    public function index()
    {
        $data['penduduk'] = $this->pendudukModel->findAll();
        return view('penduduk/index', $data);
    }

    // Show the form to create a new penduduk
    public function create()
    {
        return view('penduduk/form');
    }

    // Store a new penduduk
    public function store()
    {
        // Validate the input
        $rules = [
            'nama' => 'required|alpha_space|max_length[100]',
            'alamat' => 'required|string|max_length[255]',
            'umur' => 'required|integer|max_length[3]',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin]',
        ];

        $messages = [
            'nama' => [
                'required' => 'Nama wajib diisi.',
                'alpha_space' => 'Nama hanya boleh berisi huruf dan spasi.',
                'max_length' => 'Nama maksimal 100 karakter.',
            ],
            'alamat' => [
                'required' => 'Alamat wajib diisi.',
                'string' => 'Alamat hanya boleh berisi huruf dan angka.',
                'max_length' => 'Alamat maksimal 255 karakter.',
            ],
            'umur' => [
                'required' => 'Umur wajib diisi.',
                'integer' => 'Umur hanya boleh berisi angka.',
                'max_length' => 'Umur maksimal 3 karakter.',
            ],
            'jenis_kelamin' => [
                'required' => 'Jenis kelamin wajib diisi.',
                'in_list' => 'Jenis kelamin hanya boleh berisi Laki-laki atau Perempuan.',
            ],
            'status_pernikahan' => [
                'required' => 'Status pernikahan wajib diisi.',
                'in_list' => 'Status pernikahan hanya boleh berisi Kawin atau Belum Kawin.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the penduduk
        $this->pendudukModel->save([
            'nama' => esc($this->request->getPost('nama')),
            'alamat' => esc($this->request->getPost('alamat')),
            'umur' => esc($this->request->getPost('umur')),
            'jenis_kelamin' => esc($this->request->getPost('jenis_kelamin')),
            'status_pernikahan' => esc($this->request->getPost('status_pernikahan')),
            'created_by' => session()->get('id'),
        ]);

        return redirect()->to('/penduduk')->with('message', 'Data penduduk berhasil ditambahkan.');
    }

    // Show the form to edit an existing penduduk
    public function edit($id)
    {
        $data['penduduk'] = $this->pendudukModel->find($id);
        return view('penduduk/form', $data);
    }

    // Update an existing penduduk
    public function update($id)
    {
        // Validate the input
        $rules = [
            'nama' => 'required|alpha_space|max_length[100]',
            'alamat' => 'required|string|max_length[255]',
            'umur' => 'required|integer|max_length[3]',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin]',
        ];

        $messages = [
            'nama' => [
                'required' => 'Nama wajib diisi.',
                'alpha_space' => 'Nama hanya boleh berisi huruf dan spasi.',
                'max_length' => 'Nama maksimal 100 karakter.',
            ],
            'alamat' => [
                'required' => 'Alamat wajib diisi.',
                'string' => 'Alamat hanya boleh berisi huruf dan angka.',
                'max_length' => 'Alamat maksimal 255 karakter.',
            ],
            'umur' => [
                'required' => 'Umur wajib diisi.',
                'integer' => 'Umur hanya boleh berisi angka.',
                'max_length' => 'Umur maksimal 3 karakter.',
            ],
            'jenis_kelamin' => [
                'required' => 'Jenis kelamin wajib diisi.',
                'in_list' => 'Jenis kelamin hanya boleh berisi Laki-laki atau Perempuan.',
            ],
            'status_pernikahan' => [
                'required' => 'Status pernikahan wajib diisi.',
                'in_list' => 'Status pernikahan hanya boleh berisi Kawin atau Belum Kawin.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update the penduduk
        $this->pendudukModel->update($id, [
            'nama' => esc($this->request->getPost('nama')),
            'alamat' => esc($this->request->getPost('alamat')),
            'umur' => esc($this->request->getPost('umur')),
            'jenis_kelamin' => esc($this->request->getPost('jenis_kelamin')),
            'status_pernikahan' => esc($this->request->getPost('status_pernikahan')),
        ]);

        return redirect()->to('/penduduk')->with('message', 'Data penduduk berhasil diperbarui.');
    }

    // Delete an existing penduduk
    public function delete($id)
    {
        $this->pendudukModel->delete($id);
        return redirect()->to('/penduduk')->with('message', 'Data penduduk berhasil dihapus.');
    }
}
