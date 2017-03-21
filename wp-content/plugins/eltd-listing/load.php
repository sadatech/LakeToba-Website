<?php

require_once 'const.php';
require_once 'helpers.php';

//load lib
require_once 'lib/post-type-interface.php';
require_once 'lib/shortcode-interface.php';

//load dashboard
require_once 'dashboard/load.php';

//load post-post-types
require_once 'post-types/listing/listing-register.php';
require_once 'post-types/listing/shortcodes/listing-advanced-search.php';
require_once 'post-types/listing/shortcodes/listing-search.php';
require_once 'post-types/listing/shortcodes/listing-basic.php';
require_once 'post-types/listing/shortcodes/listing-feature-list.php';
require_once 'post-types/listing-type/listing-type-register.php';
require_once 'post-types/listing-package/listing-package-register.php';
require_once 'post-types/listing-package/shortcodes/listing-packages.php';
require_once 'post-types/post-types-register.php'; //this has to be loaded last
require_once 'post-types/taxonomy-meta-fields.php';

//load shortcodes inteface
require_once 'lib/shortcode-loader.php';

