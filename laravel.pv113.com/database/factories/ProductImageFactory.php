<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imageUrl = "https://picsum.photos/1200/800?product"; // змініть "product" на щось унікальне, якщо потрібно
        $imageContent = file_get_contents($imageUrl);

        $folderName =  public_path('upload');
        if (!file_exists($folderName)) {
            mkdir($folderName, 0777); // Створити папку з правами доступу 0777
        }

        $imageName = uniqid().".webp";
        $sizes = [50, 150, 300, 600, 1200];
        $manager = new ImageManager(new Driver());
        foreach($sizes as $size) {
            $fileSave = $size ."_".$imageName;
            $imageRead = $manager->read($imageContent);
            $imageRead->scale(width: $size);
            $path = public_path('upload/'.$fileSave);
            $imageRead->toWebp()->save($path);
        }

        return [
            'name' => $imageName,
            'priority' => $this->faker->randomDigit,
            'product_id' => Product::inRandomOrder()->first()->id, // Використовуйте існуючі продукти
        ];
    }
}
