<?php
trait Register_Post_type{
    public function register_team_post_type(){
        $labels = [
            'name'               => _x( 'Teams', 'post type general name', 'forazitech' ),
            'singular_name'      => _x( 'Team', 'post type singular name', 'forazitech' ),
            'menu_name'          => _x( 'Teams', 'admin menu', 'forazitech' ),
            'name_admin_bar'     => _x( 'Team', 'add new on admin bar', 'forazitech' ),
            'add_new'            => _x( 'Add New', 'team', 'forazitech' ),
            'add_new_item'       => __( 'Add New Team', 'forazitech' ),
            'new_item'           => __( 'New Team', 'forazitech' ),
            'edit_item'          => __( 'Edit Team', 'forazitech' ),
            'view_item'          => __( 'View Team', 'forazitech' ),
            'all_items'          => __( 'All Teams', 'forazitech' ),
            'search_items'       => __( 'Search Teams', 'forazitech' ),
            'parent_item_colon'  => __( 'Parent Teams:', 'forazitech' ),
            'not_found'          => __( 'No teams found.', 'forazitech' ),
            'not_found_in_trash' => __( 'No teams found in Trash.', 'forazitech' )
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => ['slug' => 'team'],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => ['title', 'editor', 'thumbnail']
        ];

        register_post_type( 'team', $args );
    }

    public function team_meta_box(){
        add_meta_box( 
            "team_details", // Unique ID
            "Team Details", // Box title
            [$this, 'team_filds'], // Content callback, must be of type callable
            "team", // Post type
            "normal", // Context
            "high" // Priority
        );
    }

    public function team_filds(){
        ob_start();
            ?>
                <!-- <label for="position">Position:</label>
                <input type="text" name="position" id="position" /> -->
            <?php
        echo ob_get_clean();
    }
}