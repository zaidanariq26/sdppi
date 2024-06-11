<?php

namespace App\Models;

class Post
{
	// use HasFactory;

	private static $blog_posts = [
		[
			"divisi" => "Data Entry",
			"slug" => "data-entry",
			"body" =>
				"Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum natus pariatur totam ex. Recusandae dolorum tempore, fugit perferendis mollitia earum esse necessitatibus alias debitis beatae deserunt, nulla natus quae, nemo praesentium dignissimos in commodi ducimus accusantium ut temporibus consectetur repellendus soluta! Qui, vitae exercitationem sequi consectetur quia tenetur. Delectus, laboriosam."
		]
	];

	public static function all()
	{
		return self::$blog_posts;
	}

	public static function find($slug)
	{
		$posts = self::$blog_posts;

		$post = [];
		foreach ($posts as $p) {
			if ($p["slug"] === $slug) {
				$post = $p;
			}
		}

		return $post;
	}
}
