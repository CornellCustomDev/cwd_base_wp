<div class="cards">
  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
    <div class="card">
      <div class="group-image">
        <?php
          $img_id = get_field('image_id', get_the_ID());
          $img_url = $img_id ? wp_get_attachment_image_url($img_id, 'news-listing-image') : get_field('image', get_the_ID());

          $listing_img = $img_url ?: $fallback_img;
        ?>
          <a href="<?php the_permalink(); ?>">

          <div class="landscape"><img src="<?php echo $listing_img; ?>" alt=""></div>

          <div class="overlay">
            <h3 class="designer">
              <span class="deco"><?php the_title(); ?></span>
            </h3>

            <sub-heading>News</sub-heading>

            <p class="summary"><?php print_r(custom_excerpt(120)); ?></p>
          </div>
        </a>
      </div>
    </div>
  <?php endwhile; ?>

  <?php wp_reset_postdata(); ?>
</div>
