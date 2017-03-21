<?php

/*
   Interface: iSearchAndGoLayoutNode
   A interface that implements Layout Node methods
*/

interface iSearchAndGoLayoutNode
{
    public function hasChidren();

    public function getChild($key);

    public function addChild($key, $value);
}

/*
   Interface: iSearchAndGoRender
   A interface that implements Render methods
*/

interface iSearchAndGoRender
{
    public function render($factory);
}

/*
   Class: SearchAndGoPanel
   A class that initializes Elated Panel
*/

class SearchAndGoPanel implements iSearchAndGoLayoutNode, iSearchAndGoRender
{

    public $children;
    public $title;
    public $name;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($title = "", $name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array())
    {
        $this->children = array();
        $this->title = $title;
        $this->name = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value = $hidden_value;
        $this->hidden_values = $hidden_values;
    }

    public function hasChidren()
    {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key)
    {
        return $this->children[$key];
    }

    public function addChild($key, $value)
    {
        $this->children[$key] = $value;
    }

    public function render($factory)
    {
        $hidden = false;
        if (!empty($this->hidden_property)) {
            if (search_and_go_elated_option_get_value($this->hidden_property) == $this->hidden_value)
                $hidden = true;
            else {
                foreach ($this->hidden_values as $value) {
                    if (search_and_go_elated_option_get_value($this->hidden_property) == $value)
                        $hidden = true;

                }
            }
        }
        ?>
        <div class="eltd-page-form-section-holder"
             id="eltd_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <h3 class="eltd-page-section-title"><?php echo esc_html($this->title); ?></h3>
            <?php
            foreach ($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
        <?php
    }

    public function renderChild(iSearchAndGoRender $child, $factory)
    {
        $child->render($factory);
    }
}

/*
   Class: SearchAndGoContainer
   A class that initializes Elated Container
*/

class SearchAndGoContainer implements iSearchAndGoLayoutNode, iSearchAndGoRender
{

    public $children;
    public $name;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array())
    {
        $this->children = array();
        $this->name = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value = $hidden_value;
        $this->hidden_values = $hidden_values;
    }

    public function hasChidren()
    {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key)
    {
        return $this->children[$key];
    }

    public function addChild($key, $value)
    {
        $this->children[$key] = $value;
    }

    public function render($factory)
    {
        $hidden = false;
        if (!empty($this->hidden_property)) {
            if (search_and_go_elated_option_get_value($this->hidden_property) == $this->hidden_value)
                $hidden = true;
            else {
                foreach ($this->hidden_values as $value) {
                    if (search_and_go_elated_option_get_value($this->hidden_property) == $value)
                        $hidden = true;

                }
            }
        }
        ?>
        <div class="eltd-page-form-container-holder"
             id="eltd_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <?php
            foreach ($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
        <?php
    }

    public function renderChild(iSearchAndGoRender $child, $factory)
    {
        $child->render($factory);
    }
}


/*
   Class: SearchAndGoContainerNoStyle
   A class that initializes Elated Container without css classes
*/

class SearchAndGoContainerNoStyle implements iSearchAndGoLayoutNode, iSearchAndGoRender
{

    public $children;
    public $name;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array())
    {
        $this->children = array();
        $this->name = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value = $hidden_value;
        $this->hidden_values = $hidden_values;
    }

    public function hasChidren()
    {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key)
    {
        return $this->children[$key];
    }

    public function addChild($key, $value)
    {
        $this->children[$key] = $value;
    }

    public function render($factory)
    {
        $hidden = false;
        if (!empty($this->hidden_property)) {
            if (search_and_go_elated_option_get_value($this->hidden_property) == $this->hidden_value)
                $hidden = true;
            else {
                foreach ($this->hidden_values as $value) {
                    if (search_and_go_elated_option_get_value($this->hidden_property) == $value)
                        $hidden = true;

                }
            }
        }
        ?>
        <div id="eltd_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <?php
            foreach ($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
        <?php
    }

    public function renderChild(iSearchAndGoRender $child, $factory)
    {
        $child->render($factory);
    }
}

/*
   Class: SearchAndGoGroup
   A class that initializes Elated Group
*/

class SearchAndGoGroup implements iSearchAndGoLayoutNode, iSearchAndGoRender
{

    public $children;
    public $title;
    public $description;

    function __construct($title = "", $description = "")
    {
        $this->children = array();
        $this->title = $title;
        $this->description = $description;
    }

    public function hasChidren()
    {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key)
    {
        return $this->children[$key];
    }

    public function addChild($key, $value)
    {
        $this->children[$key] = $value;
    }

    public function render($factory)
    {
        ?>

        <div class="eltd-page-form-section">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($this->title); ?></h4>

                <p><?php echo esc_html($this->description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <?php
                    foreach ($this->children as $child) {
                        $this->renderChild($child, $factory);
                    }
                    ?>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php
    }

    public function renderChild(iSearchAndGoRender $child, $factory)
    {
        $child->render($factory);
    }
}

/*
   Class: SearchAndGoNotice
   A class that initializes Elated Notice
*/

class SearchAndGoNotice implements iSearchAndGoRender
{

    public $children;
    public $title;
    public $description;
    public $notice;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($title = "", $description = "", $notice = "", $hidden_property = "", $hidden_value = "", $hidden_values = array())
    {
        $this->children = array();
        $this->title = $title;
        $this->description = $description;
        $this->notice = $notice;
        $this->hidden_property = $hidden_property;
        $this->hidden_value = $hidden_value;
        $this->hidden_values = $hidden_values;
    }

    public function render($factory)
    {
        $hidden = false;
        if (!empty($this->hidden_property)) {
            if (search_and_go_elated_option_get_value($this->hidden_property) == $this->hidden_value)
                $hidden = true;
            else {
                foreach ($this->hidden_values as $value) {
                    if (search_and_go_elated_option_get_value($this->hidden_property) == $value)
                        $hidden = true;

                }
            }
        }
        ?>

        <div class="eltd-page-form-section"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($this->title); ?></h4>

                <p><?php echo esc_html($this->description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="alert alert-warning">
                        <?php echo esc_html($this->notice); ?>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php
    }
}

/*
   Class: SearchAndGoRow
   A class that initializes Elated Row
*/

class SearchAndGoRow implements iSearchAndGoLayoutNode, iSearchAndGoRender
{

    public $children;
    public $next;

    function __construct($next = false)
    {
        $this->children = array();
        $this->next = $next;
    }

    public function hasChidren()
    {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key)
    {
        return $this->children[$key];
    }

    public function addChild($key, $value)
    {
        $this->children[$key] = $value;
    }

    public function render($factory)
    {
        ?>
        <div class="row<?php if ($this->next) echo " next-row"; ?>">
            <?php
            foreach ($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
        <?php
    }

    public function renderChild(iSearchAndGoRender $child, $factory)
    {
        $child->render($factory);
    }
}

/*
   Class: SearchAndGoTitle
   A class that initializes Elated Title
*/

class SearchAndGoTitle implements iSearchAndGoRender
{
    private $name;
    private $title;
    public $hidden_property;
    public $hidden_values = array();

    function __construct($name = "", $title = "", $hidden_property = "", $hidden_value = "")
    {
        $this->title = $title;
        $this->name = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value = $hidden_value;
    }

    public function render($factory)
    {
        $hidden = false;
        if (!empty($this->hidden_property)) {
            if (search_and_go_elated_option_get_value($this->hidden_property) == $this->hidden_value)
                $hidden = true;
        }
        ?>
        <h5 class="eltd-page-section-subtitle"
            id="eltd_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>><?php echo esc_html($this->title); ?></h5>
        <?php
    }
}

/*
   Class: SearchAndGoField
   A class that initializes Elated Field
*/

class SearchAndGoField implements iSearchAndGoRender
{
    private $type;
    private $name;
    private $default_value;
    private $label;
    private $description;
    private $options = array();
    private $args = array();
    public $hidden_property;
    public $hidden_values = array();


    function __construct($type, $name, $default_value = "", $label = "", $description = "", $options = array(), $args = array(), $hidden_property = "", $hidden_values = array())
    {
        global $search_and_go_elated_Framework;
        $this->type = $type;
        $this->name = $name;
        $this->default_value = $default_value;
        $this->label = $label;
        $this->description = $description;
        $this->options = $options;
        $this->args = $args;
        $this->hidden_property = $hidden_property;
        $this->hidden_values = $hidden_values;
        $search_and_go_elated_Framework->eltdOptions->addOption($this->name, $this->default_value, $type);
    }

    public function render($factory)
    {
        $hidden = false;
        if (!empty($this->hidden_property)) {
            foreach ($this->hidden_values as $value) {
                if (search_and_go_elated_option_get_value($this->hidden_property) == $value)
                    $hidden = true;

            }
        }
        $factory->render($this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden);
    }
}

/*
   Class: SearchAndGoMetaField
   A class that initializes Elated Meta Field
*/

class SearchAndGoMetaField implements iSearchAndGoRender
{
    private $type;
    private $name;
    private $default_value;
    private $label;
    private $description;
    private $options = array();
    private $args = array();
    public $hidden_property;
    public $hidden_values = array();


    function __construct($type, $name, $default_value = "", $label = "", $description = "", $options = array(), $args = array(), $hidden_property = "", $hidden_values = array())
    {
        global $search_and_go_elated_Framework;
        $this->type = $type;
        $this->name = $name;
        $this->default_value = $default_value;
        $this->label = $label;
        $this->description = $description;
        $this->options = $options;
        $this->args = $args;
        $this->hidden_property = $hidden_property;
        $this->hidden_values = $hidden_values;
        $search_and_go_elated_Framework->eltdMetaBoxes->addOption($this->name, $this->default_value);
    }

    public function render($factory)
    {
        $hidden = false;
        if (!empty($this->hidden_property)) {
            foreach ($this->hidden_values as $value) {
                if (search_and_go_elated_option_get_value($this->hidden_property) == $value)
                    $hidden = true;

            }
        }
        $factory->render($this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden);
    }
}

abstract class SearchAndGoFieldType
{

    abstract public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false);

}

class SearchAndGoFieldText extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        $col_width = 12;
        if (isset($args["col_width"])) {
            $col_width = $args["col_width"];
        }

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

        $class = '';

        if (!empty($repeat)) {
            $id = $name . '-' . $repeat['index'];
            $name .= '[]';
            $value = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $id = $name;
            $value = search_and_go_elated_option_get_value($name);
        }

        ?>

        <div class="eltd-page-form-section  <?php echo esc_attr($class); ?>"
             id="eltd_<?php echo esc_attr($id); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-<?php echo esc_attr($col_width); ?>">
                            <?php if ($suffix) : ?>
                            <div class="input-group">
                                <?php endif; ?>
                                <input type="text"
                                       class="form-control eltd-input eltd-form-element"
                                       name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(htmlspecialchars($value)); ?>"
                                       placeholder=""/>
                                <?php if ($suffix) : ?>
                                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                                <?php endif; ?>
                                <?php if ($suffix) : ?>
                            </div>
                        <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldTextSimple extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;
        $class = '';

        if (!empty($repeat)) {
            $id = str_replace(array('[',']'),'',$name) . '-' .rand();
            $name .= '[]';
            $value = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $id = $name;
            $value = search_and_go_elated_option_get_value($name);
        }

        ?>


        <div class="col-lg-3 <?php echo esc_attr($class); ?>"
             id="eltd_<?php echo esc_attr($id); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <em class="eltd-field-description"><?php echo esc_html($label); ?></em>
            <?php if ($suffix) : ?>
            <div class="input-group">
                <?php endif; ?>
                <input type="text"
                       class="form-control eltd-input eltd-form-element"
                       name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars($value)); ?>"
                       placeholder=""/>
                <?php if ($suffix) : ?>
                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                <?php endif; ?>
                <?php if ($suffix) : ?>
            </div>
        <?php endif; ?>
        </div>
        <?php
    }

}

class SearchAndGoFieldTextArea extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        $class = '';

        if (!empty($repeat)) {
            $name .= '[]';
            $value = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $value = search_and_go_elated_option_get_value($name);
        }
        ?>

        <div class="eltd-page-form-section">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 <?php echo esc_attr($class); ?>">
							<textarea class="form-control eltd-form-element" name="<?php echo esc_attr($name); ?>" rows="5"><?php echo esc_html(htmlspecialchars($value)); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldTextAreaSimple extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        $class = '';

        if (!empty($repeat)) {
            $name .= '[]';
            $value = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $value = search_and_go_elated_option_get_value($name);
        }

        ?>

        <div class="col-lg-3 <?php echo esc_attr($class); ?>">
            <em class="eltd-field-description"><?php echo esc_html($label); ?></em>
			<textarea class="form-control eltd-form-element" name="<?php echo esc_attr($name); ?>" rows="5"><?php echo esc_html($value); ?></textarea>
        </div>
        <?php

    }

}

class SearchAndGoFieldColor extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {

        $class = '';

        if (!empty($repeat)) {
            $id = $name . '-' . $repeat['index'];
            $name .= '[]';
            $value = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $id = $name;
            $value = search_and_go_elated_option_get_value($name);
        }
        ?>

        <div class="eltd-page-form-section <?php echo esc_attr($class); ?>" id="eltd_<?php echo esc_attr($id); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="<?php echo esc_attr($name); ?>"
                                   value="<?php echo esc_attr($value); ?>"
                                   class="my-color-field"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldColorSimple extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        global $search_and_go_elated_options;
        $class = '';

        if (!empty($repeat)) {
            $id = $name . '-' . $repeat['index'];
            $name .= '[]';
            $value = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $id = $name;
            $value = search_and_go_elated_option_get_value($name);
        }
        ?>

        <div class="col-lg-3 <?php echo esc_attr($class); ?>"
             id="eltd_<?php echo esc_attr($id); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <em class="eltd-field-description"><?php echo esc_html($label); ?></em>
            <input type="text" name="<?php echo esc_attr($name); ?>"
                   value="<?php echo esc_attr($value); ?>" class="my-color-field"/>
        </div>
        <?php

    }

}

