<?php

/*
	Copyright (C) 2017 by Clearcode <https://clearcode.cc>
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

namespace Clearcode\Framework\v2;

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( __NAMESPACE__ . '\Autoloader' ) ) {
	class Autoloader {
        protected $namespace = '';
        protected $dir       = '';

	    public function __construct( $namespace, $dir ) {
            $this->namespace = $namespace;
            $this->dir       = $dir;

            spl_autoload_register( [ $this, 'load' ] );
        }

        public function load( $class ) {
			if ( 0 !== strpos( $class, $this->namespace ) ) return false;
			if ( is_file( $file = trailingslashit( $this->dir ) . 'includes/' . $this->class2file( $class ) ) ) {
			    require_once $file;
                return true;
            }
            return false;
		}

		protected function class2file( $class ) {
            $file = substr( $class, strlen( $this->namespace ) );
            $file = strtolower( $file );
            $file = str_replace( '\\', '/', $file );
            $file = str_replace( '_', '-', $file );
            $file = trim( $file, '/' );

            return $file . '.php';
        }
	}
}
