Untuk menggunakan **role-based permission** seperti yang ditawarkan oleh **Spatie/Permission di Laravel** dalam **CodeIgniter 4**, Anda dapat mengimplementasikan fitur serupa dengan sedikit penyesuaian. Meskipun CodeIgniter 4 tidak memiliki paket bawaan seperti Spatie, Anda bisa membuat solusi yang mirip menggunakan Middleware, Policies, dan tabel database untuk pengelolaan role dan permission.

Berikut adalah langkah-langkahnya:

---

### **1. Struktur Database**
Kita akan membuat 3 tabel utama untuk role dan permission:

#### **Tabel `roles`**
Menyimpan daftar peran (role):
```sql
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT DEFAULT NULL
);
```

#### **Tabel `permissions`**
Menyimpan daftar izin (permission):
```sql
CREATE TABLE permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT DEFAULT NULL
);
```

#### **Tabel Pivot `role_permissions`**
Menghubungkan role dengan permission (many-to-many):
```sql
CREATE TABLE role_permissions (
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
);
```

#### **Tabel Pivot `user_roles`**
Menghubungkan pengguna dengan role:
```sql
CREATE TABLE user_roles (
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    PRIMARY KEY (user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);
```

---

### **2. Model untuk Role dan Permission**

#### **RoleModel**
**File:** `app/Models/RoleModel.php`
```php
<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description'];

    public function getPermissions($roleId)
    {
        return $this->db->table('role_permissions')
            ->join('permissions', 'role_permissions.permission_id = permissions.id')
            ->where('role_permissions.role_id', $roleId)
            ->get()
            ->getResultArray();
    }
}
```

#### **PermissionModel**
**File:** `app/Models/PermissionModel.php`
```php
<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description'];
}
```

---

### **3. Middleware untuk Role-Based Access Control**
Buat filter middleware untuk memeriksa apakah pengguna memiliki izin tertentu.

#### **File:** `app/Filters/RolePermissionFilter.php`
```php
<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RolePermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Cek apakah pengguna memiliki role
        if (!$session->has('role')) {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses.');
        }

        // Ambil permission yang dibutuhkan dari arguments
        $requiredPermission = $arguments[0] ?? null;

        if ($requiredPermission) {
            $roleModel = new \App\Models\RoleModel();
            $roleId = $session->get('role_id'); // Role ID dari session

            $permissions = $roleModel->getPermissions($roleId);
            $permissionsList = array_column($permissions, 'name');

            if (!in_array($requiredPermission, $permissionsList)) {
                return redirect()->to('/forbidden')->with('error', 'Anda tidak memiliki izin.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after
    }
}
```

---

### **4. Register Middleware**
Daftarkan filter ini ke dalam `app/Config/Filters.php`:

#### **File:** `app/Config/Filters.php`
```php
public $aliases = [
    'auth'       => \App\Filters\AuthFilter::class,
    'permission' => \App\Filters\RolePermissionFilter::class,
];
```

---

### **5. Routing dengan Middleware**
Gunakan filter ini pada rute yang membutuhkan izin khusus.

#### **File:** `app/Config/Routes.php`
```php
$routes->group('admin', ['filter' => 'permission:manage_users'], function ($routes) {
    $routes->get('users', 'Admin\Users::index');
    $routes->get('roles', 'Admin\Roles::index');
});
```

---

### **6. Assign Role dan Permission**
Anda perlu membuat fungsi untuk menetapkan role dan permission ke user.

#### Contoh Assign Role ke User:
```php
public function assignRoleToUser($userId, $roleId)
{
    $this->db->table('user_roles')->insert([
        'user_id' => $userId,
        'role_id' => $roleId,
    ]);
}
```

#### Contoh Assign Permission ke Role:
```php
public function assignPermissionToRole($roleId, $permissionId)
{
    $this->db->table('role_permissions')->insert([
        'role_id' => $roleId,
        'permission_id' => $permissionId,
    ]);
}
```

---

### **7. Testing**
- Tambahkan beberapa role (`Admin`, `Editor`, `Viewer`) dan permission (`manage_users`, `edit_content`, `view_content`) ke database.
- Assign permission ke role dan role ke user.
- Uji akses pengguna dengan middleware pada rute yang membutuhkan izin tertentu.

---

### **Hasil Akhir**
Sekarang Anda memiliki sistem role-based permission mirip **Spatie/Permission** di Laravel pada CodeIgniter 4. Sistem ini fleksibel dan dapat disesuaikan sesuai kebutuhan Anda.

Jika Anda memerlukan bantuan lebih lanjut untuk implementasi, saya siap membantu! 😊