class SearchAndGoFieldImage extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        global $search_and_go_elated_options;
        $class = '';

        if (!empty($repeat)) {
            $name .= '[]';
            $value = $repeat['value'];
            $class = 'eltd-repeater-field';
            $has_value = empty($value)?false:true;
        } else {
            $value = search_and_go_elated_option_get_value($name);
            $has_value = search_and_go_elated_option_has_value($name);
        }

        ?>

        <div class="eltd-page-form-section">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 <?php echo esc_attr($class); ?>">
                            <div class="eltd-media-uploader">
                                <div<?php if (!$has_value) { ?> style="display: none"<?php } ?>
                                    class="eltd-media-image-holder">
                                    <img src="<?php if ($has_value) {
                                        echo esc_url(search_and_go_elated_get_attachment_thumb_url($value));
                                    } ?>" alt=""
                                         class="eltd-media-image img-thumbnail"/>
                                </div>
                                <div style="display: none"
                                     class="eltd-media-meta-fields">
                                    <input type="hidden" class="eltd-media-upload-url"
                                           name="<?php echo esc_attr($name); ?>"
                                           value="<?php echo esc_attr($value); ?>"/>
                                </div>
                                <a class="eltd-media-upload-btn btn btn-sm btn-primary"
                                   href="javascript:void(0)"
                                   data-frame-title="<?php esc_html_e('Select Image', 'search-and-go'); ?>"
                                   data-frame-button-text="<?php esc_html_e('Select Image', 'search-and-go'); ?>"><?php esc_html_e('Upload', 'search-and-go'); ?></a>
                                <a style="display: none;" href="javascript: void(0)"
                                   class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'search-and-go'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldImageSimple extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        $class = '';

        if (!empty($repeat)) {
            $id = $name . '-' . $repeat['index'];
            $name .= '[]';
            $value = $repeat['value'];
            $class = 'eltd-repeater-field';
            $has_value = empty($value)?false:true;
        } else {
            $id = $name;
            $value = search_and_go_elated_option_get_value($name);
            $has_value = search_and_go_elated_option_has_value($name);
        }
        ?>


        <div class="col-lg-3 <?php echo esc_attr($class); ?>"
             id="eltd_<?php echo esc_attr($id); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <em class="eltd-field-description"><?php echo esc_html($label); ?></em>

            <div class="eltd-media-uploader">
                <div<?php if (!$has_value) { ?> style="display: none"<?php } ?>
                    class="eltd-media-image-holder">
                    <img src="<?php if ($has_value) {
                        echo esc_url(search_and_go_elated_get_attachment_thumb_url($value));
                    } ?>" alt=""
                         class="eltd-media-image img-thumbnail"/>
                </div>
                <div style="display: none"
                     class="eltd-media-meta-fields">
                    <input type="hidden" class="eltd-media-upload-url"
                           name="<?php echo esc_attr($name); ?>"
                           value="<?php echo esc_attr($value); ?>"/>
                </div>
                <a class="eltd-media-upload-btn btn btn-sm btn-primary"
                   href="javascript:void(0)"
                   data-frame-title="<?php esc_html_e('Select Image', 'search-and-go'); ?>"
                   data-frame-button-text="<?php esc_html_e('Select Image', 'search-and-go'); ?>"><?php esc_html_e('Upload', 'search-and-go'); ?></a>
                <a style="display: none;" href="javascript: void(0)"
                   class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'search-and-go'); ?></a>
            </div>
        </div>
        <?php

    }

}

class SearchAndGoFieldFont extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        global $search_and_go_elated_options;
        global $search_and_go_elated_fonts_array;

        $class = '';

        if (!empty($repeat)) {
            $name .= '[]';
            $value = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $value = search_and_go_elated_option_get_value($name);
        }

        ?>

        <div class="eltd-page-form-section">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 <?php echo esc_attr($class); ?>">
                            <select class="form-control eltd-form-element"
                                    name="<?php echo esc_attr($name); ?>">
                                <option value="-1">Default</option>
                                <?php foreach ($search_and_go_elated_fonts_array as $fontArray) { ?>
                                    <option <?php if ($value == str_replace(' ', '+', $fontArray["family"])) {
                                        echo "selected='selected'";
                                    } ?>
                                        value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldFontSimple extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        global $search_and_go_elated_options;
        global $search_and_go_elated_fonts_array;

        $class = '';

        if (!empty($repeat)) {
            $name .= '[]';
            $value = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $value = search_and_go_elated_option_get_value($name);
        }
        ?>


        <div class="col-lg-3 <?php echo esc_attr($class); ?>">
            <em class="eltd-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control eltd-form-element"
                    name="<?php echo esc_attr($name); ?>">
                <option value="-1">Default</option>
                <?php foreach ($search_and_go_elated_fonts_array as $fontArray) { ?>
                    <option <?php if ($value == str_replace(' ', '+', $fontArray["family"])) {
                        echo "selected='selected'";
                    } ?>
                        value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
                <?php } ?>
            </select>
        </div>
        <?php

    }

}

class SearchAndGoFieldSelect extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        global $search_and_go_elated_options;
        $class = '';

        if (!empty($repeat)) {
            $id = $name . '-' . $repeat['index'];
            $name .= '[]';
            $rvalue = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $id = $name;
            $rvalue = search_and_go_elated_option_get_value($name);
        }

        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $show = array();
        if (isset($args["show"]))
            $show = $args["show"];
        $hide = array();
        if (isset($args["hide"]))
            $hide = $args["hide"];
        ?>

        <div class="eltd-page-form-section <?php echo esc_attr($class); ?>"
             id="eltd_<?php echo esc_attr($id); ?>" <?php if ($hidden) { ?> style="display: none"<?php } ?>>


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <select class="form-control eltd-form-element<?php if ($dependence) {
                                echo " dependence";
                            } ?>"
                                <?php foreach ($show as $key => $value) { ?>
                                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                <?php foreach ($hide as $key => $value) { ?>
                                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                    name="<?php echo esc_attr($name); ?>">
                                <?php foreach ($options as $key => $value) {
                                    if ($key == "-1") $key = ""; ?>
                                    <option <?php if ($rvalue == $key) {
                                        echo "selected='selected'";
                                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldSelectBlank extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        global $search_and_go_elated_options;
        $class = '';

        if (!empty($repeat)) {
            $name .= '[]';
            $rvalue = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $rvalue = search_and_go_elated_option_get_value($name);
        }


        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $show = array();
        if (isset($args["show"]))
            $show = $args["show"];
        $hide = array();
        if (isset($args["hide"]))
            $hide = $args["hide"];
        ?>

        <div class="eltd-page-form-section"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content <?php echo esc_attr($class); ?>">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <select class="form-control eltd-form-element<?php if ($dependence) {
                                echo " dependence";
                            } ?>"
                                <?php foreach ($show as $key => $value) { ?>
                                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                <?php foreach ($hide as $key => $value) { ?>
                                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                    name="<?php echo esc_attr($name); ?>">
                                <option <?php if ($rvalue == "") {
                                    echo "selected='selected'";
                                } ?> value=""></option>
                                <?php foreach ($options as $key => $value) {
                                    if ($key == "-1") $key = ""; ?>
                                    <option <?php if ($rvalue == $key) {
                                        echo "selected='selected'";
                                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldSelectSimple extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        global $search_and_go_elated_options;

        if (!empty($repeat)) {
            $name .= '[]';
            $rvalue = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $rvalue = search_and_go_elated_option_get_value($name);
        }

        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $show = array();
        if (isset($args["show"]))
            $show = $args["show"];
        $hide = array();
        if (isset($args["hide"]))
            $hide = $args["hide"];
        ?>


        <div class="col-lg-3 <?php echo esc_attr($class); ?>">
            <em class="eltd-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control eltd-form-element<?php if ($dependence) {
                echo " dependence";
            } ?>"
                <?php foreach ($show as $key => $value) { ?>
                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach ($hide as $key => $value) { ?>
                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if ($rvalue == "") {
                    echo "selected='selected'";
                } ?> value=""></option>
                <?php foreach ($options as $key => $value) {
                    if ($key == "-1") $key = ""; ?>
                    <option <?php if ($rvalue == $key) {
                        echo "selected='selected'";
                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
        </div>
        <?php

    }

}

class SearchAndGoFieldSelectBlankSimple extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        global $search_and_go_elated_options;

        $class = '';
        if (!empty($repeat)) {
            $name .= '[]';
            $rvalue = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $rvalue = search_and_go_elated_option_get_value($name);
        }

        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $show = array();
        if (isset($args["show"]))
            $show = $args["show"];
        $hide = array();
        if (isset($args["hide"]))
            $hide = $args["hide"];
        ?>


        <div class="col-lg-3 <?php echo esc_attr($class); ?>">
            <em class="eltd-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control eltd-form-element<?php if ($dependence) {
                echo " dependence";
            } ?>"
                <?php foreach ($show as $key => $value) { ?>
                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach ($hide as $key => $value) { ?>
                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if ($rvalue == "") {
                    echo "selected='selected'";
                } ?> value=""></option>
                <?php foreach ($options as $key => $value) {
                    if ($key == "-1") $key = ""; ?>
                    <option <?php if ($rvalue == $key) {
                        echo "selected='selected'";
                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
        </div>
        <?php

    }

}

class SearchAndGoFieldYesNo extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        global $search_and_go_elated_options;

        $class = '';

        if (!empty($repeat)) {
            $id = $name . '-' . $repeat['index'];
            $name .= '[]';
            $rvalue = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $id = $name;
            $rvalue = search_and_go_elated_option_get_value($name);
        }


        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($id); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 <?php echo esc_attr($class); ?>">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if ($rvalue == "yes") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Yes', 'search-and-go') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if ($rvalue == "no") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('No', 'search-and-go') ?></span></label>
                                <input type="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_yesno"
                                       value="yes"<?php if ($rvalue == "yes") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr($rvalue); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }
}

class SearchAndGoFieldYesNoSimple extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat =  array())
    {
        global $search_and_go_elated_options;

        $class = '';

        if (!empty($repeat)) {
            $name .= '[]';
            $rvalue = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $rvalue = search_and_go_elated_option_get_value($name);
        }

        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="col-lg-3 <?php echo esc_attr($class); ?>">
            <em class="eltd-field-description"><?php echo esc_html($label); ?></em>

            <p class="field switch">
                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                       class="cb-enable<?php if ($rvalue == "yes") {
                           echo " selected";
                       } ?><?php if ($dependence) {
                           echo " dependence";
                       } ?>"><span><?php esc_html_e('Yes', 'search-and-go') ?></span></label>
                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                       class="cb-disable<?php if ($rvalue == "no") {
                           echo " selected";
                       } ?><?php if ($dependence) {
                           echo " dependence";
                       } ?>"><span><?php esc_html_e('No', 'search-and-go') ?></span></label>
                <input type="checkbox" class="checkbox"
                       name="<?php echo esc_attr($name); ?>_yesno"
                       value="yes"<?php if ($rvalue == "yes") {
                    echo " selected";
                } ?>/>
                <input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr($name); ?>"
                       value="<?php echo esc_attr($rvalue); ?>"/>
            </p>
        </div>
        <?php

    }
}

class SearchAndGoFieldOnOff extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        global $search_and_go_elated_options;
        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($name); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if (search_and_go_elated_option_get_value($name) == "on") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('On', 'search-and-go') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if (search_and_go_elated_option_get_value($name) == "off") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Off', 'search-and-go') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_onoff"
                                       value="on"<?php if (search_and_go_elated_option_get_value($name) == "on") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_onoff" name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldPortfolioFollow extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        global $search_and_go_elated_options;
        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($name); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if (search_and_go_elated_option_get_value($name) == "portfolio_single_follow") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Yes', 'search-and-go') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if (search_and_go_elated_option_get_value($name) == "portfolio_single_no_follow") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('No', 'search-and-go') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_portfoliofollow"
                                       value="portfolio_single_follow"<?php if (search_and_go_elated_option_get_value($name) == "portfolio_single_follow") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_portfoliofollow"
                                       name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldZeroOne extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($name); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if (search_and_go_elated_option_get_value($name) == "1") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Yes', 'search-and-go') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if (search_and_go_elated_option_get_value($name) == "0") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('No', 'search-and-go') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_zeroone"
                                       value="1"<?php if (search_and_go_elated_option_get_value($name) == "1") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_zeroone"
                                       name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldImageVideo extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        global $search_and_go_elated_options;
        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($name); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch switch-type">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if (search_and_go_elated_option_get_value($name) == "image") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Image', 'search-and-go') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if (search_and_go_elated_option_get_value($name) == "video") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Video', 'search-and-go') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_imagevideo"
                                       value="image"<?php if (search_and_go_elated_option_get_value($name) == "image") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_imagevideo"
                                       name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldYesEmpty extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        global $search_and_go_elated_options;
        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($name); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if (search_and_go_elated_option_get_value($name) == "yes") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Yes', 'search-and-go') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if (search_and_go_elated_option_get_value($name) == "") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('No', 'search-and-go') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_yesempty"
                                       value="yes"<?php if (search_and_go_elated_option_get_value($name) == "yes") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_yesempty"
                                       name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldFlagPage extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        global $search_and_go_elated_options;
        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($name); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if (search_and_go_elated_option_get_value($name) == "page") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Yes', 'search-and-go') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if (search_and_go_elated_option_get_value($name) == "") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('No', 'search-and-go') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_flagpage"
                                       value="page"<?php if (search_and_go_elated_option_get_value($name) == "page") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_flagpage"
                                       name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldFlagPost extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {

        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($name); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if (search_and_go_elated_option_get_value($name) == "post") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Yes', 'search-and-go') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if (search_and_go_elated_option_get_value($name) == "") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('No', 'search-and-go') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_flagpost"
                                       value="post"<?php if (search_and_go_elated_option_get_value($name) == "post") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_flagpost"
                                       name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldFlagMedia extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        global $search_and_go_elated_options;
        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($name); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if (search_and_go_elated_option_get_value($name) == "attachment") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Yes', 'search-and-go') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if (search_and_go_elated_option_get_value($name) == "") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('No', 'search-and-go') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_flagmedia"
                                       value="attachment"<?php if (search_and_go_elated_option_get_value($name) == "attachment") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_flagmedia"
                                       name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldFlagPortfolio extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        global $search_and_go_elated_options;
        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($name); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if (search_and_go_elated_option_get_value($name) == "portfolio_page") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Yes', 'search-and-go') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if (search_and_go_elated_option_get_value($name) == "") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('No', 'search-and-go') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_flagportfolio"
                                       value="portfolio_page"<?php if (search_and_go_elated_option_get_value($name) == "portfolio_page") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_flagportfolio"
                                       name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldFlagProduct extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        global $search_and_go_elated_options;
        $dependence = false;
        if (isset($args["dependence"]))
            $dependence = true;
        $dependence_hide_on_yes = "";
        if (isset($args["dependence_hide_on_yes"]))
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        $dependence_show_on_yes = "";
        if (isset($args["dependence_show_on_yes"]))
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($name); ?>">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->


            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if (search_and_go_elated_option_get_value($name) == "product") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Yes', 'search-and-go') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if (search_and_go_elated_option_get_value($name) == "") {
                                           echo " selected";
                                       } ?><?php if ($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('No', 'search-and-go') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_flagproduct"
                                       value="product"<?php if (search_and_go_elated_option_get_value($name) == "product") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_flagproduct"
                                       name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldRange extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        $range_min = 0;
        $range_max = 1;
        $range_step = 0.01;
        $range_decimals = 2;
        if (isset($args["range_min"]))
            $range_min = $args["range_min"];
        if (isset($args["range_max"]))
            $range_max = $args["range_max"];
        if (isset($args["range_step"]))
            $range_step = $args["range_step"];
        if (isset($args["range_decimals"]))
            $range_decimals = $args["range_decimals"];
        ?>

        <div class="eltd-page-form-section">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="eltd-slider-range-wrapper">
                                <div class="form-inline">
                                    <input type="text"
                                           class="form-control eltd-form-element eltd-form-element-xsmall pull-left eltd-slider-range-value"
                                           name="<?php echo esc_attr($name); ?>"
                                           value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>

                                    <div class="eltd-slider-range small"
                                         data-step="<?php echo esc_attr($range_step); ?>"
                                         data-min="<?php echo esc_attr($range_min); ?>"
                                         data-max="<?php echo esc_attr($range_max); ?>"
                                         data-decimals="<?php echo esc_attr($range_decimals); ?>"
                                         data-start="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}

class SearchAndGoFieldRangeSimple extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        ?>

        <div class="col-lg-3"
             id="eltd_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <div class="eltd-slider-range-wrapper">
                <div class="form-inline">
                    <em class="eltd-field-description"><?php echo esc_html($label); ?></em>
                    <input type="text"
                           class="form-control eltd-form-element eltd-form-element-xxsmall pull-left eltd-slider-range-value"
                           name="<?php echo esc_attr($name); ?>"
                           value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"/>

                    <div class="eltd-slider-range xsmall"
                         data-step="0.01" data-max="1"
                         data-start="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"></div>
                </div>

            </div>
        </div>
        <?php

    }

}

class SearchAndGoFieldRadio extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {

        $default_value = isset($args['default_value'])?$args['default_value']:'';
        $value = isset($args['value'])?$args['value']:'';
        $checked = $default_value == $value ? 'checked':'';
        ?>
        <div class="col-lg-3 eltd-repeater-field">
            <em class="eltd-field-description"><?php echo esc_html($label); ?></em>
        <?php
        $html = '<input type="radio" name="' . $name . '" value="' . $value . '" ' . $checked . ' />';
        echo wp_kses($html, array(
            'input' => array(
                'type' => true,
                'name' => true,
                'value' => true,
                'checked' => true
            )
        ));
        ?>
        </div>
        <?php
    }

}

class SearchAndGoFieldRadioGroup extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        $dependence = isset($args["dependence"]) && $args["dependence"] ? true : false;
        $show = !empty($args["show"]) ? $args["show"] : array();
        $hide = !empty($args["hide"]) ? $args["hide"] : array();

        $use_images = isset($args["use_images"]) && $args["use_images"] ? true : false;
        $hide_labels = isset($args["hide_labels"]) && $args["hide_labels"] ? true : false;
        $hide_radios = $use_images ? 'display: none' : '';
        $checked_value = search_and_go_elated_option_get_value($name);
        ?>

        <div class="eltd-page-form-section"
             id="eltd_<?php echo esc_attr($name); ?>" <?php if ($hidden) { ?> style="display: none"<?php } ?>>

            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if (is_array($options) && count($options)) { ?>
                                <div class="eltd-radio-group-holder <?php if ($use_images) echo "with-images"; ?>">
                                    <?php foreach ($options as $key => $atts) {
                                        $selected = false;
                                        if ($checked_value == $key) {
                                            $selected = true;
                                        }

                                        $show_val = "";
                                        $hide_val = "";
                                        if ($dependence) {
                                            if (array_key_exists($key, $show)) {
                                                $show_val = $show[$key];
                                            }

                                            if (array_key_exists($key, $hide)) {
                                                $hide_val = $hide[$key];
                                            }
                                        }
                                        ?>
                                        <label class="radio-inline">
                                            <input
                                                <?php echo search_and_go_elated_get_inline_attr($show_val, 'data-show'); ?>
                                                <?php echo search_and_go_elated_get_inline_attr($hide_val, 'data-hide'); ?>
                                                <?php if ($selected) echo "checked"; ?> <?php search_and_go_elated_inline_style($hide_radios); ?>
                                                type="radio"
                                                name="<?php echo esc_attr($name); ?>"
                                                value="<?php echo esc_attr($key); ?>"
                                                <?php if ($dependence) search_and_go_elated_class_attribute("dependence"); ?>> <?php if (!empty($atts["label"]) && !$hide_labels) echo esc_attr($atts["label"]); ?>

                                            <?php if ($use_images) { ?>
                                                <img
                                                    title="<?php if (!empty($atts["label"])) echo esc_attr($atts["label"]); ?>"
                                                    src="<?php echo esc_url($atts['image']); ?>"
                                                    alt="<?php echo esc_attr("$key image") ?>"/>
                                            <?php } ?>
                                        </label>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php
    }

}

class SearchAndGoFieldCheckBox extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        $checked = "";

        if ('1' == search_and_go_elated_option_get_value($name)){
            $checked = "checked";
        }
		$html = '<div class ="eltd-page-form-section" >';
		$html .= '<div class="eltd-section-content">';
		$html .= '<div class="container-fluid">';
		$html .= '<div class="row">';
		$html .= '<div class="col-lg-3">';
		$html .= '<input id="' . $name . '" class="eltd-single-checkbox-field" type="checkbox" name="' . $name . '" value="1" ' . $checked . ' />';
		$html .= '<label for="' . $name . '"> ' . $label . '</label><br />';
        $html .= '<input class="eltd-single-checkbox-field-hidden" type="hidden" name="' . $name . '" value="0"/>';
		$html .= '</div>'; //close clo-lg-3
		$html .= '</div>'; //close row
		$html .= '</div>'; //close container-fluid
		$html .= '</div>'; //close eltd-section-content
		$html .= '</div>'; //close eltd-page-form-section
            
        echo wp_kses($html, array(
            'input' => array(
                'type' => true,
                'id'    => true,
                'name' => true,
                'value' => true,
                'checked' => true,
                'class'   => true,
                'disabled' => true
            ),
			'div' => array(
				'class' => true
			),
            'br' => true,
            'label' => array(
                'for'=>true
            )
        ));

    }

}

