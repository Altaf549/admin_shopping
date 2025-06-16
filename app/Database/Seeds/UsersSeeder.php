<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        
        // Check if admin user already exists
        $adminUser = $userModel->where('username', 'admin')->first();
        
        if (!$adminUser) {
            $data = [
                'username' => 'admin',
                'email' => 'admin@example.com',
                // Password: admin123 (MD5 hashed)
                'password_hash' => md5('admin123'),
                'is_admin' => 1,
                'created_at' => new Time('now'),
                'updated_at' => new Time('now')
            ];
            
            $userModel->insert($data);
            echo "Admin user created successfully!\n";
        } else {
            echo "Admin user already exists.\n";
        }
    }
}
