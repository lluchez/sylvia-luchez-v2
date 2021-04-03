<?php

// large: between 1000x1000 and 1500x1500
// thumb: height > 250

function get_projects() {
  return Array(
    "flow" => Array(
      "name" => "Flow",
      "thumbnail" => "birthday_flowers.jpg",
      "period" => Array(2020),
      "images" => Array(
        'birthday_flowers.jpg', 'layers.jpg', 'flowers_in_a_little_vase.jpg', 'on_the_spur_of_the_moment.jpg',
        'flowers_in_a_shot_glass.jpg', 'purple_flowers_on_textured_background.jpg', 'haunted_spaces.jpg',
        'storied_lines_hovering_in_blue.jpg', 'invasion.jpg', 'sunshine_and_freedom.jpg', 'last_one_standing.jpg', 'time_enough.jpg'
      )
    ),
    "still_life" => Array(
      "name" => "Still Life Paintings",
      "thumbnail" => "quiet_spaces.jpg",
      "period" => Array(2013, 2020),
      "images" => Array(
        /*"flowers_in_a_little_vase.jpg", "the_butterfly_has_time_enough.jpg", "on_the_spur_of_the_moment.jpg", "warmer_months.jpg",
        "sunshine_freedom_and_a_little_flower.jpg", "there_are_always_flowers.jpg", "when_spring_is_almost_here.jpg",*/
        "untamed.jpg", "collected_objects.jpg", "ghosts_of_childhood_objects.jpg", "grandmother's_objects.jpg",
        "quiet_spaces.jpg", "near_the_window.jpg", "silhouette.jpg"
      )
    ),
    "drawings" => Array(
      "name" => "Drawings",
      "thumbnail" => "roses_in_water.jpg",
      "period" => Array(2012, 2020),
      "images" => Array(
        "early_spring.jpg", "autumn_flowers.jpg", "roses_in_water.jpg" /*, "fall(ing)_flowers.jpg", "decorative_peppers.jpg", "together.jpg", "wind.jpg"*/
      )
    ),
    "landscapes" => Array(
      "name" => "Landscapes",
      "thumbnail" => "companionship.jpg",
      "period" => Array(2018),
      "images" => Array(
        "still.jpg", "companionship.jpg", "transitions.jpg", "memories_of_a_past_that_is_not_mine.jpg", "where_i_go_to_dream.jpg"
      )
    ),
    "ceramics" => Array(
      "name" => "Ceramics",
      "thumbnail" => "triangle_plate.jpg",
      "period" => Array(2017),
      "images" => Array(
        Array("src" => "blue_green_container.jpg", "title" => "Blue-Green Container"),
        "mixed_design_bowl.jpg", "star_plate.jpg", "teapot.jpg", "triangle_plate.jpg"
      )
    ),
    /*"identity_spheres" => Array(
      "name" => "Identity Spheres",
      //"thumbnail" => "",
      "period" => Array(2016),
      "images" => Array(
        "polish_american_1.jpg", "art_education.jpg", "french_1.jpg", "french_3.jpg", "french_4.jpg", "french_detail_1.jpg", "french_detail_2.jpg",
        "perfect_whole_1.jpg", "perfect_whole_3.jpg", "perfect_whole_detail_1.jpg", "perfect_whole_detail_2.jpg",
        "urban_life_1.jpg", "urban_life_2.jpg", "urban_life_5.jpg"
      )
    ),*/
    "photography" => Array(
      "name" => "Photography",
      "thumbnail" => "in_a_hurry.jpg",
      "period" => Array(2017),
      "images" => Array(
        "flowers_after_dark.jpg", "housework.jpg", "in_a_hurry.jpg", "trail_of_socks.jpg"
        // "city_park.jpg", Array("src" => "dark_flowers_1.jpg", "title" => "Dark Flowers I"),
        // Array("src" => "dark_flowers_2.jpg", "title" => "Dark Flowers II"), "outdoor_light.jpg",
      )
    ),
    /*"explorations" => Array(
      "name" => "Explorations",
      "thumbnail" => "abstract_design_1.jpg",
      "period" => null,
      "images" => Array
      (
        "tasty_shoe.jpg",
        "flourish.png",
        Array("src" => "fish_still_life.jpg", "title" => "Fish Still Life inspired by Edouard Manet's Fish (Still Life)"),
        Array("src" => "abstract_design_1.jpg", "title" => "Abstract Design 1"),
        // Array("src" => "abstract_design_2.jpg", "title" => "Abstract Design 2"),
        Array("src" => "sky_and_water.jpg", "title" => "Sky and Water"),
        "poinsettia_in_a_foil_vase.jpg", "porcelain.jpg", "rain.jpg", "art_history.jpg"
        //"modern_token_of_affection.jpg",
      )
    ),*/
    "printmaking" => Array(
      "name" => "Printmaking",
      "thumbnail" => "alien_queen.jpg",
      "period" => Array(2016),
      "images" => Array(
        "alien_queen.jpg", "brain_space.jpg", "iteration.jpg", "letting_go.jpg",
      )
    ),
    "color_theory" => Array(
      "name" => "Color Theory",
      "thumbnail" => "city_life.jpg",
      "period" => Array(2015),
      "images" => Array(
        "city_life.jpg", "stained_glass.jpg", "construction.jpg",
        "construction_detail.jpg", /*"construction_detail_2.jpg",*/ "plants_on_a_mosaic_background.jpg"
      )
    ),
    "equilibrium" => Array(
      "name" => "Equilibrium",
      "thumbnail" => "equilibrium_1.jpg",
      "period" => Array(2016),
      "images" => Array(
        Array("src" => "equilibrium_1.jpg", "title" => "Equilibrium"),
        // Array("src" => "equilibrium_2.jpg", "title" => "Equilibrium"),
        Array("src" => "america.jpg", "title" => "America"),
        // Array("src" => "perfectly_whole_1.jpg", "title" => "Perfectly Whole"),
        Array("src" => "perfectly_whole_2.jpg", "title" => "Perfectly Whole")
      )
    )
  );
}