class SearchAndGoFieldDate extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false)
    {
        $col_width = 2;
        if (isset($args["col_width"]))
            $col_width = $args["col_width"];
        ?>

        <div class="eltd-page-form-section"
             id="eltd_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-<?php echo esc_attr($col_width); ?>">
                            <input type="text"
                                   id="portfolio_date"
                                   class="datepicker form-control eltd-input eltd-form-element"
                                   name="<?php echo esc_attr($name); ?>"
                                   value="<?php echo esc_attr(search_and_go_elated_option_get_value($name)); ?>"
                                /></div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}


class SearchAndGoFieldFactory
{

    public function render($field_type, $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {


        switch (strtolower($field_type)) {

            case 'text':
                $field = new SearchAndGoFieldText();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'textsimple':
                $field = new SearchAndGoFieldTextSimple();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'textarea':
                $field = new SearchAndGoFieldTextArea();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'textareasimple':
                $field = new SearchAndGoFieldTextAreaSimple();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'color':
                $field = new SearchAndGoFieldColor();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'colorsimple':
                $field = new SearchAndGoFieldColorSimple();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'image':
                $field = new SearchAndGoFieldImage();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'imagesimple':
                $field = new SearchAndGoFieldImageSimple();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'font':
                $field = new SearchAndGoFieldFont();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'fontsimple':
                $field = new SearchAndGoFieldFontSimple();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'select':
                $field = new SearchAndGoFieldSelect();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'selectblank':
                $field = new SearchAndGoFieldSelectBlank();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'selectsimple':
                $field = new SearchAndGoFieldSelectSimple();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'selectblanksimple':
                $field = new SearchAndGoFieldSelectBlankSimple();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'yesno':
                $field = new SearchAndGoFieldYesNo();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'yesnosimple':
                $field = new SearchAndGoFieldYesNoSimple();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;

            case 'onoff':
                $field = new SearchAndGoFieldOnOff();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'portfoliofollow':
                $field = new SearchAndGoFieldPortfolioFollow();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'zeroone':
                $field = new SearchAndGoFieldZeroOne();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'imagevideo':
                $field = new SearchAndGoFieldImageVideo();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'yesempty':
                $field = new SearchAndGoFieldYesEmpty();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'flagpost':
                $field = new SearchAndGoFieldFlagPost();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'flagpage':
                $field = new SearchAndGoFieldFlagPage();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'flagmedia':
                $field = new SearchAndGoFieldFlagMedia();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'flagportfolio':
                $field = new SearchAndGoFieldFlagPortfolio();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'flagproduct':
                $field = new SearchAndGoFieldFlagProduct();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'range':
                $field = new SearchAndGoFieldRange();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'rangesimple':
                $field = new SearchAndGoFieldRangeSimple();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'radio':
                $field = new SearchAndGoFieldRadio();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'checkbox':
                $field = new SearchAndGoFieldCheckBox();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;

            case 'date':
                $field = new SearchAndGoFieldDate();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;
            case 'radiogroup':
                $field = new SearchAndGoFieldRadioGroup();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;
            case 'address':
                $field = new SearchAndGoFieldAddress();
                $field->render($name, $label, $description, $options, $args, $hidden);
                break;
            case 'packagedisabled':
                $field = new SearchAndGoFieldPackageDisabled();
                $field->render($name, $label, $description, $options, $args, $hidden, $repeat);
                break;
            default:
                break;

        }

    }

}

/*
   Class: SearchAndGoMultipleImages
   A class that initializes Elated Multiple Images
*/

class SearchAndGoMultipleImages implements iSearchAndGoRender
{
    private $name;
    private $label;
    private $description;


    function __construct($name, $label = "", $description = "")
    {
        global $search_and_go_elated_Framework;
        $this->name = $name;
        $this->label = $label;
        $this->description = $description;
        $search_and_go_elated_Framework->eltdMetaBoxes->addOption($this->name, "");
    }

