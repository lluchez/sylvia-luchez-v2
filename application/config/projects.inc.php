<?php

// large: between 1000x1000 and 1500x1500
// thumb: height > 250

function get_projects()
{
  return Array
  (
    "ceramics" => Array
    (
      "name" => "Ceramics",
      "period" => Array(2017),
      "images" => Array
      (
        Array("src" => "blue_green_container.jpg", "title" => "Blue-Green Container"),
        "mixed_design_bowl.jpg", "star_plate.jpg", "teapot.jpg", "triangle_plate.jpg"
      )
    ),
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
      "name" => "Equilibrium/Identity Spheres",
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
        "tasty_shoe.jpg",
        "flourish.png",
        Array("src" => "abstract_design_1.jpg", "title" => "Abstract Design 1"),
        Array("src" => "abstract_design_2.jpg", "title" => "Abstract Design 2"),
        Array("src" => "sky_and_water.jpg", "title" => "Sky and Water"),
        "alien_queen.jpg", "brain_space.jpg", "iteration.jpg", "i_will_let_this_go.jpg",
        "modern_token_of_affection.jpg",
        "art_history.jpg"
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
        "quiet_spaces.jpg", "near_the_window.jpg", "silhouette.jpg"
      )
    ),
    "drawings" => Array
    (
      "name" => "Drawings",
      "period" => Array(2012, "present"),
      "images" => Array
      (
        "autumn_flowers.jpg", "decorative_peppers.jpg", "fall(ing)_flowers.jpg", "poinsettia_in_a_foil_vase.jpg",
        "porcelain.jpg", "rain.jpg", "roses_in_water.jpg" /*, "together.jpg", "wind.jpg"*/
      )
    )
  );
}