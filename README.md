# Wordpress Posttype
Easy API to create Wordpress posttypes.

## Installation
To install this package you have a couple of options.

#### Install through composer

    require {
        "tkj/posttype": "1.*"
    }

#### Manual install through git
Clone the git repository into your prefered destination in your theme directory and require the `Posttype.php` in your `functions.php`

    git clone git@github.com:tkjaergaard/Wordpress-Posttype.git
    
## Usage

The API of this package is quite simple. Simply create a new instance of `Tkj\Posttype` or use the facade `Tkj\Posttype::make()`

	<?php
	
	use Tkj\Posttype;
	
	new Posttype($singular);
	
	Posttype::make($singular);

#### Arguments

| Argument      | Required | Type   | Description                    |
|:--------------|:---------|:-------|:-------------------------------|
| *$singluar*   | True     | String | Singular name of the post type |
| *$plural*     | Optional | String | Plural name of the post type.  |
| *$options*    | Optional | Array  | Array of options.              |
| *$labels*     | Optional | Array  | Array of labels.               |

The options and labels array uses the same structure as [Wordpress reqister_post_type()](http://codex.wordpress.org/Function_Reference/register_post_type#Example) function.

#### Default options

The default options are pretty basic and shoud fit your needs in most cases.

	{
        'public':               true,
        'publicly_queryable':   true,
        'show_ui':              true,
        'show_in_menu':         true,
        'query_var':            true,
        'capability_type':      'post',
        'has_archive':          true,
        'hierarchical':         false,
        'menu_position':        null,
        'supports':             ['title', 'editor', 'thumbnail', 'excerpt']
	}
	
#### Default labels

The labes are generated from the *singular* and/or the *plural* arguments you use to create the post type. The labels are generated in english.

## License
This package is released under the MIT license.

## Author

Thomas Kjaergaard
[@t_kjaergaard](https://twitter.com/t_kjaergaard)
[tkjaergaard.dk](http://tkjaergaard.dk)