    public function render($factory)
    {
        global $post;
        ?>

        <div class="eltd-page-form-section">


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($this->label); ?></h4>

                <p><?php echo esc_html($this->description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="eltd-gallery-images-holder clearfix">
                                <?php
                                $image_gallery_val = get_post_meta($post->ID, $this->name, true);
                                if ($image_gallery_val != '') $image_gallery_array = explode(',', $image_gallery_val);

                                if (isset($image_gallery_array) && count($image_gallery_array) != 0):

                                    foreach ($image_gallery_array as $gimg_id):

                                        $gimage_wp = wp_get_attachment_image_src($gimg_id, 'thumbnail', true);
                                        echo '<li class="eltd-gallery-image-holder"><img src="' . esc_url($gimage_wp[0]) . '"/></li>';

                                    endforeach;

                                endif;
                                ?>
                            </ul>
                            <input type="hidden" value="<?php echo esc_attr($image_gallery_val); ?>"
                                   id="<?php echo esc_attr($this->name) ?>" name="<?php echo esc_attr($this->name) ?>">

                            <div class="eltd-gallery-uploader">
                                <a class="eltd-gallery-upload-btn btn btn-sm btn-primary"
                                   href="javascript:void(0)"><?php esc_html_e('Upload', 'search-and-go'); ?></a>
                                <a class="eltd-gallery-clear-btn btn btn-sm btn-default pull-right"
                                   href="javascript:void(0)"><?php esc_html_e('Remove All', 'search-and-go'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }
}

/*
   Class: SearchAndGoImagesVideos
   A class that initializes Elated Images Videos
*/

class SearchAndGoImagesVideos implements iSearchAndGoRender
{
    private $label;
    private $description;


    function __construct($label = "", $description = "")
    {
        $this->label = $label;
        $this->description = $description;
    }

    public function render($factory)
    {
        global $post;
        ?>
        <div class="eltd_hidden_portfolio_images" style="display: none">
            <div class="eltd-page-form-section">


                <div class="eltd-field-desc">
                    <h4><?php echo esc_html($this->label); ?></h4>

                    <p><?php echo esc_html($this->description); ?></p>
                </div>
                <!-- close div.eltd-field-desc -->

                <div class="eltd-section-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-2">
                                <em class="eltd-field-description">Order Number</em>
                                <input type="text"
                                       class="form-control eltd-input eltd-form-element"
                                       id="portfolioimgordernumber_x"
                                       name="portfolioimgordernumber_x"
                                       placeholder=""/></div>
                            <div class="col-lg-10">
                                <em class="eltd-field-description">Image/Video title (only for gallery layout -
                                    Portfolio Style 6)</em>
                                <input type="text"
                                       class="form-control eltd-input eltd-form-element"
                                       id="portfoliotitle_x"
                                       name="portfoliotitle_x"
                                       placeholder=""/></div>
                        </div>
                        <div class="row next-row">
                            <div class="col-lg-12">
                                <em class="eltd-field-description">Image</em>

                                <div class="eltd-media-uploader">
                                    <div style="display: none"
                                         class="eltd-media-image-holder">
                                        <img src="" alt=""
                                             class="eltd-media-image img-thumbnail"/>
                                    </div>
                                    <div style="display: none"
                                         class="eltd-media-meta-fields">
                                        <input type="hidden" class="eltd-media-upload-url"
                                               name="portfolioimg_x"
                                               id="portfolioimg_x"/>
                                        <input type="hidden"
                                               class="eltd-media-upload-height"
                                               name="eltd_options_theme[media-upload][height]"
                                               value=""/>
                                        <input type="hidden"
                                               class="eltd-media-upload-width"
                                               name="eltd_options_theme[media-upload][width]"
                                               value=""/>
                                    </div>
                                    <a class="eltd-media-upload-btn btn btn-sm btn-primary"
                                       href="javascript:void(0)"
                                       data-frame-title="<?php esc_html_e('Select Image', 'search-and-go'); ?>"
                                       data-frame-button-text="<?php esc_html_e('Select Image', 'search-and-go'); ?>"><?php esc_html_e('Upload', 'search-and-go'); ?></a>
                                    <a style="display: none;" href="javascript: void(0)"
                                       class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'search-and-go'); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="row next-row">
                            <div class="col-lg-3">
                                <em class="eltd-field-description">Video type</em>
                                <select class="form-control eltd-form-element eltd-portfoliovideotype"
                                        name="portfoliovideotype_x" id="portfoliovideotype_x">
                                    <option value=""></option>
                                    <option value="youtube">Youtube</option>
                                    <option value="vimeo">Vimeo</option>
                                    <option value="self">Self hosted</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <em class="eltd-field-description">Video ID</em>
                                <input type="text"
                                       class="form-control eltd-input eltd-form-element"
                                       id="portfoliovideoid_x"
                                       name="portfoliovideoid_x"
                                       placeholder=""/></div>
                        </div>
                        <div class="row next-row">
                            <div class="col-lg-12">
                                <em class="eltd-field-description">Video image</em>

                                <div class="eltd-media-uploader">
                                    <div style="display: none"
                                         class="eltd-media-image-holder">
                                        <img src="" alt=""
                                             class="eltd-media-image img-thumbnail"/>
                                    </div>
                                    <div style="display: none"
                                         class="eltd-media-meta-fields">
                                        <input type="hidden" class="eltd-media-upload-url"
                                               name="portfoliovideoimage_x"
                                               id="portfoliovideoimage_x"/>
                                        <input type="hidden"
                                               class="eltd-media-upload-height"
                                               name="eltd_options_theme[media-upload][height]"
                                               value=""/>
                                        <input type="hidden"
                                               class="eltd-media-upload-width"
                                               name="eltd_options_theme[media-upload][width]"
                                               value=""/>
                                    </div>
                                    <a class="eltd-media-upload-btn btn btn-sm btn-primary"
                                       href="javascript:void(0)"
                                       data-frame-title="<?php esc_html_e('Select Image', 'search-and-go'); ?>"
                                       data-frame-button-text="<?php esc_html_e('Select Image', 'search-and-go'); ?>"><?php esc_html_e('Upload', 'search-and-go'); ?></a>
                                    <a style="display: none;" href="javascript: void(0)"
                                       class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'search-and-go'); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="row next-row">
                            <div class="col-lg-4">
                                <em class="eltd-field-description">Video webm</em>
                                <input type="text"
                                       class="form-control eltd-input eltd-form-element"
                                       id="portfoliovideowebm_x"
                                       name="portfoliovideowebm_x"
                                       placeholder=""/></div>
                            <div class="col-lg-4">
                                <em class="eltd-field-description">Video mp4</em>
                                <input type="text"
                                       class="form-control eltd-input eltd-form-element"
                                       id="portfoliovideomp4_x"
                                       name="portfoliovideomp4_x"
                                       placeholder=""/></div>
                            <div class="col-lg-4">
                                <em class="eltd-field-description">Video ogv</em>
                                <input type="text"
                                       class="form-control eltd-input eltd-form-element"
                                       id="portfoliovideoogv_x"
                                       name="portfoliovideoogv_x"
                                       placeholder=""/></div>
                        </div>
                        <div class="row next-row">
                            <div class="col-lg-12">
                                <a class="eltd_remove_image btn btn-sm btn-primary" href="/"
                                   onclick="javascript: return false;">Remove portfolio image/video</a>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- close div.eltd-section-content -->

            </div>
        </div>

        <?php
        $no = 1;
        $portfolio_images = get_post_meta($post->ID, 'eltd_portfolio_images', true);
        if (count($portfolio_images) > 1) {
            usort($portfolio_images, "search_and_go_elated_compare_portfolio_videos");
        }
        while (isset($portfolio_images[$no - 1])) {
            $portfolio_image = $portfolio_images[$no - 1];
            ?>
            <div class="eltd_portfolio_image" rel="<?php echo esc_attr($no); ?>" style="display: block;">

                <div class="eltd-page-form-section">


                    <div class="eltd-field-desc">
                        <h4><?php echo esc_html($this->label); ?></h4>

                        <p><?php echo esc_html($this->description); ?></p>
                    </div>
                    <!-- close div.eltd-field-desc -->

                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-2">
                                    <em class="eltd-field-description">Order Number</em>
                                    <input type="text"
                                           class="form-control eltd-input eltd-form-element"
                                           id="portfolioimgordernumber_<?php echo esc_attr($no); ?>"
                                           name="portfolioimgordernumber[]"
                                           value="<?php echo isset($portfolio_image['portfolioimgordernumber']) ? esc_attr(stripslashes($portfolio_image['portfolioimgordernumber'])) : ""; ?>"
                                           placeholder=""/></div>
                                <div class="col-lg-10">
                                    <em class="eltd-field-description">Image/Video title (only for gallery layout -
                                        Portfolio Style 6)</em>
                                    <input type="text"
                                           class="form-control eltd-input eltd-form-element"
                                           id="portfoliotitle_<?php echo esc_attr($no); ?>"
                                           name="portfoliotitle[]"
                                           value="<?php echo isset($portfolio_image['portfoliotitle']) ? esc_attr(stripslashes($portfolio_image['portfoliotitle'])) : ""; ?>"
                                           placeholder=""/></div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-12">
                                    <em class="eltd-field-description">Image</em>

                                    <div class="eltd-media-uploader">
                                        <div<?php if (stripslashes($portfolio_image['portfolioimg']) == false) { ?> style="display: none"<?php } ?>
                                            class="eltd-media-image-holder">
                                            <img
                                                src="<?php if (stripslashes($portfolio_image['portfolioimg']) == true) {
                                                    echo esc_url(search_and_go_elated_generate_filename(stripslashes($portfolio_image['portfolioimg']), get_option('thumbnail' . '_size_w'), get_option('thumbnail' . '_size_h')));
                                                } ?>" alt=""
                                                class="eltd-media-image img-thumbnail"/>
                                        </div>
                                        <div style="display: none"
                                             class="eltd-media-meta-fields">
                                            <input type="hidden" class="eltd-media-upload-url"
                                                   name="portfolioimg[]"
                                                   id="portfolioimg_<?php echo esc_attr($no); ?>"
                                                   value="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>"/>
                                            <input type="hidden"
                                                   class="eltd-media-upload-height"
                                                   name="eltd_options_theme[media-upload][height]"
                                                   value=""/>
                                            <input type="hidden"
                                                   class="eltd-media-upload-width"
                                                   name="eltd_options_theme[media-upload][width]"
                                                   value=""/>
                                        </div>
                                        <a class="eltd-media-upload-btn btn btn-sm btn-primary"
                                           href="javascript:void(0)"
                                           data-frame-title="<?php esc_html_e('Select Image', 'search-and-go'); ?>"
                                           data-frame-button-text="<?php esc_html_e('Select Image', 'search-and-go'); ?>"><?php esc_html_e('Upload', 'search-and-go'); ?></a>
                                        <a style="display: none;" href="javascript: void(0)"
                                           class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'search-and-go'); ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-3">
                                    <em class="eltd-field-description">Video type</em>
                                    <select class="form-control eltd-form-element eltd-portfoliovideotype"
                                            name="portfoliovideotype[]"
                                            id="portfoliovideotype_<?php echo esc_attr($no); ?>">
                                        <option value=""></option>
                                        <option <?php if ($portfolio_image['portfoliovideotype'] == "youtube") {
                                            echo "selected='selected'";
                                        } ?> value="youtube">Youtube
                                        </option>
                                        <option <?php if ($portfolio_image['portfoliovideotype'] == "vimeo") {
                                            echo "selected='selected'";
                                        } ?> value="vimeo">Vimeo
                                        </option>
                                        <option <?php if ($portfolio_image['portfoliovideotype'] == "self") {
                                            echo "selected='selected'";
                                        } ?> value="self">Self hosted
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <em class="eltd-field-description">Video ID</em>
                                    <input type="text"
                                           class="form-control eltd-input eltd-form-element"
                                           id="portfoliovideoid_<?php echo esc_attr($no); ?>"
                                           name="portfoliovideoid[]"
                                           value="<?php echo isset($portfolio_image['portfoliovideoid']) ? esc_attr(stripslashes($portfolio_image['portfoliovideoid'])) : ""; ?>"
                                           placeholder=""/></div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-12">
                                    <em class="eltd-field-description">Video image</em>

                                    <div class="eltd-media-uploader">
                                        <div<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == false) { ?> style="display: none"<?php } ?>
                                            class="eltd-media-image-holder">
                                            <img
                                                src="<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == true) {
                                                    echo esc_url(search_and_go_elated_generate_filename(stripslashes($portfolio_image['portfoliovideoimage']), get_option('thumbnail' . '_size_w'), get_option('thumbnail' . '_size_h')));
                                                } ?>" alt=""
                                                class="eltd-media-image img-thumbnail"/>
                                        </div>
                                        <div style="display: none"
                                             class="eltd-media-meta-fields">
                                            <input type="hidden" class="eltd-media-upload-url"
                                                   name="portfoliovideoimage[]"
                                                   id="portfoliovideoimage_<?php echo esc_attr($no); ?>"
                                                   value="<?php echo stripslashes($portfolio_image['portfoliovideoimage']); ?>"/>
                                            <input type="hidden"
                                                   class="eltd-media-upload-height"
                                                   name="eltd_options_theme[media-upload][height]"
                                                   value=""/>
                                            <input type="hidden"
                                                   class="eltd-media-upload-width"
                                                   name="eltd_options_theme[media-upload][width]"
                                                   value=""/>
                                        </div>
                                        <a class="eltd-media-upload-btn btn btn-sm btn-primary"
                                           href="javascript:void(0)"
                                           data-frame-title="<?php esc_html_e('Select Image', 'search-and-go'); ?>"
                                           data-frame-button-text="<?php esc_html_e('Select Image', 'search-and-go'); ?>"><?php esc_html_e('Upload', 'search-and-go'); ?></a>
                                        <a style="display: none;" href="javascript: void(0)"
                                           class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'search-and-go'); ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-4">
                                    <em class="eltd-field-description">Video webm</em>
                                    <input type="text"
                                           class="form-control eltd-input eltd-form-element"
                                           id="portfoliovideowebm_<?php echo esc_attr($no); ?>"
                                           name="portfoliovideowebm[]"
                                           value="<?php echo isset($portfolio_image['portfoliovideowebm']) ? esc_attr(stripslashes($portfolio_image['portfoliovideowebm'])) : ""; ?>"
                                           placeholder=""/></div>
                                <div class="col-lg-4">
                                    <em class="eltd-field-description">Video mp4</em>
                                    <input type="text"
                                           class="form-control eltd-input eltd-form-element"
                                           id="portfoliovideomp4_<?php echo esc_attr($no); ?>"
                                           name="portfoliovideomp4[]"
                                           value="<?php echo isset($portfolio_image['portfoliovideomp4']) ? esc_attr(stripslashes($portfolio_image['portfoliovideomp4'])) : ""; ?>"
                                           placeholder=""/></div>
                                <div class="col-lg-4">
                                    <em class="eltd-field-description">Video ogv</em>
                                    <input type="text"
                                           class="form-control eltd-input eltd-form-element"
                                           id="portfoliovideoogv_<?php echo esc_attr($no); ?>"
                                           name="portfoliovideoogv[]"
                                           value="<?php echo isset($portfolio_image['portfoliovideoogv']) ? esc_attr(stripslashes($portfolio_image['portfoliovideoogv'])) : ""; ?>"
                                           placeholder=""/></div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-12">
                                    <a class="eltd_remove_image btn btn-sm btn-primary" href="/"
                                       onclick="javascript: return false;">Remove portfolio image/video</a>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- close div.eltd-section-content -->

                </div>
            </div>
            <?php
            $no++;
        }
        ?>
        <br/>
        <a class="eltd_add_image btn btn-sm btn-primary" onclick="javascript: return false;" href="/">Add portfolio
            image/video</a>
        <?php

    }
}


/*
   Class: SearchAndGoImagesVideos
   A class that initializes Elated Images Videos
*/

class SearchAndGoImagesVideosFramework implements iSearchAndGoRender
{
    private $label;
    private $description;


    function __construct($label = "", $description = "")
    {
        $this->label = $label;
        $this->description = $description;
    }

