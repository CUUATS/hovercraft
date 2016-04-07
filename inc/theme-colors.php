<?php
/**
 * Custom CSS for theme colors.
 *
 * @package Hovercraft
 */?>
<?php
  header('Content-type: text/css');

  function get_color($name, $default) {
    if ( isset($_GET[$name]) ) {
      $color = $_GET[$name];
      if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
        return $color;
      }
    }
    return $default;
  }

  function rgba( $color, $alpha ) {
    $hex = str_replace("#", "", $color);
    if (strlen( $hex ) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
    }
    return "rgba({$r}, {$g}, {$b}, {$alpha})";
  }

  $header_background_color = get_color('hb', '#eeeeee');
  $header_text_color = get_color('ht', '#000000');
  $header_link_color = get_color('hl', '#00554e');

  $content_background_color = get_color('cb', '#ffffff');
  $content_text_color = get_color('ct', '#000000');
  $content_link_color = get_color('cl', '#00554e');

  $sidebar_background_color = get_color('sb', '#ffffff');
  $sidebar_text_color = get_color('st', '#000000');
  $sidebar_link_color = get_color('sl', '#00554e');

  $footer_background_color = get_color('fb', '#444444');
  $footer_text_color = get_color('ft', '#ffffff');
  $footer_link_color = get_color('fl', '#a1fff6');

?>
/* Header */
#masthead {
  background: <?php echo $header_background_color; ?>;
  color: <?php echo $header_text_color; ?>;
}

#masthead a,
#masthead a:visited {
  color: <?php echo $header_link_color; ?>;
}

#masthead .site-title a:hover,
#masthead #primary-menu a:hover {
  color: <?php echo $header_text_color; ?>;
}

.menu-toggle .lines:before {
  color: <?php echo $header_text_color; ?>;
}

.menu-toggle .lines::before {
  color: <?php echo $header_text_color; ?>;
}

#masthead-menu .menu-title {
  border-color: <?php echo $header_text_color; ?>;
}

#primary-navigation li.menu-item a:hover,
#primary-navigation li.menu-item a:focus {
  border-color: <?php echo $header_link_color; ?>;
}

@media screen and (min-width: 800px) {
  .flexbox #primary-navigation ul.sub-menu {
    background-color: <?php echo $content_background_color; ?>;
  }

  .flexbox #primary-navigation li.menu-item .sub-menu a,
  .flexbox #primary-navigation li.menu-item .sub-menu a:visited {
    color: <?php echo $content_link_color; ?>;
  }

  .flexbox #masthead #primary-navigation li.menu-item .sub-menu a:hover,
  .flexbox #masthead #primary-navigation li.menu-item .sub-menu a:focus {
    color: <?php echo $content_text_color; ?>;
    border-color: <?php echo $content_link_color; ?>;
  }
}

/* Content area */
#primary,
.search-form label {
  background-color: <?php echo $content_background_color; ?>;
}

#primary a,
#primary a:visited {
  color: <?php echo $content_link_color; ?>;
}
#primary .widget li::before {
  color: <?php echo $content_link_color; ?>;
}

#primary,
#primary button,
#primary input,
#primary select,
#primary textarea,
#primary h1,
#primary h2,
#primary h3,
#primary h4,
#primary h5,
#primary h6,
#primary .widget,
#primary .widget .widget-title,
#primary a:hover,
.search-form .search-field {
  color: <?php echo $content_text_color; ?>;
}

#primary button,
#primary input[type="button"],
#primary input[type="reset"],
#primary input[type="submit"] {
  color: <?php echo $content_text_color; ?>;
  border-color: <?php echo $content_text_color; ?>;
}

#primary button:hover,
#primary input[type="button"]:hover,
#primary input[type="reset"]:hover,
#primary input[type="submit"]:hover,
#primary button:active,
#primary button:focus,
#primary input[type="button"]:active,
#primary input[type="button"]:focus,
#primary input[type="reset"]:active,
#primary input[type="reset"]:focus,
#primary input[type="submit"]:active,
#primary input[type="submit"]:focus {
  color: <?php echo $content_link_color; ?>;
  border-color: <?php echo $content_link_color; ?>;
}

