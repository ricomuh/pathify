<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // with icons (optional), colors, and children
        $courseCategories = collect([
            'Backend Development' => [
                'icon' => 'fas fa-server',
                'color' => '#FF5733',
                'children' => [
                    'PHP' => [
                        'icon' => 'fab fa-php',
                        'color' => '#8993be',
                        'children' => [
                            'Laravel' => [
                                'icon' => 'fab fa-laravel',
                                'color' => '#ff2d20',
                            ],
                            'Symfony' => [
                                'icon' => 'fab fa-symfony',
                                'color' => '#000000',
                            ],
                        ],
                    ],
                    'Node.js' => [
                        'icon' => 'fab fa-node-js',
                        'color' => '#68a063',
                        'children' => [
                            'Express.js' => [
                                'icon' => 'fas fa-ellipsis-h',
                                'color' => '#000000',
                            ],
                            'Koa.js' => [
                                'icon' => 'fas fa-ellipsis-h',
                                'color' => '#333333',
                            ],
                        ],
                    ],
                    'Python' => [
                        'icon' => 'fab fa-python',
                        'color' => '#306998',
                        'children' => [
                            'Django' => [
                                'icon' => 'fas fa-ellipsis-h',
                                'color' => '#092e20',
                            ],
                            'Flask' => [
                                'icon' => 'fas fa-ellipsis-h',
                                'color' => '#000000',
                            ],
                        ],
                    ],
                    'Ruby' => [
                        'icon' => 'fas fa-gem',
                        'color' => '#701516',
                    ],
                ],
            ],
            'Frontend Development' => [
                'icon' => 'fas fa-desktop',
                'color' => '#61dafb',
                'children' => [
                    'HTML' => [
                        'icon' => 'fab fa-html5',
                        'color' => '#e34c26',
                    ],
                    'CSS' => [
                        'icon' => 'fab fa-css3-alt',
                        'color' => '#264de4',
                    ],
                    'JavaScript' => [
                        'icon' => 'fab fa-js',
                        'color' => '#f7df1e',
                        'children' => [
                            'React' => [
                                'icon' => 'fab fa-react',
                                'color' => '#61dafb',
                            ],
                            'Vue' => [
                                'icon' => 'fab fa-vuejs',
                                'color' => '#42b883',
                            ],
                            'Angular' => [
                                'icon' => 'fab fa-angular',
                                'color' => '#dd1b16',
                            ],
                        ],
                    ],
                    'SASS' => [
                        'icon' => 'fab fa-sass',
                        'color' => '#cc6699',
                    ],
                    'Bootstrap' => [
                        'icon' => 'fab fa-bootstrap',
                        'color' => '#563d7c',
                    ],
                    'Tailwind CSS' => [
                        'icon' => 'fas fa-wind',
                        'color' => '#38b2ac',
                    ],
                ],
            ],
            'Mobile Development' => [
                'icon' => 'fas fa-mobile-alt',
                'color' => '#ff6f61',
                'children' => [
                    'Android' => [
                        'icon' => 'fab fa-android',
                        'color' => '#3ddc84',
                        'children' => [
                            'Java' => [
                                'icon' => 'fab fa-java',
                                'color' => '#007396',
                            ],
                            'Kotlin' => [
                                'icon' => 'fab fa-kotlin',
                                'color' => '#7f52ff',
                            ],
                        ],
                    ],
                    'iOS' => [
                        'icon' => 'fab fa-apple',
                        'color' => '#000000',
                        'children' => [
                            'Swift' => [
                                'icon' => 'fab fa-swift',
                                'color' => '#f05138',
                            ],
                            'Objective-C' => [
                                'icon' => 'fas fa-ellipsis-h',
                                'color' => '#438eff',
                            ],
                        ],
                    ],
                    'React Native' => [
                        'icon' => 'fab fa-react',
                        'color' => '#61dafb',
                    ],
                    'Flutter' => [
                        'icon' => 'fab fa-flutter',
                        'color' => '#02569b',
                    ],
                ],
            ],
            'DevOps' => [
                'icon' => 'fas fa-cogs',
                'color' => '#f05032',
                'children' => [
                    'Docker' => [
                        'icon' => 'fab fa-docker',
                        'color' => '#2496ed',
                    ],
                    'Kubernetes' => [
                        'icon' => 'fab fa-kubernetes',
                        'color' => '#326ce5',
                    ],
                    'Jenkins' => [
                        'icon' => 'fab fa-jenkins',
                        'color' => '#d24939',
                    ],
                ],
            ],
            'Data Science' => [
                'icon' => 'fas fa-chart-line',
                'color' => '#4caf50',
                'children' => [
                    'NumPy' => [
                        'icon' => 'fas fa-ellipsis-h',
                        'color' => '#013243',
                    ],
                    'Pandas' => [
                        'icon' => 'fas fa-ellipsis-h',
                        'color' => '#150458',
                    ],
                    'Matplotlib' => [
                        'icon' => 'fas fa-ellipsis-h',
                        'color' => '#11557c',
                    ],
                    'R' => [
                        'icon' => 'fas fa-project-diagram',
                        'color' => '#276dc3',
                    ],
                    'SQL' => [
                        'icon' => 'fas fa-database',
                        'color' => '#f29111',
                    ],
                    'Tableau' => [
                        'icon' => 'fas fa-table',
                        'color' => '#e97627',
                    ],
                ],
            ],
            'Cybersecurity' => [
                'icon' => 'fas fa-shield-alt',
                'color' => '#5a5a5a',
                'children' => [
                    'Ethical Hacking' => [
                        'icon' => 'fas fa-user-secret',
                        'color' => '#000000',
                    ],
                    'CISSP' => [
                        'icon' => 'fas fa-user-lock',
                        'color' => '#2c3e50',
                    ],
                    'CompTIA Security+' => [
                        'icon' => 'fas fa-user-shield',
                        'color' => '#e01f3d',
                    ],
                ],
            ],
            'UI/UX Design' => [
                'icon' => 'fas fa-paint-brush',
                'color' => '#ff6347',
                'children' => [
                    'Figma' => [
                        'icon' => 'fas fa-vector-square',
                        'color' => '#a259ff',
                    ],
                    'Sketch' => [
                        'icon' => 'fas fa-pencil-ruler',
                        'color' => '#f7b500',
                    ],
                    'Adobe XD' => [
                        'icon' => 'fas fa-vector-square',
                        'color' => '#ff61f6',
                    ],
                ],
            ],
        ]);

        $courseCategories->each(function ($children, $name) {
            $category = \App\Models\Category::create([
                'name' => $name,
                'icon_image' => $children['icon'] ?? null,
                'color' => $children['color'] ?? null,
            ]);

            if (isset($children['children'])) {
                collect($children['children'])->each(function ($children, $name) use ($category) {
                    $childCategory = \App\Models\Category::create([
                        'name' => $name,
                        'icon_image' => $children['icon'] ?? null,
                        'color' => $children['color'] ?? null,
                        'parent_id' => $category->id,
                    ]);

                    if (isset($children['children'])) {
                        collect($children['children'])->each(function ($children, $name) use ($childCategory) {
                            \App\Models\Category::create([
                                'name' => $name,
                                'icon_image' => $children['icon'] ?? null,
                                'color' => $children['color'] ?? null,
                                'parent_id' => $childCategory->id,
                            ]);
                        });
                    }
                });
            }
        });
    }
}