    public function render($factory)
    {
        global $post;
        ?>

        <!--Image hidden start-->
        <div class="eltd-hidden-portfolio-images" style="display: none">
            <div class="eltd-portfolio-toggle-holder">
                <div class="eltd-portfolio-toggle eltd-toggle-desc">
                    <span class="number">1</span><span class="eltd-toggle-inner">Image - <em>(Order Number, Image
                            Title)</em></span>
                </div>
                <div class="eltd-portfolio-toggle eltd-portfolio-control">
                    <span class="toggle-portfolio-media"><i class="fa fa-caret-up"></i></span>
                    <a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="eltd-portfolio-toggle-content">
                <div class="eltd-page-form-section">
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="eltd-media-uploader">
                                        <em class="eltd-field-description">Image </em>

                                        <div style="display: none" class="eltd-media-image-holder">
                                            <img src="" alt="" class="eltd-media-image img-thumbnail">
                                        </div>
                                        <div class="eltd-media-meta-fields">
                                            <input type="hidden" class="eltd-media-upload-url" name="portfolioimg_x"
                                                   id="portfolioimg_x">
                                            <input type="hidden" class="eltd-media-upload-height"
                                                   name="eltd_options_theme[media-upload][height]" value="">
                                            <input type="hidden" class="eltd-media-upload-width"
                                                   name="eltd_options_theme[media-upload][width]" value="">
                                        </div>
                                        <a class="eltd-media-upload-btn btn btn-sm btn-primary"
                                           href="javascript:void(0)" data-frame-title="Select Image"
                                           data-frame-button-text="Select Image">Upload</a>
                                        <a style="display: none;" href="javascript: void(0)"
                                           class="eltd-media-remove-btn btn btn-default btn-sm">Remove</a>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <em class="eltd-field-description">Order Number</em>
                                    <input type="text" class="form-control eltd-input eltd-form-element"
                                           id="portfolioimgordernumber_x" name="portfolioimgordernumber_x"
                                           placeholder="">
                                </div>
                                <div class="col-lg-8">
                                    <em class="eltd-field-description">Image Title (works only for Gallery portfolio
                                        type selected) </em>
                                    <input type="text" class="form-control eltd-input eltd-form-element"
                                           id="portfoliotitle_x" name="portfoliotitle_x" placeholder="">
                                </div>
                            </div>
                            <input type="hidden" name="portfoliovideoimage_x" id="portfoliovideoimage_x">
                            <input type="hidden" name="portfoliovideotype_x" id="portfoliovideotype_x">
                            <input type="hidden" name="portfoliovideoid_x" id="portfoliovideoid_x">
                            <input type="hidden" name="portfoliovideowebm_x" id="portfoliovideowebm_x">
                            <input type="hidden" name="portfoliovideomp4_x" id="portfoliovideomp4_x">
                            <input type="hidden" name="portfoliovideoogv_x" id="portfoliovideoogv_x">
                            <input type="hidden" name="portfolioimgtype_x" id="portfolioimgtype_x" value="image">

                        </div>
                        <!-- close div.container-fluid -->
                    </div>
                    <!-- close div.eltd-section-content -->
                </div>
            </div>
        </div>
        <!--Image hidden End-->

        <!--Video Hidden Start-->
        <div class="eltd-hidden-portfolio-videos" style="display: none">
            <div class="eltd-portfolio-toggle-holder">
                <div class="eltd-portfolio-toggle eltd-toggle-desc">
                    <span class="number">2</span><span class="eltd-toggle-inner">Video - <em>(Order Number, Video
                            Title)</em></span>
                </div>
                <div class="eltd-portfolio-toggle eltd-portfolio-control">
                    <span class="toggle-portfolio-media"><i class="fa fa-caret-up"></i></span> <a href="#"
                                                                                                  class="remove-portfolio-media"><i
                            class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="eltd-portfolio-toggle-content">
                <div class="eltd-page-form-section">
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="eltd-media-uploader">
                                        <em class="eltd-field-description">Cover Video Image </em>

                                        <div style="display: none" class="eltd-media-image-holder">
                                            <img src="" alt="" class="eltd-media-image img-thumbnail">
                                        </div>
                                        <div style="display: none" class="eltd-media-meta-fields">
                                            <input type="hidden" class="eltd-media-upload-url"
                                                   name="portfoliovideoimage_x" id="portfoliovideoimage_x">
                                            <input type="hidden" class="eltd-media-upload-height"
                                                   name="eltd_options_theme[media-upload][height]" value="">
                                            <input type="hidden" class="eltd-media-upload-width"
                                                   name="eltd_options_theme[media-upload][width]" value="">
                                        </div>
                                        <a class="eltd-media-upload-btn btn btn-sm btn-primary"
                                           href="javascript:void(0)" data-frame-title="Select Image"
                                           data-frame-button-text="Select Image">Upload</a>
                                        <a style="display: none;" href="javascript: void(0)"
                                           class="eltd-media-remove-btn btn btn-default btn-sm">Remove</a>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <em class="eltd-field-description">Order Number</em>
                                            <input type="text" class="form-control eltd-input eltd-form-element"
                                                   id="portfolioimgordernumber_x" name="portfolioimgordernumber_x"
                                                   placeholder="">
                                        </div>
                                        <div class="col-lg-10">
                                            <em class="eltd-field-description">Video Title (works only for Gallery
                                                portfolio type selected)</em>
                                            <input type="text" class="form-control eltd-input eltd-form-element"
                                                   id="portfoliotitle_x" name="portfoliotitle_x" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row next-row">
                                        <div class="col-lg-2">
                                            <em class="eltd-field-description">Video type</em>
                                            <select class="form-control eltd-form-element eltd-portfoliovideotype"
                                                    name="portfoliovideotype_x" id="portfoliovideotype_x">
                                                <option value=""></option>
                                                <option value="youtube">Youtube</option>
                                                <option value="vimeo">Vimeo</option>
                                                <option value="self">Self hosted</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 eltd-video-id-holder">
                                            <em class="eltd-field-description" id="videoId">Video ID</em>
                                            <input type="text" class="form-control eltd-input eltd-form-element"
                                                   id="portfoliovideoid_x" name="portfoliovideoid_x" placeholder="">
                                        </div>
                                    </div>

                                    <div class="row next-row eltd-video-self-hosted-path-holder">
                                        <div class="col-lg-4">
                                            <em class="eltd-field-description">Video webm</em>
                                            <input type="text" class="form-control eltd-input eltd-form-element"
                                                   id="portfoliovideowebm_x" name="portfoliovideowebm_x" placeholder="">
                                        </div>
                                        <div class="col-lg-4">
                                            <em class="eltd-field-description">Video mp4</em>
                                            <input type="text" class="form-control eltd-input eltd-form-element"
                                                   id="portfoliovideomp4_x" name="portfoliovideomp4_x" placeholder="">
                                        </div>
                                        <div class="col-lg-4">
                                            <em class="eltd-field-description">Video ogv</em>
                                            <input type="text" class="form-control eltd-input eltd-form-element"
                                                   id="portfoliovideoogv_x" name="portfoliovideoogv_x" placeholder="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <input type="hidden" name="portfolioimg_x" id="portfolioimg_x">
                            <input type="hidden" name="portfolioimgtype_x" id="portfolioimgtype_x" value="video">
                        </div>
                        <!-- close div.container-fluid -->
                    </div>
                    <!-- close div.eltd-section-content -->
                </div>
            </div>
        </div>
        <!--Video Hidden End-->


        <?php
        $no = 1;
        $portfolio_images = get_post_meta($post->ID, 'eltd_portfolio_images', true);
        if (count($portfolio_images) > 1) {
            usort($portfolio_images, "search_and_go_elated_compare_portfolio_videos");
        }
        while (isset($portfolio_images[$no - 1])) {
            $portfolio_image = $portfolio_images[$no - 1];
            if (isset($portfolio_image['portfolioimgtype']))
                $portfolio_img_type = $portfolio_image['portfolioimgtype'];
            else {
                if (stripslashes($portfolio_image['portfolioimg']) == true)
                    $portfolio_img_type = "image";
                else
                    $portfolio_img_type = "video";
            }
            if ($portfolio_img_type == "image") {
                ?>

                <div class="eltd-portfolio-images eltd-portfolio-media" rel="<?php echo esc_attr($no); ?>">
                    <div class="eltd-portfolio-toggle-holder">
                        <div class="eltd-portfolio-toggle eltd-toggle-desc">
                            <span class="number"><?php echo esc_html($no); ?></span><span class="eltd-toggle-inner">Image - <em>(<?php echo stripslashes($portfolio_image['portfolioimgordernumber']); ?>
                                    , <?php echo stripslashes($portfolio_image['portfoliotitle']); ?>)</em></span>
                        </div>
                        <div class="eltd-portfolio-toggle eltd-portfolio-control">
                            <a href="#" class="toggle-portfolio-media"><i class="fa fa-caret-down"></i></a>
                            <a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="eltd-portfolio-toggle-content" style="display: none">
                        <div class="eltd-page-form-section">
                            <div class="eltd-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="eltd-media-uploader">
                                                <em class="eltd-field-description">Image </em>

                                                <div<?php if (stripslashes($portfolio_image['portfolioimg']) == false) { ?> style="display: none"<?php } ?>
                                                    class="eltd-media-image-holder">
                                                    <img
                                                        src="<?php if (stripslashes($portfolio_image['portfolioimg']) == true) {
                                                            echo esc_url(search_and_go_elated_generate_filename(stripslashes($portfolio_image['portfolioimg']), get_option('thumbnail' . '_size_w'), get_option('thumbnail' . '_size_h')));
                                                        } ?>" alt=""
                                                        class="eltd-media-image img-thumbnail"/>
                                                </div>
                                                <div style="display: none"
                                                     class="eltd-media-meta-fields">
                                                    <input type="hidden" class="eltd-media-upload-url"
                                                           name="portfolioimg[]"
                                                           id="portfolioimg_<?php echo esc_attr($no); ?>"
                                                           value="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>"/>
                                                    <input type="hidden"
                                                           class="eltd-media-upload-height"
                                                           name="eltd_options_theme[media-upload][height]"
                                                           value=""/>
                                                    <input type="hidden"
                                                           class="eltd-media-upload-width"
                                                           name="eltd_options_theme[media-upload][width]"
                                                           value=""/>
                                                </div>
                                                <a class="eltd-media-upload-btn btn btn-sm btn-primary"
                                                   href="javascript:void(0)"
                                                   data-frame-title="<?php esc_html_e('Select Image', 'search-and-go'); ?>"
                                                   data-frame-button-text="<?php esc_html_e('Select Image', 'search-and-go'); ?>"><?php esc_html_e('Upload', 'search-and-go'); ?></a>
                                                <a style="display: none;" href="javascript: void(0)"
                                                   class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'search-and-go'); ?></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <em class="eltd-field-description">Order Number</em>
                                            <input type="text" class="form-control eltd-input eltd-form-element"
                                                   id="portfolioimgordernumber_<?php echo esc_attr($no); ?>"
                                                   name="portfolioimgordernumber[]"
                                                   value="<?php echo isset($portfolio_image['portfolioimgordernumber']) ? esc_attr(stripslashes($portfolio_image['portfolioimgordernumber'])) : ""; ?>"
                                                   placeholder="">
                                        </div>
                                        <div class="col-lg-8">
                                            <em class="eltd-field-description">Image Title (works only for Gallery
                                                portfolio type selected) </em>
                                            <input type="text" class="form-control eltd-input eltd-form-element"
                                                   id="portfoliotitle_<?php echo esc_attr($no); ?>"
                                                   name="portfoliotitle[]"
                                                   value="<?php echo isset($portfolio_image['portfoliotitle']) ? esc_attr(stripslashes($portfolio_image['portfoliotitle'])) : ""; ?>"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <input type="hidden" id="portfoliovideoimage_<?php echo esc_attr($no); ?>"
                                           name="portfoliovideoimage[]">
                                    <input type="hidden" id="portfoliovideotype_<?php echo esc_attr($no); ?>"
                                           name="portfoliovideotype[]">
                                    <input type="hidden" id="portfoliovideoid_<?php echo esc_attr($no); ?>"
                                           name="portfoliovideoid[]">
                                    <input type="hidden" id="portfoliovideowebm_<?php echo esc_attr($no); ?>"
                                           name="portfoliovideowebm[]">
                                    <input type="hidden" id="portfoliovideomp4_<?php echo esc_attr($no); ?>"
                                           name="portfoliovideomp4[]">
                                    <input type="hidden" id="portfoliovideoogv_<?php echo esc_attr($no); ?>"
                                           name="portfoliovideoogv[]">
                                    <input type="hidden" id="portfolioimgtype_<?php echo esc_attr($no); ?>"
                                           name="portfolioimgtype[]" value="image">
                                </div>
                                <!-- close div.container-fluid -->
                            </div>
                            <!-- close div.eltd-section-content -->
                        </div>
                    </div>
                </div>

                <?php
            } else {
                ?>
                <div class="eltd-portfolio-videos eltd-portfolio-media" rel="<?php echo esc_attr($no); ?>">
                    <div class="eltd-portfolio-toggle-holder">
                        <div class="eltd-portfolio-toggle eltd-toggle-desc">
                            <span class="number"><?php echo esc_html($no); ?></span><span class="eltd-toggle-inner">Video - <em>(<?php echo stripslashes($portfolio_image['portfolioimgordernumber']); ?>
                                    , <?php echo stripslashes($portfolio_image['portfoliotitle']); ?></em>) </span>
                        </div>
                        <div class="eltd-portfolio-toggle eltd-portfolio-control">
                            <a href="#" class="toggle-portfolio-media"><i class="fa fa-caret-down"></i></a> <a href="#"
                                                                                                               class="remove-portfolio-media"><i
                                    class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="eltd-portfolio-toggle-content" style="display: none">
                        <div class="eltd-page-form-section">
                            <div class="eltd-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="eltd-media-uploader">
                                                <em class="eltd-field-description">Cover Video Image </em>

                                                <div<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == false) { ?> style="display: none"<?php } ?>
                                                    class="eltd-media-image-holder">
                                                    <img
                                                        src="<?php if (stripslashes($portfolio_image['portfoliovideoimage']) == true) {
                                                            echo esc_url(search_and_go_elated_generate_filename(stripslashes($portfolio_image['portfoliovideoimage']), get_option('thumbnail' . '_size_w'), get_option('thumbnail' . '_size_h')));
                                                        } ?>" alt=""
                                                        class="eltd-media-image img-thumbnail"/>
                                                </div>
                                                <div style="display: none"
                                                     class="eltd-media-meta-fields">
                                                    <input type="hidden" class="eltd-media-upload-url"
                                                           name="portfoliovideoimage[]"
                                                           id="portfoliovideoimage_<?php echo esc_attr($no); ?>"
                                                           value="<?php echo stripslashes($portfolio_image['portfoliovideoimage']); ?>"/>
                                                    <input type="hidden"
                                                           class="eltd-media-upload-height"
                                                           name="eltd_options_theme[media-upload][height]"
                                                           value=""/>
                                                    <input type="hidden"
                                                           class="eltd-media-upload-width"
                                                           name="eltd_options_theme[media-upload][width]"
                                                           value=""/>
                                                </div>
                                                <a class="eltd-media-upload-btn btn btn-sm btn-primary"
                                                   href="javascript:void(0)"
                                                   data-frame-title="<?php esc_html_e('Select Image', 'search-and-go'); ?>"
                                                   data-frame-button-text="<?php esc_html_e('Select Image', 'search-and-go'); ?>"><?php esc_html_e('Upload', 'search-and-go'); ?></a>
                                                <a style="display: none;" href="javascript: void(0)"
                                                   class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'search-and-go'); ?></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <em class="eltd-field-description">Order Number</em>
                                                    <input type="text"
                                                           class="form-control eltd-input eltd-form-element"
                                                           id="portfolioimgordernumber_<?php echo esc_attr($no); ?>"
                                                           name="portfolioimgordernumber[]"
                                                           value="<?php echo isset($portfolio_image['portfolioimgordernumber']) ? esc_attr(stripslashes($portfolio_image['portfolioimgordernumber'])) : ""; ?>"
                                                           placeholder="">
                                                </div>
                                                <div class="col-lg-10">
                                                    <em class="eltd-field-description">Video Title (works only for
                                                        Gallery portfolio type selected) </em>
                                                    <input type="text"
                                                           class="form-control eltd-input eltd-form-element"
                                                           id="portfoliotitle_<?php echo esc_attr($no); ?>"
                                                           name="portfoliotitle[]"
                                                           value="<?php echo isset($portfolio_image['portfoliotitle']) ? esc_attr(stripslashes($portfolio_image['portfoliotitle'])) : ""; ?>"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="row next-row">
                                                <div class="col-lg-2">
                                                    <em class="eltd-field-description">Video Type</em>
                                                    <select
                                                        class="form-control eltd-form-element eltd-portfoliovideotype"
                                                        name="portfoliovideotype[]"
                                                        id="portfoliovideotype_<?php echo esc_attr($no); ?>">
                                                        <option value=""></option>
                                                        <option <?php if ($portfolio_image['portfoliovideotype'] == "youtube") {
                                                            echo "selected='selected'";
                                                        } ?> value="youtube">Youtube
                                                        </option>
                                                        <option <?php if ($portfolio_image['portfoliovideotype'] == "vimeo") {
                                                            echo "selected='selected'";
                                                        } ?> value="vimeo">Vimeo
                                                        </option>
                                                        <option <?php if ($portfolio_image['portfoliovideotype'] == "self") {
                                                            echo "selected='selected'";
                                                        } ?> value="self">Self hosted
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 eltd-video-id-holder">
                                                    <em class="eltd-field-description">Video ID</em>
                                                    <input type="text"
                                                           class="form-control eltd-input eltd-form-element"
                                                           id="portfoliovideoid_<?php echo esc_attr($no); ?>"
                                                           name="portfoliovideoid[]"
                                                           value="<?php echo isset($portfolio_image['portfoliovideoid']) ? esc_attr(stripslashes($portfolio_image['portfoliovideoid'])) : ""; ?>"
                                                           placeholder=""/>
                                                </div>
                                            </div>

                                            <div class="row next-row eltd-video-self-hosted-path-holder">
                                                <div class="col-lg-4">
                                                    <em class="eltd-field-description">Video webm</em>
                                                    <input type="text"
                                                           class="form-control eltd-input eltd-form-element"
                                                           id="portfoliovideowebm_<?php echo esc_attr($no); ?>"
                                                           name="portfoliovideowebm[]"
                                                           value="<?php echo isset($portfolio_image['portfoliovideowebm']) ? esc_attr(stripslashes($portfolio_image['portfoliovideowebm'])) : ""; ?>"
                                                           placeholder=""/></div>
                                                <div class="col-lg-4">
                                                    <em class="eltd-field-description">Video mp4</em>
                                                    <input type="text"
                                                           class="form-control eltd-input eltd-form-element"
                                                           id="portfoliovideomp4_<?php echo esc_attr($no); ?>"
                                                           name="portfoliovideomp4[]"
                                                           value="<?php echo isset($portfolio_image['portfoliovideomp4']) ? esc_attr(stripslashes($portfolio_image['portfoliovideomp4'])) : ""; ?>"
                                                           placeholder=""/></div>
                                                <div class="col-lg-4">
                                                    <em class="eltd-field-description">Video ogv</em>
                                                    <input type="text"
                                                           class="form-control eltd-input eltd-form-element"
                                                           id="portfoliovideoogv_<?php echo esc_attr($no); ?>"
                                                           name="portfoliovideoogv[]"
                                                           value="<?php echo isset($portfolio_image['portfoliovideoogv']) ? esc_attr(stripslashes($portfolio_image['portfoliovideoogv'])) : ""; ?>"
                                                           placeholder=""/></div>
                                            </div>
                                        </div>

                                    </div>
                                    <input type="hidden" id="portfolioimg_<?php echo esc_attr($no); ?>"
                                           name="portfolioimg[]">
                                    <input type="hidden" id="portfolioimgtype_<?php echo esc_attr($no); ?>"
                                           name="portfolioimgtype[]" value="video">
                                </div>
                                <!-- close div.container-fluid -->
                            </div>
                            <!-- close div.eltd-section-content -->
                        </div>
                    </div>
                </div>
                <?php
            }
            $no++;
        }
        ?>

        <div class="eltd-portfolio-add">
            <a class="eltd-add-image btn btn-sm btn-primary" href="#"><i class="fa fa-camera"></i> Add Image</a>
            <a class="eltd-add-video btn btn-sm btn-primary" href="#"><i class="fa fa-video-camera"></i> Add Video</a>

            <a class="eltd-toggle-all-media btn btn-sm btn-default pull-right" href="#"> Expand All</a>
            <?php /* <a class="eltd-remove-last-row-media btn btn-sm btn-default pull-right" href="#"> Remove last row</a> */ ?>
        </div>
        <?php

    }
}

