<?php

/*
    Copyright (C) 2020 by Clearcode <https://clearcode.cc>
    and associates (see AUTHORS.txt file).

    This file is part of clearcode/wordpress-framework.

    clearcode/wordpress-framework is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    clearcode/wordpress-framework is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with clearcode/wordpress-framework; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

namespace Clearcode\Framework\v6_0_0;

defined( 'ABSPATH' ) or exit;

if ( ! class_exists( __NAMESPACE__ . '\Templater' ) ) {
    class Templater {
        protected $dir = '';

        public function __construct( string $dir = '' ) {
            if ( is_dir( $dir ) ) $this->dir = trailingslashit( $dir );
        }

        public function render( string $file, array $vars = [] ) {
            if ( ! is_file( $template = $this->dir . $file ) )
                if ( ! is_file( $template .= '.php' ) ) return false;

            extract( $vars, EXTR_SKIP );

            ob_start();
            include $template;

            return ob_get_clean();
        }
    }
}
