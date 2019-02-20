<?php

include DIR_CONFIG.'projects.inc.php';

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

function add_timestamp($image)
{
	return $image."?t=".filemtime($image);
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
	$projects = get_projects();

	foreach($projects as $key => &$project)
	{
		$project["id"] = $key;
		$thumbnail = ($project["id"].".jpg");
		if( array_key_exists("thumbnail", $project))
			$thumbnail = $project["thumbnail"];
		$project["thumbnail"] = add_timestamp(project_path($project).$thumbnail);
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