class SearchAndGoTwitterFramework implements iSearchAndGoRender
{
    public function render($factory)
    {
        $twitterApi = ElatedTwitterApi::getInstance();
        $message = '';

        if (!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier'])) {
            if (!empty($_GET['oauth_token'])) {
                update_option($twitterApi::AUTHORIZE_TOKEN_FIELD, $_GET['oauth_token']);
            }

            if (!empty($_GET['oauth_verifier'])) {
                update_option($twitterApi::AUTHORIZE_VERIFIER_FIELD, $_GET['oauth_verifier']);
            }

            $responseObj = $twitterApi->obtainAccessToken();
            if ($responseObj->status) {
                $message = esc_html__('You have successfully connected with your Twitter account. If you have any issues fetching data from Twitter try reconnecting.', 'search-and-go');
            } else {
                $message = $responseObj->message;
            }
        }

        $buttonText = $twitterApi->hasUserConnected() ? esc_html__('Re-connect with Twitter', 'search-and-go') : esc_html__('Connect with Twitter', 'search-and-go');
        ?>
        <?php if ($message !== '') { ?>
        <div class="alert alert-success" style="margin-top: 20px;">
            <span><?php echo esc_html($message); ?></span>
        </div>
    <?php } ?>
        <div class="eltd-page-form-section" id="eltd_enable_social_share">

            <div class="eltd-field-desc">
                <h4><?php esc_html_e('Connect with Twitter', 'search-and-go'); ?></h4>

                <p><?php esc_html_e('Connecting with Twitter will enable you to show your latest tweets on your site', 'search-and-go'); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a id="eltd-tw-request-token-btn" class="btn btn-primary"
                               href="#"><?php echo esc_html($buttonText); ?></a>
                            <input type="hidden" data-name="current-page-url"
                                   value="<?php echo esc_url($twitterApi->buildCurrentPageURI()); ?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
    <?php }
}

class SearchAndGoInstagramFramework implements iSearchAndGoRender
{
    public function render($factory)
    {
        $instagram_api = ElatedInstagramApi::getInstance();
        $message = '';

        //if code wasn't saved to database
        if (!get_option('eltd_instagram_code')) {
            //check if code parameter is set in URL. That means that user has connected with Instagram
            if (!empty($_GET['code'])) {
                //update code option so we can use it later
                $instagram_api->storeCode();
                $instagram_api->getAccessToken();
                $message = esc_html__('You have successfully connected with your Instagram account. If you have any issues fetching data from Instagram try reconnecting.', 'search-and-go');

            } else {
                $instagram_api->storeCodeRequestURI();
            }
        }

        $buttonText = $instagram_api->hasUserConnected() ? esc_html__('Re-connect with Instagram', 'edgt') : esc_html__('Connect with Instagram', 'search-and-go');

        ?>
        <?php if ($message !== '') { ?>
        <div class="alert alert-success" style="margin-top: 20px;">
            <span><?php echo esc_html($message); ?></span>
        </div>
    <?php } ?>
        <div class="eltd-page-form-section" id="edgtf_enable_social_share">

            <div class="eltd-field-desc">
                <h4><?php esc_html_e('Connect with Instagram', 'search-and-go'); ?></h4>

                <p><?php esc_html_e('Connecting with Instagram will enable you to show your latest photos on your site', 'search-and-go'); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary"
                               href="<?php echo esc_url($instagram_api->getAuthorizeUrl()); ?>"><?php echo esc_html($buttonText); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
    <?php }
}

/*
   Class: SearchAndGoImagesVideos
   A class that initializes Elated Images Videos
*/

class SearchAndGoOptionsFramework implements iSearchAndGoRender
{
    private $label;
    private $description;


    function __construct($label = "", $description = "")
    {
        $this->label = $label;
        $this->description = $description;
    }

    public function render($factory)
    {
        global $post;
        ?>

        <div class="eltd-portfolio-additional-item-holder" style="display: none">
            <div class="eltd-portfolio-toggle-holder">
                <div class="eltd-portfolio-toggle eltd-toggle-desc">
                    <span class="number">1</span><span class="eltd-toggle-inner">Additional Sidebar Item <em>(Order
                            Number, Item Title)</em></span>
                </div>
                <div class="eltd-portfolio-toggle eltd-portfolio-control">
                    <span class="toggle-portfolio-item"><i class="fa fa-caret-up"></i></span>
                    <a href="#" class="remove-portfolio-item"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="eltd-portfolio-toggle-content">
                <div class="eltd-page-form-section">
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-lg-2">
                                    <em class="eltd-field-description">Order Number</em>
                                    <input type="text" class="form-control eltd-input eltd-form-element"
                                           id="optionlabelordernumber_x" name="optionlabelordernumber_x" placeholder="">
                                </div>
                                <div class="col-lg-10">
                                    <em class="eltd-field-description">Item Title </em>
                                    <input type="text" class="form-control eltd-input eltd-form-element"
                                           id="optionLabel_x" name="optionLabel_x" placeholder="">
                                </div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-12">
                                    <em class="eltd-field-description">Item Text</em>
                                    <textarea class="form-control eltd-input eltd-form-element" id="optionValue_x"
                                              name="optionValue_x" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-12">
                                    <em class="eltd-field-description">Enter Full URL for Item Text Link</em>
                                    <input type="text" class="form-control eltd-input eltd-form-element"
                                           id="optionUrl_x" name="optionUrl_x" placeholder="">
                                </div>
                            </div>
                        </div>
                        <!-- close div.eltd-section-content -->
                    </div>
                    <!-- close div.container-fluid -->
                </div>
            </div>
        </div>
        <?php
        $no = 1;
        $portfolios = get_post_meta($post->ID, 'eltd_portfolios', true);
        if (count($portfolios) > 1) {
            usort($portfolios, "search_and_go_elated_compare_portfolio_options");
        }
        while (isset($portfolios[$no - 1])) {
            $portfolio = $portfolios[$no - 1];
            ?>
            <div class="eltd-portfolio-additional-item" rel="<?php echo esc_attr($no); ?>">
                <div class="eltd-portfolio-toggle-holder">
                    <div class="eltd-portfolio-toggle eltd-toggle-desc">
                        <span class="number"><?php echo esc_html($no); ?></span><span class="eltd-toggle-inner">Additional Sidebar Item - <em>(<?php echo stripslashes($portfolio['optionlabelordernumber']); ?>
                                , <?php echo stripslashes($portfolio['optionLabel']); ?>)</em></span>
                    </div>
                    <div class="eltd-portfolio-toggle eltd-portfolio-control">
                        <span class="toggle-portfolio-item"><i class="fa fa-caret-down"></i></span>
                        <a href="#" class="remove-portfolio-item"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="eltd-portfolio-toggle-content" style="display: none">
                    <div class="eltd-page-form-section">
                        <div class="eltd-section-content">
                            <div class="container-fluid">
                                <div class="row">

                                    <div class="col-lg-2">
                                        <em class="eltd-field-description">Order Number</em>
                                        <input type="text" class="form-control eltd-input eltd-form-element"
                                               id="optionlabelordernumber_<?php echo esc_attr($no); ?>"
                                               name="optionlabelordernumber[]"
                                               value="<?php echo isset($portfolio['optionlabelordernumber']) ? esc_attr(stripslashes($portfolio['optionlabelordernumber'])) : ""; ?>"
                                               placeholder="">
                                    </div>
                                    <div class="col-lg-10">
                                        <em class="eltd-field-description">Item Title </em>
                                        <input type="text" class="form-control eltd-input eltd-form-element"
                                               id="optionLabel_<?php echo esc_attr($no); ?>" name="optionLabel[]"
                                               value="<?php echo esc_attr(stripslashes($portfolio['optionLabel'])); ?>"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="row next-row">
                                    <div class="col-lg-12">
                                        <em class="eltd-field-description">Item Text</em>
                                        <textarea class="form-control eltd-input eltd-form-element"
                                                  id="optionValue_<?php echo esc_attr($no); ?>" name="optionValue[]"
                                                  placeholder=""><?php echo esc_attr(stripslashes($portfolio['optionValue'])); ?></textarea>
                                    </div>
                                </div>
                                <div class="row next-row">
                                    <div class="col-lg-12">
                                        <em class="eltd-field-description">Enter Full URL for Item Text Link</em>
                                        <input type="text" class="form-control eltd-input eltd-form-element"
                                               id="optionUrl_<?php echo esc_attr($no); ?>" name="optionUrl[]"
                                               value="<?php echo stripslashes($portfolio['optionUrl']); ?>"
                                               placeholder="">
                                    </div>
                                </div>
                            </div>
                            <!-- close div.eltd-section-content -->
                        </div>
                        <!-- close div.container-fluid -->
                    </div>
                </div>
            </div>
            <?php
            $no++;
        }
        ?>

        <div class="eltd-portfolio-add">
            <a class="eltd-add-item btn btn-sm btn-primary" href="#"> Add New Item</a>


            <a class="eltd-toggle-all-item btn btn-sm btn-default pull-right" href="#"> Expand All</a>
            <?php /* <a class="eltd-remove-last-item-row btn btn-sm btn-default pull-right" href="#"> Remove Last Row</a> */ ?>
        </div>


        <?php

    }
}


