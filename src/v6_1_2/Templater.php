<?php

/*
    Copyright (C) 2021 by Clearcode <https://clearcode.cc>
    and associates (see AUTHORS.txt file).

    This file is part of clearcode/wordpress-framework.

    clearcode/wordpress-framework is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.

    clearcode/wordpress-framework is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with clearcode/wordpress-framework; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

namespace Clearcode\Framework\v6_1_2;

defined( 'ABSPATH' ) or exit;

if ( ! class_exists( __NAMESPACE__ . '\Templater' ) ) {
    class Templater {
        protected $dirs = [];

        public function __construct( array $dirs = [ '' ] ) {
            $this->dirs = $dirs;
        }

        protected function find( $file ) {
            foreach ( $this->dirs as $dir ) {
                if ( is_file( $path = ( $dir ? trailingslashit( $dir ) : '' ) . $file ) ) return $path;
                elseif ( is_file( $path .= '.php' ) ) return $path;
            }
            return false;
        }

        public function render( string $file, array $vars = [] ) {
            if ( ! $file = $this->find( $file ) ) return false;
            if ( $vars ) extract( $vars, EXTR_SKIP );

            ob_start();
            include $file;

            return ob_get_clean();
        }
    }
}