#primary blockquote {
  border-left-color: <?php echo $content_link_color; ?>;
}

#primary .tablepress .sorting:hover,
#primary .tablepress .sorting_asc,
#primary .tablepress .sorting_desc,
#primary .tablepress thead th:focus {
  background-color: <?php echo $content_text_color; ?>;
  color: <?php echo $content_background_color; ?>;
}

#primary .tablepress tfoot th,
#primary .tablepress thead th {
  background-color: <?php echo $content_link_color; ?>;
  color: <?php echo $content_background_color; ?>;
}

/* Sidebar */
#content,
#secondary {
  background-color: <?php echo $sidebar_background_color; ?>;
}

#secondary a,
#secondary a:visited {
  color: <?php echo $sidebar_link_color; ?>;
}
#secondary .widget li::before {
  color: <?php echo $sidebar_link_color; ?>;
}

#secondary,
#secondary button,
#secondary input,
#secondary select,
#secondary textarea,
#secondary h1,
#secondary h2,
#secondary h3,
#secondary h4,
#secondary h5,
#secondary h6,
#secondary .widget,
#secondary .widget .widget-title,
#secondary a:hover {
  color: <?php echo $sidebar_text_color; ?>;
}

#secondary button,
#secondary input[type="button"],
#secondary input[type="reset"],
#secondary input[type="submit"] {
  color: <?php echo $sidebar_text_color; ?>;
  border-color: <?php echo $sidebar_text_color; ?>;
}

#secondary button:hover,
#secondary input[type="button"]:hover,
#secondary input[type="reset"]:hover,
#secondary input[type="submit"]:hover,
#secondary button:active,
#secondary button:focus,
#secondary input[type="button"]:active,
#secondary input[type="button"]:focus,
#secondary input[type="reset"]:active,
#secondary input[type="reset"]:focus,
#secondary input[type="submit"]:active,
#secondary input[type="submit"]:focus {
  color: <?php echo $sidebar_link_color; ?>;
  border-color: <?php echo $sidebar_link_color; ?>;
}

#secondary .widget_nav_menu ul {
  background-color: <?php echo $sidebar_background_color; ?>;
}

#secondary .widget_nav_menu .current-menu-item {
  background-color: <?php echo rgba($sidebar_link_color, 0.1); ?>;
}

#secondary .widget_nav_menu ul,
#secondary .widget_nav_menu li {
  border-color: <?php echo rgba($sidebar_text_color, 0.2); ?>;
}

/* Footer */
body,
#colophon {
  background-color: <?php echo $footer_background_color; ?>;
}

#colophon a,
#colophon a:visited {
  color: <?php echo $footer_link_color; ?>;
}
#colophon .widget li::before {
  color: <?php echo $footer_link_color; ?>;
}

#colophon,
#colophon button,
#colophon input,
#colophon select,
#colophon textarea,
#colophon h1,
#colophon h2,
#colophon h3,
#colophon h4,
#colophon h5,
#colophon h6,
#colophon .widget,
#colophon .widget .widget-title,
#colophon a:hover {
  color: <?php echo $footer_text_color; ?>;
}

#colophon button,
#colophon input[type="button"],
#colophon input[type="reset"],
#colophon input[type="submit"] {
  color: <?php echo $footer_text_color; ?>;
  border-color: <?php echo $footer_text_color; ?>;
}

#colophon button:hover,
#colophon input[type="button"]:hover,
#colophon input[type="reset"]:hover,
#colophon input[type="submit"]:hover,
#colophon button:active,
#colophon button:focus,
#colophon input[type="button"]:active,
#colophon input[type="button"]:focus,
#colophon input[type="reset"]:active,
#colophon input[type="reset"]:focus,
#colophon input[type="submit"]:active,
#colophon input[type="submit"]:focus {
  color: <?php echo $footer_link_color; ?>;
  border-color: <?php echo $footer_link_color; ?>;
}
