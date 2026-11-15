<?php
/**
 * Theme setup and editable content.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function aj_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'aj_setup' );

function aj_assets() {
    $uri = get_template_directory_uri();
    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_style( 'aj-layout', $uri . '/assets/styles.css', array(), $version );
    wp_enqueue_style( 'aj-theme', get_stylesheet_uri(), array( 'aj-layout' ), $version );
    wp_enqueue_script( 'aj-interactions', $uri . '/assets/script.js', array(), $version, true );
}
add_action( 'wp_enqueue_scripts', 'aj_assets' );

/**
 * Defaults and controls share one definition so administrators see the
 * same values that visitors see before the first save.
 */
function aj_fields() {
    $asset = get_template_directory_uri() . '/assets/';

    return array(
        'hero_title' => array( 'section' => 'aj_text', 'label' => 'Hlavní nadpis', 'default' => 'Autoškola Michala Jedovnického', 'type' => 'text' ),
        'hero_title_accent' => array( 'section' => 'aj_text', 'label' => 'Druhá část nadpisu', 'default' => 'v Kyjově.', 'type' => 'text' ),
        'seo_title' => array( 'section' => 'aj_seo', 'label' => 'Titulek úvodní stránky', 'default' => 'Autoškola Michal Jedovnický | Kyjov, B a motocykly', 'type' => 'text' ),
        'seo_description' => array( 'section' => 'aj_seo', 'label' => 'Popis úvodní stránky', 'default' => 'Autoškola Michala Jedovnického v Kyjově. Kurzy skupiny B a motocyklů AM, A1, A2 a A, celý ceník a online přihláška. Výcvik na Kyjovsku.', 'type' => 'textarea' ),
        'business_identity' => array( 'section' => 'aj_contact', 'label' => 'Provozovatel a IČO', 'default' => 'Michal Jedovnický · IČO 19624867', 'type' => 'text' ),
        'business_address' => array( 'section' => 'aj_contact', 'label' => 'Sídlo podnikatele', 'default' => 'Na Vlastě 401, 696 02 Ratíškovice', 'type' => 'text' ),
        'phone' => array( 'section' => 'aj_contact', 'label' => 'Telefonní číslo', 'default' => '+420 778 761 422', 'type' => 'text' ),
        'street_address' => array( 'section' => 'aj_contact', 'label' => 'Kontaktní adresa – ulice a číslo', 'default' => 'Husova 370/31', 'type' => 'text' ),
        'postal_code' => array( 'section' => 'aj_contact', 'label' => 'Kontaktní adresa – PSČ', 'default' => '697 01', 'type' => 'text' ),
        'city' => array( 'section' => 'aj_contact', 'label' => 'Kontaktní adresa – město', 'default' => 'Kyjov', 'type' => 'text' ),
        'map_query' => array( 'section' => 'aj_contact', 'label' => 'Adresa pro Google Mapy', 'default' => 'Husova 370/31, 697 01 Kyjov', 'type' => 'text' ),
        'signup_url' => array( 'section' => 'aj_contact', 'label' => 'Odkaz na přihlášku', 'default' => 'https://jedovnicky.moje-autoskola.cz/prihlaska.php?iframe=1', 'type' => 'url' ),
        'instagram_url' => array( 'section' => 'aj_contact', 'label' => 'Instagram – ověřený odkaz', 'default' => '', 'type' => 'url' ),
        'facebook_url' => array( 'section' => 'aj_contact', 'label' => 'Facebook – ověřený odkaz', 'default' => '', 'type' => 'url' ),
        'price_octavia' => array( 'section' => 'aj_prices', 'label' => 'Skupina B – Octavia i Fabia', 'default' => '24 000 Kč', 'type' => 'text' ),
        'price_am' => array( 'section' => 'aj_prices', 'label' => 'Skupina AM', 'default' => '16 000 Kč', 'type' => 'text' ),
        'price_a' => array( 'section' => 'aj_prices', 'label' => 'Skupiny A1, A2 a A', 'default' => '17 000 Kč', 'type' => 'text' ),
        'price_extension' => array( 'section' => 'aj_prices', 'label' => 'Rozšíření A', 'default' => '8 000 Kč', 'type' => 'text' ),
        'price_extension_2_years' => array( 'section' => 'aj_prices', 'label' => 'Rozšíření A po 2 letech', 'default' => '5 000 Kč', 'type' => 'text' ),
        'price_return' => array( 'section' => 'aj_prices', 'label' => 'Vrácení oprávnění', 'default' => '3 000 Kč', 'type' => 'text' ),
        'price_training' => array( 'section' => 'aj_prices', 'label' => 'Školení začínajících řidičů', 'default' => '2 500 Kč', 'type' => 'text' ),
        'logo' => array( 'section' => 'aj_images', 'label' => 'Logo autoškoly', 'default' => $asset . 'logo-autoskoly.webp', 'type' => 'image' ),
        'photo_classroom' => array( 'section' => 'aj_images', 'label' => 'Fotografie učebny', 'default' => $asset . 'ucebna.webp', 'type' => 'image' ),
        'photo_interior' => array( 'section' => 'aj_images', 'label' => 'Fotografie interiéru vozu', 'default' => $asset . 'interier-octavia.webp', 'type' => 'image' ),
        'photo_car' => array( 'section' => 'aj_images', 'label' => 'Fotografie vozu', 'default' => $asset . 'skoda-octavia.webp', 'type' => 'image' ),
    );
}

