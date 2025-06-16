<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Products extends Controller
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $products = $this->productModel->findAll();
        $categories = $this->categoryModel->findAll();
        
        $data = [
            'title' => 'Product Management',
            'page' => 'products',
            'products' => $products,
            'categories' => $categories
        ];
        
        return view('admin/products/index', $data);
    }

    public function create()
    {
        $categories = $this->categoryModel->findAll();
        
        $data = [
            'title' => 'Add New Product',
            'page' => 'products',
            'categories' => $categories
        ];
        
        return view('admin/products/create', $data);
    }

    public function store()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'category_id' => $this->request->getPost('category_id'),
            'image' => '' // Will be handled by file upload
        ];

        if ($this->request->hasFile('image')) {
            $file = $this->request->getFile('image');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(WRITEPATH . 'uploads/products/', $newName);
                $data['image'] = 'uploads/products/' . $newName;
            }
        }

        $this->productModel->insert($data);
        
        return redirect()->to('/admin/products')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        $categories = $this->categoryModel->findAll();
        
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }
        
        $data = [
            'title' => 'Edit Product',
            'page' => 'products',
            'product' => $product,
            'categories' => $categories
        ];
        
        return view('admin/products/edit', $data);
    }

    public function update($id)
    {
        $product = $this->productModel->find($id);
        
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'category_id' => $this->request->getPost('category_id')
        ];

        if ($this->request->hasFile('image')) {
            $file = $this->request->getFile('image');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(WRITEPATH . 'uploads/products/', $newName);
                $data['image'] = 'uploads/products/' . $newName;
            }
        }

        $this->productModel->update($id, $data);
        
        return redirect()->to('/admin/products')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $product = $this->productModel->find($id);
        
        if ($product && $product['image']) {
            if (file_exists(WRITEPATH . $product['image'])) {
                unlink(WRITEPATH . $product['image']);
            }
        }

        $this->productModel->delete($id);
        
        return redirect()->to('/admin/products')->with('success', 'Product deleted successfully');
    }
}
