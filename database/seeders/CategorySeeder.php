<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Seeds the 15 core B2B marketplace categories with a short
     * description and an icon file. Icons live in
     * public/uploads/categories/{icon} to match Category::getIconUrlAttribute().
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Raw Materials',
                'icon' => 'raw-materials.png',
                'description' => 'Metals, polymers, chemicals, and other base inputs sourced directly from producers and refiners.',
            ],
            [
                'name' => 'Industrial Machinery',
                'icon' => 'industrial-machinery.png',
                'description' => 'Manufacturing, processing, and production equipment for factories and industrial plants.',
            ],
            [
                'name' => 'Electrical & Electronics',
                'icon' => 'electrical-electronics.png',
                'description' => 'Components, wiring, control systems, and electronic assemblies for commercial and industrial use.',
            ],
            [
                'name' => 'Construction Materials',
                'icon' => 'construction-materials.png',
                'description' => 'Cement, steel, tiles, fittings, and building supplies for contractors and developers.',
            ],
            [
                'name' => 'Packaging & Printing',
                'icon' => 'packaging-printing.png',
                'description' => 'Boxes, labels, printing services, and packaging solutions for retail and shipping.',
            ],
            [
                'name' => 'Textiles & Apparel',
                'icon' => 'textiles-apparel.png',
                'description' => 'Fabrics, yarns, garments, and textile machinery for wholesale and manufacturing buyers.',
            ],
            [
                'name' => 'Chemicals',
                'icon' => 'chemicals.png',
                'description' => 'Industrial, specialty, and agricultural chemicals for manufacturing and processing needs.',
            ],
            [
                'name' => 'Automotive',
                'icon' => 'automotive.png',
                'description' => 'Vehicle parts, accessories, tires, and components for OEMs and aftermarket suppliers.',
            ],
            [
                'name' => 'Furniture & Office Supplies',
                'icon' => 'furniture-office.png',
                'description' => 'Commercial furniture, fixtures, and workplace equipment for businesses.',
            ],
            [
                'name' => 'Safety & Security',
                'icon' => 'safety-security.png',
                'description' => 'PPE, surveillance systems, fire safety equipment, and industrial security solutions.',
            ],
            [
                'name' => 'Agriculture',
                'icon' => 'agriculture.png',
                'description' => 'Farm equipment, seeds, fertilizers, and agri-processing machinery for bulk buyers.',
            ],
            [
                'name' => 'Food & Beverage',
                'icon' => 'food-beverage.png',
                'description' => 'Ingredients, processing equipment, and packaged goods for food businesses and distributors.',
            ],
            [
                'name' => 'Medical & Healthcare',
                'icon' => 'medical-healthcare.png',
                'description' => 'Medical devices, consumables, and healthcare equipment for institutional buyers.',
            ],
            [
                'name' => 'Energy & Utilities',
                'icon' => 'energy-utilities.png',
                'description' => 'Solar, power generation equipment, and utility infrastructure components.',
            ],
            [
                'name' => 'IT & Telecom',
                'icon' => 'it-telecom.png',
                'description' => 'Networking hardware, telecom equipment, and enterprise IT infrastructure supplies.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'icon' => $category['icon'],
                    'description' => $category['description'],
                    'status' => true,
                ]
            );
        }
    }
}
