<?php namespace Tkj;

class Posttype {

    /**
     * Singular name for post type
     * @var string
     */
    private $singular;

    /**
     * Plural name for post type
     * @var string
     */
    private $plural;

    /**
     * The ending of plural
     * @var string
     */
    private $plural_end = 's';

    /**
     * The labels for post type
     * @var array
     */
    private $label;

    /**
     * Default arguments for post type
     * @var array
     */
    private $options = array(
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
    );

    /**
     * New post type constructor
     * @param string    $singular
     * @param mixed     $plural
     * @param mixed     $options
     * @param mixed     $labels
     */
    public function __construct($singular,$plural=NULL,$options=NULL,$labels=NULL)
    {
        if( !is_string($singular) )
            throw new \Exception("Invalid sigular name provided as first argument: ".$singular, 1);

        $this->singular = strtolower($singular);
        $this->plural   = strtolower($plural);

        if( $options && is_array($options) )
            $this->options = array_merge($this->options,$options);

        $this->construct_label($labels);

        $this->register();
    }

    /**
     * Construct the labels for post type
     * @param  mixed $label
     * @return bool
     */
    private function construct_label($label)
    {
        if( $label && is_array( $label) )
        {
            $this->label = $label;
            return true;
        }

        $singular = $this->singular;
        $plural    = $this->plural ?: $singular.$this->plural_end;

        $this->label = array(
          'name' => ucfirst($plural),
          'singular_name' => ucfirst($singular),
          'add_new' => 'Add New',
          'add_new_item' => 'Add New '.ucfirst($singular),
          'edit_item' => 'Edit '.ucfirst($singular),
          'new_item' => 'New '.ucfirst($singular),
          'all_items' => 'All '.ucfirst($plural),
          'view_item' => 'View '.ucfirst($singular),
          'search_items' => 'Search '.ucfirst($plural),
          'not_found' =>  'No '.$plural.' found',
          'not_found_in_trash' => 'No '.$plural.' found in Trash',
          'parent_item_colon' => '',
          'menu_name' => ucfirst($plural)
        );

        return true;
    }

    /**
     * Register the post type
     * @return void
     */
    private function register()
    {
        $this->options['labels'] = $this->label;

        if( !isset( $this->options['rewrite']) )
            $this->options['rewrite'] = array('slug' => $this->singular );

        $that =& $this;
        add_action( 'init', function() use(&$that){
            register_post_type( $that->singular, $that->options );
        });
    }

    /**
     * Facade
     * @return void
     */
    public static function make($singular,$plural=NULL,$options=NULL,$labels=NULL)
    {
        new self($singular,$plural,$options,$labels);
    }

}