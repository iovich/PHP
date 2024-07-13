<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categories>
 */
class CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageUrl = "https://picsum.photos/1200/800?category";
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
            'name' => $this->faker->unique()->word,
            'image' => $imageName,
        ];
    }
}
