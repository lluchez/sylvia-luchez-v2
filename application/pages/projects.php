<?php

// NOTE: thumbnail will be resized with a max-height of 250px


function project_path($project)
{
	return DIR_IMG."projects/".$project["id"]."/";
}

function get_src_from_image($image)
{
	if( is_string($image) )
		return $image;
	if( is_array($image) )
		return $image["src"];
	return null;
}

function find_image_index($images, $image_src)
{
	//return array_key_exists($image, $images) )
	foreach($images as $key => $image)
	{
		if( get_src_from_image($image) === $image_src )
			return $key;
	}
	return FALSE;
}

function generate_data()
{
	$projects = Array
	(
		/*"identity_spheres" => Array
		(
			"name" => "Identity Spheres",
			"period" => Array(2016),
			"images" => Array
			(
				"polish_american_1.jpg", "art_education.jpg", "french_1.jpg", "french_3.jpg", "french_4.jpg", "french_detail_1.jpg", "french_detail_2.jpg",
				"perfect_whole_1.jpg", "perfect_whole_3.jpg", "perfect_whole_detail_1.jpg", "perfect_whole_detail_2.jpg",
				"urban_life_1.jpg", "urban_life_2.jpg", "urban_life_5.jpg"
			)
		),*/
		"bw_photos" => Array
		(
			"name" => "Black and White Film Photography",
			"period" => Array(2017),
			"images" => Array
			(
				"city_park.jpg", Array("src" => "dark_flowers_1.jpg", "title" => "Dark Flowers I"),
				Array("src" => "dark_flowers_2.jpg", "title" => "Dark Flowers II"), "flowers_after_dark.jpg",
				"housework.jpg", "in_a_hurry.jpg", "outdoor_light.jpg", "trail_of_socks.jpg"
			)
		),
		"equilibrium" => Array
		(
			"name" => "Equilibrium",
			"period" => Array(2016),
			"images" => Array
			(
				Array("src" => "equilibrium_1.jpg", "title" => "Equilibrium"),
				Array("src" => "equilibrium_2.jpg", "title" => "Equilibrium"),
				Array("src" => "america.jpg", "title" => "America"),
				Array("src" => "perfect_whole_1.jpg", "title" => "Perfect Whole"),
				Array("src" => "perfect_whole_2.jpg", "title" => "Perfect Whole")
			)
		),
		"art_projects" => Array
		(
			"name" => "Art Projects",
			"period" => null,
			"images" => Array
			(
				"flourish.png",
				Array("src" => "abstract_design_1.jpg", "title" => "Abstract Design 1"),
				Array("src" => "abstract_design_2.jpg", "title" => "Abstract Design 2"),
				Array("src" => "sky_and_water.jpg", "title" => "Sky and Water"),
				"alien_queen.jpg", "brain_space.jpg", "iteration.jpg", "i_will_let_this_go.jpg",
				"modern_token_of_affection.jpg",
				Array("src" => "what's_missing_in_art_history.jpg", "title" => "What's Missing in Art History?")
			)
		),
		"color_theory" => Array
		(
			"name" => "Color Theory",
			"period" => Array(2015),
			"images" => Array
			(
				"city_life.jpg", "stained_glass.jpg", "construction.jpg",
				"construction_detail_1.jpg", "construction_detail_2.jpg", "ascent.jpg"
			)
		),
		"still_lifes" => Array
		(
			"name" => "Still Lifes",
			"period" => Array(2013, 2015),
			"images" => Array
			(
				"collected_objects.jpg", "ghosts_of_childhood_objects.jpg", "grandmother's_objects.jpg",
				"hushed_sentiment.jpg", "near_the_window.jpg", "silhouette.jpg"
			)
		),
		"drawings" => Array
		(
			"name" => "Drawings",
			"period" => Array(2012, "present"),
			"images" => Array
			(
				"autumn_flowers.jpg", "decorative_peppers.jpg", "fall(ing)_flowers.jpg", "poinsettia_in_a_foil_vase.jpg",
				"porcelain.jpg", "rain.jpg", "roses_in_water.jpg", "together.jpg", "wind.jpg"
			)
		)
	);

	foreach($projects as $key => &$project)
	{
		$project["id"] = $key;
		$project["thumbnail"] = project_path($project).$project["id"].".jpg";
	}

	return $projects;
}


function generate_collection_json()
{
	$projects = array_values(generate_data());
	foreach($projects as &$project)
	{
		unset($project["images"]);
	}
	return $projects;
}


function generate_item_json($id)
{
	$projects = generate_data();
	if( ! array_key_exists($id, $projects) )
		throw new NotFoundException("Can't find the project with ID '{$id}'");

	$project = $projects[$id];
	$base_path = project_path($project);
	$project["folders"] = Array
	(
		"raw" => "{$base_path}raw/",
		"large" => "{$base_path}large/",
		"thumb" => "{$base_path}thumb/"
	);
	render_json($project);
}


function generate_image_json($id, $image_src)
{
	$projects = generate_data();
	if( ! array_key_exists($id, $projects) )
		throw new NotFoundException("Can't find the project with ID '{$id}'");

	$project = $projects[$id];
	$images = $project["images"];
	$key = find_image_index($images, $image_src);
	if( $key === FALSE )
		throw new NotFoundException("Can't find the image '{$image_src}' in the project '{$id}'");

	$image = $images[$key];
	$prev_src = ($key == 0) ? null : get_src_from_image($images[$key - 1]);
	$next_src = ($key == count($images)-1) ? null : get_src_from_image($images[$key + 1]);
	unset($project["images"]);
	unset($project["thumbnail"]);
	$base_path = project_path($project);
	$image_props = Array
	(
		"relative_src" => $image_src,
		"absolute_src" => "{$base_path}large/{$image_src}"
	);
	if( is_array($image) )
		$image_props["title"] = $image["title"];
	render_json(Array(
		"project" => $project,
		"image" => $image_props,
		"previous" => $prev_src,
		"next" => $next_src
	));
}