/*
   Class: SearchAndGoRepeater
   A class that initializes Elated Repeater
*/

class SearchAndGoRepeater implements iSearchAndGoRender
{
    private $label;
    private $description;
    private $name;
    private $fields;
    private $num_of_rows;

    function __construct($fields, $name, $label = "", $description = "")
    {
        global $search_and_go_elated_Framework;

        $this->label = $label;
        $this->description = $description;
        $this->fields = $fields;
        $this->name = $name;
        $this->num_of_rows = 1;
        $counter = 0;
        foreach ($this->fields as $field) {
            if(!isset($this->fields[$counter]['options'])){
                $this->fields[$counter]['options'] = array();
            }
            if(!isset($this->fields[$counter]['args'])){
                $this->fields[$counter]['args'] = array();
            }
            if(!isset($this->fields[$counter]['hidden'])){
                $this->fields[$counter]['hidden'] = false;
            }
            if(!isset($this->fields[$counter]['label'])){
                $this->fields[$counter]['label'] = '';
            }
            if(!isset($this->fields[$counter]['description'])){
                $this->fields[$counter]['description'] = '';
            }
            if(!isset($this->fields[$counter]['default_value'])){
                $this->fields[$counter]['default_value'] = '';
            }
            $search_and_go_elated_Framework->eltdMetaBoxes->addOption($this->fields[$counter]['name'], $this->fields[$counter]['default_value']);
            $counter++;
        }
    }

    public function render($factory, $row_fields_num = -1)
    {
        global $post;

        $clones = array();

        if(!empty($post)){
            $clones = get_post_meta($post->ID, $this->fields[0]['name'], true);
        }

        ?>
        <div class="eltd-repeater-wrapper">
            <div class="eltd-repeater-fields-holder clearfix">
                <?php if (empty($clones)) { //first time
                    if ($row_fields_num === -1) {
                        ?>
                        <div class="row eltd-repeater-fields-row">
                        <?php
                    }
                    $counter = 0;
                    foreach ($this->fields as $field) {
                        if ($row_fields_num !== -1 && $counter % $row_fields_num === 0) { ?>
                            <div class="row eltd-repeater-fields-row">
                            <?php
                        }
                        $factory->render($field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array('index' => 0, 'value' => $field['default_value']));
                        $counter++;
                        if ($row_fields_num !== -1 && $counter % $row_fields_num === 0) { ?>
                            <div class="eltd-repeater-remove"><a class="eltd-clone-remove" href="#"><i class="fa fa-times"></i></a></div>
                            </div>
                            <?php
                        }
                    }
                    if ($row_fields_num === -1) {
                        ?>
                        <div class="eltd-repeater-remove"><a class="eltd-clone-remove" href="#"><i class="fa fa-times"></i></a></div>
                        </div>
                        <?php
                    }
                } else {
                    $j = 0;
                    $index = 0;
                    $values = array();
                    foreach ($this->fields as $field) {
                        if ($j++ === 0) { // avoid unnecessary get_post_meta call
                            $values[] = $clones;
                        } else {
                            $values[] = get_post_meta($post->ID, $field['name'], true);
                        }
                    }
                    while (isset($clones[$index])) { // rows
                        $count = 0;
                        if ($row_fields_num === -1) {
                            ?>
                            <div class="row eltd-repeater-fields-row">
                            <?php
                        }
                        foreach ($this->fields as $field) { // columns
                            if ($row_fields_num !== -1 && $count % $row_fields_num === 0) { ?>
                                <div class="row eltd-repeater-fields-row">
                                <?php
                            }
                            $factory->render($field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array('index' => $index, 'value' => $values[$count][$index]));
                            if ($row_fields_num !== -1 && $count % $row_fields_num === 0) { ?>
                                <div class="eltd-repeater-remove"><a class="eltd-clone-remove" href="#"><i
                                            class="fa fa-times"></i></a></div>
                                </div>
                                <?php
                            }
                            $count++;
                        }
                        if ($row_fields_num === -1) {
                            ?>
                            <div class="eltd-repeater-remove"><a class="eltd-clone-remove" href="#"><i
                                        class="fa fa-times"></i></a></div>
                            </div>
                            <?php
                        }
                        ++$index;
                    }
                    $this->num_of_rows = $index;
                }
                ?>
            </div>
            <div class="eltd-repeater-add">
                <a class="eltd-clone btn btn-sm btn-primary"
                   data-count="<?php echo esc_attr($this->num_of_rows) ?>"
                   href="#">Add New Item</a>
            </div>
        </div>


        <?php

    }
}

/*
   Class: SearchAndGoCustomFieldsCreator
   A class that initializes Elated Custom Fields Holder
*/

class SearchAndGoCustomFieldsCreator implements iSearchAndGoRender
{
    private $label;
    private $description;


    function __construct($label = "", $description = "")
    {
        $this->label = $label;
        $this->description = $description;
    }

    public function render($factory)
    {
        global $post;
        ?>
        <div class="eltd-page-form-section">
            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <h4><?php echo esc_html($this->label); ?></h4>
                        <p><?php echo esc_html($this->description); ?></p>
                    </div>
                    <div class="row next-row">
                        <div class="col-lg-3">
                            <span class="eltd-add-custom-field btn btn-primary" data-type="text">Text</span>
                        </div>
                        <div class="col-lg-3">
                            <span class="eltd-add-custom-field btn btn-primary" data-type="textarea">Textarea</span>
                        </div>
                        <div class="col-lg-3">
                            <span class="eltd-add-custom-field btn btn-primary" data-type="select">Select</span>
                        </div>
                        <div class="col-lg-3">
                            <span class="eltd-add-custom-field btn btn-primary" data-type="checkbox">Checkbox</span>
                        </div>
                    </div>

        <?php
        $no = 1;
        $custom_fields = get_post_meta($post->ID, 'eltd_listing_type_custom_fields', true);

        if($custom_fields){
            $i = 0; // $index - 2D array - repeater fields
            while (isset($custom_fields[$no - 1])) {
                $custom_field = $custom_fields[$no - 1];
                switch($custom_field['type']){
                    case 'text':
                        $field = new SearchAndGoCustomFieldText($custom_field['required'],$custom_field['title'],$custom_field['meta_key'],$custom_field['default_value'], '', false, $custom_field['icon_pack'], $custom_field['icon']);
                        $field->render();
                        break;
                    case 'textarea':
                        $field = new SearchAndGoCustomFieldTextArea($custom_field['required'],$custom_field['title'],$custom_field['meta_key'],$custom_field['default_value'], '', false, $custom_field['icon_pack'], $custom_field['icon']);
                        $field->render();
                        break;
                    case 'select':
                        $field = new SearchAndGoCustomFieldSelect($custom_field['title'],$custom_field['options'],$custom_field['meta_key'], $custom_field['default_value_index'], false, $custom_field['icon_pack'], $custom_field['icon']);
                        $field->render($i++);
                        break;
                    case 'checkbox':
                        $field = new SearchAndGoCustomFieldCheckBox($custom_field['required'],$custom_field['title'],$custom_field['meta_key'],$custom_field['default_value'], '', false, $custom_field['icon_pack'], $custom_field['icon']);
                        $field->render();
                        break;
                    default:
                }
                $no++;
            }
        }
        ?>
                    </div><!-- close div.container-fluid -->
                <div class="eltd-custom-fields-expand">
                    <a class="eltd-toggle-all-custom-item btn btn-sm btn-default pull-right" href="#">Expand All</a>
                </div>
            </div><!-- close div.eltd-section-content -->
        </div><!-- close div.eltd-page-form-section -->
        <?php
    }
}

/*
   Class: SearchAndGoCustomFieldText
   A class that initializes Elated Text Custom Field
*/

class SearchAndGoCustomFieldText{
    private $required;
    private $expanded;
    private $title;
    private $meta_key;
    private $default_value;
    private $placeholder;
    private $icon_pack;
    private $icon;

    function __construct($required = 'no',$title = '', $meta_key = '', $default_value = '', $placeholder = '', $expanded = false, $icon_pack = '', $icon = ''){
        $this->required = $required;
        $this->title = $title;
        $this->meta_key = $meta_key;
        $this->default_value = $default_value;
        $this->placeholder = $placeholder;
        $this->expanded = $expanded;
        $this->icon_pack = $icon_pack;
        $this->icon = $icon;
    }

