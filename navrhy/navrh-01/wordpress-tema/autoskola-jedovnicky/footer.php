<footer class="site-footer">
  <div class="wrap footer-inner">
    <div><strong>Autoškola Michal Jedovnický</strong><span>Kyjov a okolí</span>
      <?php if ( aj_get('instagram_url') || aj_get('facebook_url') ) : ?>
      <nav class="social-links" aria-label="Sociální sítě autoškoly">
        <?php if ( aj_get('instagram_url') ) : ?><a href="<?php echo esc_url( aj_get('instagram_url') ); ?>" target="_blank" rel="noopener noreferrer">Instagram</a><?php endif; ?>
        <?php if ( aj_get('facebook_url') ) : ?><a href="<?php echo esc_url( aj_get('facebook_url') ); ?>" target="_blank" rel="noopener noreferrer">Facebook</a><?php endif; ?>
      </nav>
      <?php endif; ?>
    </div>
    <div><span>Provozovatel: <?php echo esc_html( aj_get('business_identity') ); ?></span><span>Sídlo: <?php echo esc_html( aj_get('business_address') ); ?></span></div>
    <a href="<?php echo esc_url( home_url('/#top') ); ?>">Zpět nahoru</a>
  </div>
  <?php if ( function_exists('the_privacy_policy_link') ) : ?><div class="wrap privacy-link"><?php the_privacy_policy_link(); ?></div><?php endif; ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>
