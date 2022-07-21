<?php

/*
    Copyright (C) 2022 by Clearcode <https://clearcode.cc>
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

namespace Clearcode\Framework\v6_1_3;

use ReflectionClass;

defined( 'ABSPATH' ) or exit;

if ( ! trait_exists( __NAMESPACE__ . '\Singleton' ) ) {
    trait Singleton {
        public function __clone() {
            _doing_it_wrong( __METHOD__, __( 'Cheatin&#8217; uh?' ), '' );
        }
        public function __wakeup() {
            _doing_it_wrong( __METHOD__, __( 'Cheatin&#8217; uh?' ), '' );
        }
        
        protected function __construct() {
            _doing_it_wrong( __METHOD__, __( 'Cheatin&#8217; uh?' ), '' );
        }

        static public function instance() {
            static $instance = null;

            if ( $instance ) return $instance;

            $reflection = new ReflectionClass( static::class );

            $instance = $reflection->newInstanceWithoutConstructor();

            $constructor = $reflection->getConstructor();
            $constructor->setAccessible( true );
            $constructor->invokeArgs( $instance, func_get_args() );

            return $instance;
        }
    }
}
