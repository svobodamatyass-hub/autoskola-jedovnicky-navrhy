<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#fafaf8">
  <?php wp_head(); ?>
</head>
<body id="top" <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main">Přeskočit na obsah</a>
<header class="site-header" id="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="<?php echo esc_url( home_url('/#top') ); ?>" aria-label="Autoškola Michala Jedovnického, zpět na začátek">
      <img src="<?php echo esc_url( aj_get('logo') ); ?>" alt="" width="48" height="48">
      <span>Autoškola <strong>Michal Jedovnický</strong></span>
    </a>
    <nav class="main-nav" id="main-nav" aria-label="Hlavní navigace">
      <a href="<?php echo esc_url( home_url('/#pristup') ); ?>">O nás</a>
      <a href="<?php echo esc_url( home_url('/#kurzy') ); ?>">Ceník</a>
      <a href="<?php echo esc_url( home_url('/#galerie') ); ?>">Galerie</a>
      <a href="<?php echo esc_url( home_url('/#kontakt') ); ?>">Kontakt</a>
      <a class="nav-signup" href="<?php echo esc_url( aj_get('signup_url') ); ?>" target="_blank" rel="noopener noreferrer">Přihlásit se</a>
    </nav>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-nav" aria-label="Otevřít menu"><span></span><span></span></button>
  </div>
</header>
