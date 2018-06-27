<?php

/*
    Copyright (C) 2018 by Clearcode <https://clearcode.cc>
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

namespace Clearcode\Framework\v4;

defined( 'ABSPATH' ) or exit;

if ( ! class_exists( __NAMESPACE__ . '\Request' ) ) {
    class Request {
        use Singleton;

        protected $type = '';

        public function __construct() {
            if     ( defined( 'REST_REQUEST'   ) && REST_REQUEST   ) $this->type = 'rest';
            elseif ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) $this->type = 'xmlrpc';
            elseif ( defined( 'DOING_AJAX'     ) && DOING_AJAX     ) $this->type = 'ajax';
            elseif ( defined( 'DOING_CRON'     ) && DOING_CRON     ) $this->type = 'cron';
            elseif ( is_admin()                                    ) $this->type = 'backend';
            else                                                     $this->type = 'frontend';
        }

        public function __toString() {
            return $this->type;
        }
    }
}
