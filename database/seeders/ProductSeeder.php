<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Dòng này cực kỳ quan trọng để sửa lỗi Undefined type

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
        ['name' => 'Burger Bò Phô Mai', 'price' => 65000, 'category' => 'Burger', 'image' => 'images/products/burger.jpg'],
        ['name' => 'Pizza Hải Sản', 'price' => 120000, 'category' => 'Pizza', 'image' => 'images/products/pizza-hai-san.jpg'],
        ['name' => 'Gà Rán 6 Miếng', 'price' => 85000, 'category' => 'Gà Rán', 'image' => 'images/products/6-mieng-ga.jpg'],
        ['name' => 'Khoai Tây Chiên', 'price' => 35000, 'category' => 'Món Phụ', 'image' => 'images/products/khoai-tay-chien.jpg'],
        ['name' => 'Hot Dog Xúc Xích', 'price' => 45000, 'category' => 'Hot Dog', 'image' => 'images/products/hot-dog-xuc-xich.jpg'],
        ['name' => 'Coca Cola', 'price' => 20000, 'category' => 'Đồ Uống', 'image' => 'images/products/cocacola.jpg'],
        ['name' => 'Gà Popcorn', 'price' => 55000, 'category' => 'Gà Rán', 'image' => 'images/products/ga-popcorn.jpg'],
        ['name' => 'Burger Gà Giòn', 'price' => 60000, 'category' => 'Burger', 'image' => 'images/products/burger-ga.jpg'],
        ['name' => 'Pizza Xúc Xích', 'price' => 115000, 'category' => 'Pizza', 'image' => 'images/products/pizza-xuc-xich.jpg'],
        ['name' => 'Sprite', 'price' => 20000, 'category' => 'Đồ Uống', 'image' => 'images/products/sprite.jpg'],
        ['name' => 'Nuggets 9 Miếng', 'price' => 70000, 'category' => 'Gà Rán', 'image' => 'images/products/nuggets.jpg'],
        ['name' => 'Salad Rau Củ', 'price' => 40000, 'category' => 'Món Phụ', 'image' => 'images/products/salad.jpg'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}