    public function render(){
        ?>
        <div class="row next-row eltd-text-custom-field eltd-custom-item">
            <div class="eltd-custom-field-toggle-holder">
                <div class="eltd-custom-field-toggle eltd-toggle-desc">
                    <span class="eltd-toggle-inner">Text Field</span>
                </div>
                <div class="eltd-custom-field-toggle eltd-custom-field-control">
                    <span class="toggle-custom-field-item"><i class="fa fa-caret-down"></i></span>
                    <a href="#" class="remove-custom-field-item"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="eltd-custom-field-toggle-content clearfix" <?php if(!$this->expanded){?> style="display:none" <?php } ?>>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Meta key</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <input type="text" name="eltd_custom_field_meta_key[]"
                                   value="<?php echo esc_attr($this->meta_key); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Title</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <input type="text" name="eltd_custom_field_title[]"
                                       value="<?php echo esc_attr($this->title); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Default Value</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <input type="text" name="eltd_custom_field_default_value[]"
                                   value="<?php echo esc_attr($this->default_value); ?>"/>
                        </div>
                    </div>
                </div>

                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Icon Pack</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <select name="eltd_custom_field_icon_pack[]" class="eltd_custom_field_icon_pack">
                            <?php
                            $icon_collections = search_and_go_elated_icon_collections()->getIconCollections();
                            $collections = array();
                            foreach ( $icon_collections as $ic_key => $ic_name ) {
                                $collections[] = search_and_go_elated_icon_collections()->getIconCollection( $ic_key );
                            }
                            foreach ( $icon_collections as $key => $value ) { ?>
                                <option value="<?php echo esc_html($key); ?>" <?php if ( $this->icon_pack == $key ) { echo 'selected'; }?>><?php echo esc_html($value); ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <?php foreach ( $collections as $col ) { ?>
                    <div class="eltd-page-form-section col-lg-12 eltd-icon-collection <?php echo str_replace(' ', '_', strtolower($col->title)); ?>" style="display: none"">
                        <div class="eltd-field-desc">
                            <h4><?php echo esc_html($col->title); ?></h4>
                        </div>
                        <div class="eltd-section-content">
                            <div class="container-fluid">
                                <select name="eltd_custom_field_<?php echo esc_html($col->param); ?>[]">
                                    <?php
                                    $icons = search_and_go_elated_icon_collections()->getIconCollectionIcons( $col );
                                    foreach ( $icons as $key => $value ) { ?>
                                        <option value="<?php echo esc_html($key); ?>" <?php if ( $this->icon == $key ) { echo 'selected'; }?>><?php echo esc_html($value); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Required</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <select name="eltd_custom_field_required[]">
                                <option <?php selected($this->required, 'no') ?> value="no">No</option>
                                <option <?php selected($this->required, 'yes') ?> value="yes">Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="text" name="eltd_custom_field_type[]">
        </div>
        <?php
    }
}

/*
   Class: SearchAndGoCustomFieldTextArea
   A class that initializes Elated Textarea Custom Field
*/

class SearchAndGoCustomFieldTextArea{
    private $required;
    private $expanded;
    private $title;
    private $meta_key;
    private $default_value;
    private $placeholder;
    private $icon_pack;
    private $icon;

    function __construct($required = 'no',$title = '', $meta_key = '', $default_value = '', $placeholder = '', $expanded = false, $icon_pack = '', $icon = ''){
        $this->required = $required;
        $this->expanded = $expanded;
        $this->title = $title;
        $this->meta_key = $meta_key;
        $this->default_value = $default_value;
        $this->placeholder = $placeholder;
        $this->icon_pack = $icon_pack;
        $this->icon = $icon;
    }

    public function render(){
        ?>
        <div class="row next-row eltd-textarea-custom-field eltd-custom-item">
            <div class="eltd-custom-field-toggle-holder">
                <div class="eltd-custom-field-toggle eltd-toggle-desc">
                    <span class="eltd-toggle-inner">Textarea Field</span>
                </div>
                <div class="eltd-custom-field-toggle eltd-custom-field-control">
                    <span class="toggle-custom-field-item"><i class="fa fa-caret-down"></i></span>
                    <a href="#" class="remove-custom-field-item"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div
                class="eltd-custom-field-toggle-content clearfix" <?php if (!$this->expanded) { ?> style="display:none" <?php } ?>>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Meta key</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <input type="text" name="eltd_custom_field_meta_key[]"
                                   value="<?php echo esc_attr($this->meta_key); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Title</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <input type="text" name="eltd_custom_field_title[]"
                                   value="<?php echo esc_attr($this->title); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Default Value</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <textarea name="eltd_custom_field_default_value[]"><?php echo esc_attr($this->default_value); ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Icon Pack</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <select name="eltd_custom_field_icon_pack[]" class="eltd_custom_field_icon_pack">
                                <?php
                                $icon_collections = search_and_go_elated_icon_collections()->getIconCollections();
                                $collections = array();
                                foreach ( $icon_collections as $ic_key => $ic_name ) {
                                    $collections[] = search_and_go_elated_icon_collections()->getIconCollection( $ic_key );
                                }
                                foreach ( $icon_collections as $key => $value ) { ?>
                                    <option value="<?php echo esc_html($key); ?>" <?php if ( $this->icon_pack == $key ) { echo 'selected'; }?>><?php echo esc_html($value); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <?php foreach ( $collections as $col ) { ?>
                <div class="eltd-page-form-section col-lg-12 eltd-icon-collection <?php echo str_replace(' ', '_', strtolower($col->title)); ?>" style="display: none"">
                <div class="eltd-field-desc">
                    <h4><?php echo esc_html($col->title); ?></h4>
                </div>
                <div class="eltd-section-content">
                    <div class="container-fluid">
                        <select name="eltd_custom_field_<?php echo esc_html($col->param); ?>[]">
                            <?php
                            $icons = search_and_go_elated_icon_collections()->getIconCollectionIcons( $col );
                            foreach ( $icons as $key => $value ) { ?>
                                <option value="<?php echo esc_html($key); ?>" <?php if ( $this->icon == $key ) { echo 'selected'; }?>><?php echo esc_html($value); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php } ?>

                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Required</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <select name="eltd_custom_field_required[]">
                                <option <?php selected($this->required, 'no') ?> value="no">No</option>
                                <option <?php selected($this->required, 'yes') ?> value="yes">Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="textarea" name="eltd_custom_field_type[]">
        </div>
        <?php
    }
}

/*
   Class: SearchAndGoCustomFieldSelect
   A class that initializes Elated Select Custom Field
*/

class SearchAndGoCustomFieldSelect{
    private $title;
    private $expanded;
    private $meta_key;
    private $default_value_index;
    private $options;
    private $icon_pack;
    private $icon;

    function __construct($title = '', $options = array(), $meta_key = '', $default_value_index = '', $expanded = false, $icon_pack = '', $icon = ''){
        $this->title = $title;
        $this->meta_key = $meta_key;
        $this->default_value_index = $default_value_index;
        $this->expanded = $expanded;
        $this->options = $options;
        $this->icon_pack = $icon_pack;
        $this->icon = $icon;
    }

    /**
     * @param int $i - $i is index of the repeater since multiple repeaters are possible and therefore 2D array is created
     */
    public function render($i = 0){
        ?>
        <div class="row next-row eltd-select-custom-field eltd-custom-item">
            <div class="eltd-custom-field-toggle-holder">
                <div class="eltd-custom-field-toggle eltd-toggle-desc">
                    <span class="eltd-toggle-inner">Select Field</span>
                </div>
                <div class="eltd-custom-field-toggle eltd-custom-field-control">
                    <span class="toggle-custom-field-item"><i class="fa fa-caret-down"></i></span>
                    <a href="#" class="remove-custom-field-item"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="eltd-custom-field-toggle-content clearfix" <?php if(!$this->expanded){?> style="display:none" <?php } ?>>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Meta key</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <input type="text" name="eltd_custom_field_meta_key[]" value="<?php echo esc_attr($this->meta_key); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Title</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <input type="text" name="eltd_custom_field_title[]" value="<?php echo esc_attr($this->title); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Options</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <?php
                            $factory = new SearchAndGoFieldFactory();
                            $fields = array();
                            if(!empty($this->options)) {
                                $radio_value = 0;
                                foreach($this->options as $value=>$label){
                                    $fields[] = array(
                                        'type' => 'textsimple',
                                        'name' => 'eltd_custom_field_options_label[' . $i . ']',
                                        'label' => 'Label',
                                        'default_value' => $label
                                    );
                                    $fields[] = array(
                                        'name' => 'eltd_custom_field_options_value[' . $i . ']',
                                        'type' => 'textsimple',
                                        'label' => 'Value',
                                        'default_value' => $value
                                    );

                                    $fields[] = array(
                                        'name' => 'eltd_custom_field_options_default[' . $i . ']',
                                        'type' => 'radio',
                                        'label' => 'Default value',
                                        'args'  => array(
                                            'value' => $radio_value++,
                                            'default_value'=> $this->default_value_index
                                        ),
                                    );
                                }
                            }else{
                                $fields = array(
                                    array(
                                        'type' => 'textsimple',
                                        'name' => 'eltd_custom_field_options_label[' . $i . ']',
                                        'label' => 'Label',
                                    ),
                                    array(
                                        'name' => 'eltd_custom_field_options_value[' . $i . ']',
                                        'type' => 'textsimple',
                                        'label' => 'Value',
                                    ),
                                    array(
                                        'name' => 'eltd_custom_field_options_default[' . $i . ']',
                                        'type' => 'radio',
                                        'label' => 'Default value',
                                        'args'  => array(
                                            'default_value'=>0,
                                            'value' => 0
                                        ),
                                    )
                                );
                            }
                            $repeater = new SearchAndGoRepeater(
                                $fields , 'eltd_custom_field_select_options_repeater'
                            );
                            $repeater->render($factory, 3);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Icon Pack</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <select name="eltd_custom_field_icon_pack[]" class="eltd_custom_field_icon_pack">
                                <?php
                                $icon_collections = search_and_go_elated_icon_collections()->getIconCollections();
                                $collections = array();
                                foreach ( $icon_collections as $ic_key => $ic_name ) {
                                    $collections[] = search_and_go_elated_icon_collections()->getIconCollection( $ic_key );
                                }
                                foreach ( $icon_collections as $key => $value ) { ?>
                                    <option value="<?php echo esc_html($key); ?>" <?php if ( $this->icon_pack == $key ) { echo 'selected'; }?>><?php echo esc_html($value); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <?php foreach ( $collections as $col ) { ?>
                <div class="eltd-page-form-section col-lg-12 eltd-icon-collection <?php echo str_replace(' ', '_', strtolower($col->title)); ?>" style="display: none"">
                <div class="eltd-field-desc">
                    <h4><?php echo esc_html($col->title); ?></h4>
                </div>
                <div class="eltd-section-content">
                    <div class="container-fluid">
                        <select name="eltd_custom_field_<?php echo esc_html($col->param); ?>[]">
                            <?php
                            $icons = search_and_go_elated_icon_collections()->getIconCollectionIcons( $col );
                            foreach ( $icons as $key => $value ) { ?>
                                <option value="<?php echo esc_html($key); ?>" <?php if ( $this->icon == $key ) { echo 'selected'; }?>><?php echo esc_html($value); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php } ?>

            </div>
            <input type="hidden" value="select" name="eltd_custom_field_type[]">
        </div>
        <?php
    }
}

/*
   Class: SearchAndGoCustomFieldText
   A class that initializes Elated Text Custom Field
*/

class SearchAndGoCustomFieldCheckBox{
    private $required;
    private $expanded;
    private $title;
    private $meta_key;
    private $default_value;
    private $placeholder;
    private $icon_pack;
    private $icon;

    function __construct($required = 'no',$title = '', $meta_key = '', $default_value = '', $placeholder = '', $expanded = false, $icon_pack = '', $icon = ''){
        $this->required = $required;
        $this->title = $title;
        $this->meta_key = $meta_key;
        $this->default_value = $default_value;
        $this->placeholder = $placeholder;
        $this->expanded = $expanded;
        $this->icon_pack = $icon_pack;
        $this->icon = $icon;
    }

    public function render(){
        ?>
        <div class="row next-row eltd-checkbox-custom-field eltd-custom-item">
            <div class="eltd-custom-field-toggle-holder">
                <div class="eltd-custom-field-toggle eltd-toggle-desc">
                    <span class="eltd-toggle-inner">Checkbox Field</span>
                </div>
                <div class="eltd-custom-field-toggle eltd-custom-field-control">
                    <span class="toggle-custom-field-item"><i class="fa fa-caret-down"></i></span>
                    <a href="#" class="remove-custom-field-item"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="eltd-custom-field-toggle-content clearfix" <?php if(!$this->expanded){?> style="display:none" <?php } ?>>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Meta key</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <input type="text" name="eltd_custom_field_meta_key[]"
                                   value="<?php echo esc_attr($this->meta_key); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Title</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <input type="text" name="eltd_custom_field_title[]"
                                   value="<?php echo esc_attr($this->title); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Checked By Default</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <input type="checkbox" name="eltd_custom_field_default_value[]" value="1" <?php checked($this->default_value,1); ?>>
                        </div>
                    </div>
                </div>

                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Icon Pack</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <select name="eltd_custom_field_icon_pack[]" class="eltd_custom_field_icon_pack">
                                <?php
                                $icon_collections = search_and_go_elated_icon_collections()->getIconCollections();
                                $collections = array();
                                foreach ( $icon_collections as $ic_key => $ic_name ) {
                                    $collections[] = search_and_go_elated_icon_collections()->getIconCollection( $ic_key );
                                }
                                foreach ( $icon_collections as $key => $value ) { ?>
                                    <option value="<?php echo esc_html($key); ?>" <?php if ( $this->icon_pack == $key ) { echo 'selected'; }?>><?php echo esc_html($value); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <?php foreach ( $collections as $col ) { ?>
                <div class="eltd-page-form-section col-lg-12 eltd-icon-collection <?php echo str_replace(' ', '_', strtolower($col->title)); ?>" style="display: none"">
                <div class="eltd-field-desc">
                    <h4><?php echo esc_html($col->title); ?></h4>
                </div>
                <div class="eltd-section-content">
                    <div class="container-fluid">
                        <select name="eltd_custom_field_<?php echo esc_html($col->param); ?>[]">
                            <?php
                            $icons = search_and_go_elated_icon_collections()->getIconCollectionIcons( $col );
                            foreach ( $icons as $key => $value ) { ?>
                                <option value="<?php echo esc_html($key); ?>" <?php if ( $this->icon == $key ) { echo 'selected'; }?>><?php echo esc_html($value); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php } ?>

                <div class="eltd-page-form-section col-lg-12">
                    <div class="eltd-field-desc">
                        <h4>Required</h4>
                    </div>
                    <div class="eltd-section-content">
                        <div class="container-fluid">
                            <select name="eltd_custom_field_required[]">
                                <option <?php selected($this->required, 'no') ?> value="no">No</option>
                                <option <?php selected($this->required, 'yes') ?> value="yes">Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="checkbox" name="eltd_custom_field_type[]">
        </div>
        <?php
    }
}

class SearchAndGoFieldAddress extends SearchAndGoFieldType {

    public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
        $col_width = 12;
        if(isset($args["col_width"])) {
            $col_width = $args["col_width"];
        }

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

        ?>

        <div class="eltd-page-form-section" id="eltd_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-<?php echo esc_attr($col_width); ?>">
                            <?php if($suffix) : ?>
                            <div class="input-group">
                                <?php endif; ?>
                                <input type="text" id="eltd-input-address"
                                       class="form-control eltd-input eltd-form-element "
                                       name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars(search_and_go_elated_option_get_value($name))); ?>"
                                       placeholder=""/>
                                <?php if($suffix) : ?>
                                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                                <?php endif; ?>
                                <?php if($suffix) : ?>
                            </div>
                        <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <div class="eltd-page-form-section eltd-latitude-holder" id="eltd_<?php echo esc_attr($name . '_latitude'); ?>">
            <div class="eltd-field-desc">
                <h4>Latitude</h4>
            </div>
            <!-- close div.eltd-field-desc -->
            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-<?php echo esc_attr($col_width); ?>">
                            <?php if($suffix) : ?>
                            <div class="input-group">
                                <?php endif; ?>
                                <input type="text"
                                       class="form-control eltd-input eltd-form-element eltd-latitude"
                                       name="<?php echo esc_attr($name . '_latitude'); ?>" value="<?php echo esc_attr(htmlspecialchars(search_and_go_elated_option_get_value($name . '_latitude'))); ?>"
                                       placeholder="" readonly="readonly"/>
                                <?php if($suffix) : ?>
                                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                                <?php endif; ?>
                                <?php if($suffix) : ?>
                            </div>
                        <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->
        </div>
        <div class="eltd-page-form-section eltd-longitude-holder" id="eltd_<?php echo esc_attr($name . '_longitude'); ?>">
            <div class="eltd-field-desc">
                <h4>Longitude</h4>
            </div>
            <!-- close div.eltd-field-desc -->
            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-<?php echo esc_attr($col_width); ?>">
                            <?php if($suffix) : ?>
                            <div class="input-group">
                                <?php endif; ?>
                                <input type="text"
                                       class="form-control eltd-input eltd-form-element eltd-longitude"
                                       name="<?php echo esc_attr($name . '_longitude'); ?>" value="<?php echo esc_attr(htmlspecialchars(search_and_go_elated_option_get_value($name . '_longitude'))); ?>"
                                       placeholder="" readonly="readonly"/>
                                <?php if($suffix) : ?>
                                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                                <?php endif; ?>
                                <?php if($suffix) : ?>
                            </div>
                        <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->
        </div>
        <div id="map" style="min-height: 300px;"></div>
        <?php

    }

}

class SearchAndGoFieldPackageDisabled extends SearchAndGoFieldType
{

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array())
    {
        $col_width = 12;
        if (isset($args["col_width"])) {
            $col_width = $args["col_width"];
        }

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

        $class = '';

        if (!empty($repeat)) {
            $id = $name . '-' . $repeat['index'];
            $name .= '[]';
            $value = $repeat['value'];
            $class = 'eltd-repeater-field';
        } else {
            $id = $name;
            $value = search_and_go_elated_option_get_value($name);
        }

        $package_title = '';
        //if is set package take it
        if($value && $value  !== ''){
            $current_post = get_post( $value );
        }

        if(isset($current_post)){
            $package_title = $current_post->post_title;
        }


        ?>

        <div class="eltd-page-form-section  <?php echo esc_attr($class); ?>"
             id="eltd_<?php echo esc_attr($id); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


            <div class="eltd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.eltd-field-desc -->

            <div class="eltd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-<?php echo esc_attr($col_width); ?>">
                            <?php if ($suffix) : ?>
                            <div class="input-group">
                                <?php endif; ?>
                                <input type="hidden"
                                       class="form-control eltd-input eltd-form-element"
                                       name="<?php echo esc_attr($name); ?>"
                                       value="<?php echo esc_attr(htmlspecialchars($value)); ?>"
                                       placeholder="" readonly="readonly"/>
                                <input type="text"
                                       class="form-control eltd-input eltd-form-element"
                                       value="<?php echo esc_html( $package_title ); ?>"
                                       placeholder="" readonly="readonly"/>
                                <?php if ($suffix) : ?>
                                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                                <?php endif; ?>
                                <?php if ($suffix) : ?>
                            </div>
                        <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.eltd-section-content -->

        </div>
        <?php

    }

}