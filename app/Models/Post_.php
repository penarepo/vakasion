<?php

namespace App\Models;

class Post 
{
    static $blog_posts = [
        [   
            "title" => "Judul Postingan Pertama",
            "slug" => "judul-postingan-pertama",
            "author" => "Pembuat Postingan",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, in ipsam magni repellendus laudantium doloremque atque eius voluptates at sit, id et itaque modi? Voluptas, vel fugit. Quibusdam optio ipsam suscipit eaque quasi, autem officia pariatur dolorum placeat, quaerat est, deleniti maxime quae aliquid obcaecati dolorem provident rerum a voluptatibus nemo facere? Quo officia culpa repudiandae debitis perspiciatis dolores voluptates perferendis suscipit possimus, vero mollitia. Atque consectetur natus ipsum vitae quae tempora, magnam adipisci ea quam sequi necessitatibus molestiae iste!"
            
        ],
        [   
            "title" => "Judul Postingan Kedua",
            "slug" => "judul-postingan-kedua",
            "author" => "Pembuat Postingan",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, in ipsam magni repellendus laudantium doloremque atque eius voluptates at sit, id et itaque modi? Voluptas, vel fugit. Quibusdam optio ipsam suscipit eaque quasi, autem officia pariatur dolorum placeat, quaerat est, deleniti maxime quae aliquid obcaecati dolorem provident rerum a voluptatibus nemo facere? Quo officia culpa repudiandae debitis perspiciatis dolores voluptates perferendis suscipit possimus, vero mollitia. Atque consectetur natus ipsum vitae quae tempora, magnam adipisci ea quam sequi necessitatibus molestiae iste!"
            
        ]
    ];

    public static function all()
    {
        // return self::$blog_posts;

        // menggunakan collection 
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {

        $posts = static::all();
        // method native
        // $post = [];
        // foreach ($posts as $p) {
        //     if($p['slug'] === $slug){
        //         $post = $p;
        //     }
        // }

        return $posts->firstWhere('slug',$slug);
    }
}
