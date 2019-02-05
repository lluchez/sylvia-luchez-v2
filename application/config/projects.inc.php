<?php

// large: between 1000x1000 and 1500x1500
// thumb: height > 250

function get_projects()
{
  return Array
  (
    "landscapes" => Array
    (
      "name" => "Landscapes",
      "period" => Array(2018),
      "images" => Array
      (
        "view_from_chilnualna_falls.jpg", "chilnualna_falls_in_autumn.jpg", "poppies_in_a_field.jpg", "altanka.jpg"
      )
    ),
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
    "photography" => Array
    (
      "name" => "Photography",
      "period" => Array(2017),
      "images" => Array
      (
        "city_park.jpg", Array("src" => "dark_flowers_1.jpg", "title" => "Dark Flowers I"),
        Array("src" => "dark_flowers_2.jpg", "title" => "Dark Flowers II"), "flowers_after_dark.jpg",
        "housework.jpg", "in_a_hurry.jpg", "outdoor_light.jpg", "trail_of_socks.jpg"
      )
    ),
    "explorations" => Array
    (
      "name" => "Explorations",
      "period" => null,
      "images" => Array
      (
        "tasty_shoe.jpg",
        "flourish.png",
        Array("src" => "abstract_design_1.jpg", "title" => "Abstract Design 1"),
        Array("src" => "abstract_design_2.jpg", "title" => "Abstract Design 2"),
        Array("src" => "sky_and_water.jpg", "title" => "Sky and Water"),
        "poinsettia_in_a_foil_vase.jpg", "porcelain.jpg", "rain.jpg",
        "modern_token_of_affection.jpg", "art_history.jpg"
      )
    ),
    "printmaking" => Array
    (
      "name" => "Printmaking",
      "period" => null,
      "images" => Array
      (
        "alien_queen.jpg", "brain_space.jpg", "iteration.jpg", "letting_go.jpg",
      )
    ),
    "color_theory" => Array
    (
      "name" => "Color Theory",
      "period" => Array(2015),
      "images" => Array
      (
        "city_life.jpg", "stained_glass.jpg", "construction.jpg",
        "construction_detail_1.jpg", /*"construction_detail_2.jpg",*/ "ascent.jpg"
      )
    ),
    "equilibrium" => Array
    (
      "name" => "Equilibrium",
      "period" => Array(2016),
      "images" => Array
      (
        Array("src" => "equilibrium_1.jpg", "title" => "Equilibrium"),
        // Array("src" => "equilibrium_2.jpg", "title" => "Equilibrium"),
        Array("src" => "america.jpg", "title" => "America"),
        // Array("src" => "perfectly_whole_1.jpg", "title" => "Perfectly Whole"),
        Array("src" => "perfectly_whole_2.jpg", "title" => "Perfectly Whole")
      )
    ),
    "still_lifes" => Array
    (
      "name" => "Still Lifes",
      "period" => Array(2013, 2018),
      "images" => Array
      (
        Array("src" => "manos_flowers.jpg", "title" => "Mano's Flowers"),
        "collected_objects.jpg", "ghosts_of_childhood_objects.jpg", "grandmother's_objects.jpg",
        "quiet_spaces.jpg", "near_the_window.jpg", "silhouette.jpg"
      )
    ),
    "drawings" => Array
    (
      "name" => "Drawings",
      "period" => Array(2012, 2013),
      "images" => Array
      (
        "autumn_flowers.jpg", "decorative_peppers.jpg", "fall(ing)_flowers.jpg", "roses_in_water.jpg" /*, "together.jpg", "wind.jpg"*/
      )
    )
  );
}