function aj_get( $key ) {
    $fields = aj_fields();
    if ( ! isset( $fields[ $key ] ) ) {
        return '';
    }
    return get_theme_mod( 'aj_' . $key, $fields[ $key ]['default'] );
}

function aj_phone_href() {
    return 'tel:' . preg_replace( '/[^0-9+]/', '', aj_get( 'phone' ) );
}

/**
 * Keep the visible address and structured data on the same editable fields.
 * An SEO plugin takes over metadata when one is installed later.
 */
function aj_seo_plugin_active() {
    return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'SEOPRESS_VERSION' ) || function_exists( 'aioseo' );
}

function aj_front_page_document_title( $title ) {
    if ( is_front_page() && ! aj_seo_plugin_active() ) {
        return aj_get( 'seo_title' );
    }
    return $title;
}
add_filter( 'pre_get_document_title', 'aj_front_page_document_title', 5 );

function aj_remove_duplicate_canonical() {
    if ( is_front_page() && ! aj_seo_plugin_active() ) {
        remove_action( 'wp_head', 'rel_canonical' );
    }
}
add_action( 'wp', 'aj_remove_duplicate_canonical' );

function aj_front_page_seo() {
    if ( ! is_front_page() || aj_seo_plugin_active() ) {
        return;
    }

    $url = home_url( '/' );
    $title = aj_get( 'seo_title' );
    $description = aj_get( 'seo_description' );
    $image = aj_get( 'photo_car' );

    echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:locale" content="cs_CZ">' . "\n";
    echo '<meta property="og:site_name" content="Autoškola Michal Jedovnický">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
    if ( $image ) {
        echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
    }
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";

    $business = array(
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        '@id' => $url . '#autoskola',
        'name' => 'Autoškola Michal Jedovnický',
        'legalName' => 'Michal Jedovnický',
        'url' => $url,
        'description' => $description,
        'telephone' => aj_get( 'phone' ),
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => aj_get( 'street_address' ),
            'postalCode' => aj_get( 'postal_code' ),
            'addressLocality' => aj_get( 'city' ),
            'addressCountry' => 'CZ',
        ),
        'areaServed' => array(
            '@type' => 'AdministrativeArea',
            'name' => 'Kyjovsko',
        ),
    );
    if ( aj_get( 'logo' ) ) {
        $business['logo'] = aj_get( 'logo' );
    }
    if ( $image ) {
        $business['image'] = $image;
    }
    $social_urls = array();
    foreach ( array( 'instagram_url', 'facebook_url' ) as $social_key ) {
        $social_url = aj_get( $social_key );
        if ( $social_url ) {
            $social_urls[] = $social_url;
        }
    }
    if ( $social_urls ) {
        $business['sameAs'] = $social_urls;
    }

    $json = wp_json_encode( $business, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT );
    if ( $json ) {
        echo '<script type="application/ld+json">' . $json . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'aj_front_page_seo', 5 );

function aj_sanitize_checkbox( $value ) {
    return (bool) $value;
}

function aj_customize( $customizer ) {
    $customizer->add_panel( 'aj_content', array(
        'title' => 'Autoškola – obsah webu',
        'priority' => 30,
    ) );
    $sections = array(
        'aj_text' => 'Texty',
        'aj_seo' => 'SEO a sdílení',
        'aj_contact' => 'Kontakt a mapa',
        'aj_prices' => 'Ceník',
        'aj_images' => 'Logo a fotografie',
    );
    foreach ( $sections as $id => $title ) {
        $customizer->add_section( $id, array(
            'title' => $title,
            'panel' => 'aj_content',
        ) );
    }
    foreach ( aj_fields() as $key => $field ) {
        $id = 'aj_' . $key;
        $sanitize = 'sanitize_text_field';
        if ( 'textarea' === $field['type'] ) {
            $sanitize = 'sanitize_textarea_field';
        } elseif ( 'url' === $field['type'] || 'image' === $field['type'] ) {
            $sanitize = 'esc_url_raw';
        } elseif ( 'checkbox' === $field['type'] ) {
            $sanitize = 'aj_sanitize_checkbox';
        }
        $customizer->add_setting( $id, array(
            'default' => $field['default'],
            'sanitize_callback' => $sanitize,
            'transport' => 'refresh',
        ) );
        $args = array(
            'label' => $field['label'],
            'section' => $field['section'],
            'settings' => $id,
        );
        if ( 'image' === $field['type'] ) {
            $customizer->add_control( new WP_Customize_Image_Control( $customizer, $id, $args ) );
        } else {
            $args['type'] = $field['type'];
            $customizer->add_control( $id, $args );
        }
    }
}
add_action( 'customize_register', 'aj_customize' );
