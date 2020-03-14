<?php
//add_action('admin_init', 'tc_addRoles');

function tc_addRoles()
{

    add_role(
        'developer',
        'Developer',
        [
            'delete_others_pages' => true,
            'delete_others_posts' => true,
            'delete_pages' => true,
            'delete_posts' => true,
            'delete_private_pages' => true,
            'delete_private_posts' => true,
            'delete_published_pages' => true,
            'delete_published_posts' => true,
            'edit_dashboard' => true,
            'edit_others_pages' => true,
            'edit_others_posts' => true,
            'edit_pages' => true,
            'edit_posts' => true,
            'edit_private_pages' => true,
            'edit_private_posts' => true,
            'edit_published_pages' => true,
            'edit_published_posts' => true,
            'edit_theme_options' => true,
            'export' => true,
            'import' => true,
            'list_users' => true,
            'manage_categories' => true,
            'manage_links' => true,
            'manage_options' => true,
            'moderate_comments' => true,
            'promote_users' => true,
            'publish_pages' => true,
            'publish_posts' => true,
            'read_private_pages' => true,
            'read_private_posts' => true,
            'read' => true,
            'create Reusable Blocks' => true,
            'edit Reusable Blocks' => true,
            'read Reusable Blocks' => true,
            'delete Reusable Blocks' => true,
            'remove_users' => true,
            'switch_themes' => true,
            'upload_files' => true,
            'customize' => true,
            'delete_site' => true,
            'update_core' => true,
            'update_plugins' => true,
            'update_themes' => true,
            'install_plugins' => true,
            'install_themes' => true,
            'delete_themes' => true,
            'delete_plugins' => true,
            'edit_plugins' => true,
            'edit_themes' => true,
            'edit_files' => true,
            'edit_users' => true,
            'add_users' => true,
            'create_users' => true,
            'delete_users' => true,
            'unfiltered_html' => true,
        ]
    );
}

add_action('admin_head', 'tc_editor_visibility');

function tc_editor_visibility() {
    if(!isDeveloper()) {
        echo '<style> .html-editor, .scss-editor, .js-editor, .dev-only, .static-content > .acf-input .acf-actions a.acf-button, .static-content .acf-repeater .acf-row:hover>.acf-row-handle .acf-icon {display: none !important;} .read-only input, .read-only textarea {user-select: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none;}</style>';
    }
}