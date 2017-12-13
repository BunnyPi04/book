<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('stores')->insert([
            ['store_name' => 'Minh Minh Nguyễn Văn Cừ',
              'address' => '123 Nguyễn Văn Cừ',
              'phone' => '123456'
            ],
            ['store_name' => 'Minh Minh Giảng Võ',
              'address' => '6-D6 Giảng Võ',
              'phone' => '123445566'
            ],
            ['store_name' => 'Minh Minh Hoàng Đạo Thúy',
              'address' => '17T2 Hoàng Đạo Thúy, Nhân Chính',
              'phone' => '123456'
            ]        
        ]);
        DB::table('publishers')->insert([
            ['publisher_name' => 'NXB Kim Đồng'
            ],
            ['publisher_name' => 'NXB IPM'
            ],
            ['publisher_name' => 'NXB Nhã Nam'
            ],
            ['publisher_name' => 'NXB Văn Hóa'
            ],
            ['publisher_name' => 'NXB Văn Học'
            ],
            ['publisher_name' => 'NXB Lao Động'
            ],
            ['publisher_name' => 'NXB Thế Giới'
            ],
            ['publisher_name' => 'NXB Thái Hà'
            ],
            ['publisher_name' => 'NXB Lao Động Xã Hội'
            ],
            ['publisher_name' => 'NXB Văn Hóa Thông Tin'
            ],
            ['publisher_name' => 'NXB Dân Trí'
            ],
            ['publisher_name' => 'NXB Trẻ'
            ]
        ]);
        DB::table('categories')->insert([
            ['category_name' => 'Truyện tranh'
            ],
            ['category_name' => 'Tiểu thuyết'
            ],
            ['category_name' => 'Sách nấu ăn/pha chế'
            ],
            ['category_name' => 'Sách thiếu nhi'
            ],
            ['category_name' => 'Sách giáo khoa'
            ],
            ['category_name' => 'Sách minh họa'
            ],
            ['category_name' => 'Sách kinh tế'
            ],
            ['category_name' => 'Sách học ngoại ngữ'
            ],
            ['category_name' => 'Sách kỹ năng sống'
            ],
            ['category_name' => 'Sách kỹ năng làm việc'
            ],
            ['category_name' => 'Sách văn học'
            ]
        ]);
        DB::table('books')->insert([
            ['sku' => 'TT000001',
             'book_name' => 'Another tập 1',
             'author' => 'Yukito Ayatsuji',
             'price' => '80000',
             'description' => 'aaaaaa'],
            ['sku' => 'TT000002',
             'book_name' => 'Another tập 2',
             'author' => 'Yukito Ayatsuji',
             'price' => '80000',
             'description' => 'aaaaaa'],
            ['sku' => 'TT000003',
             'book_name' => 'Tokyo hoàng đạo án',
             'author' => 'Shoji Shimada',
             'price' => '90000',
             'description' => 'aaaaaa'],
        ]);
    }
}
