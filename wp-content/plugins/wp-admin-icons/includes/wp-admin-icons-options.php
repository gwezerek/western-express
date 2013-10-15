<div class="wrap">
<h2>WP-Admin Icons
    <span class="whoBy">By: <a href="http://imdev.in" target="_blank" title="Visit Devin Walker's Site">Devin Walker</a></span>
</h2>

<div class="adminFacebook">
    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FWordImpress%2F353658958080509&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=220596284639969" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
</div>
<div class="moreOptions">
    <h4>More Useful Options</h4>

    <p>Hide all admin icons in left menu?</p>

    <form method="post" action="options.php">
        <?php settings_fields('icons-settings-group-more'); ?>
        <?php $options = get_option('admin-icons-options-more'); ?>
        <input type="checkbox" value="true" name="admin-icons-options-more[removeIcons]" <?php $removeIcons = $options['removeIcons']; if ($removeIcons == "true") {
            echo 'checked';
        } ?> >

        <p>Hide the WordPress Logo in the top-left admin menu bar?</p>
        <input type="checkbox" value="true" name="admin-icons-options-more[removeLogo]" <?php $removeLogo = $options['removeLogo']; if ($removeLogo == "true") {
            echo 'checked';
        } ?> >

        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>"/>
        </p>
    </form>
</div>
<div class="credits">

    <h3>How to Use:</h3>

    <p>Using WP-Admin Icons is easy, simply choose an icon from the list and then the icon you'd like to replace using the drop-down selection and click submit. If you'd like to clear that icon simply click "Clear Icon".</p>
    <h4>What this Plugin Does:</h4>

    <p>This plugin allows you to replace nearly all default icons in the WordPress admin interface.
        <strong>This plugin supports custom post types</strong>.</p>

    <h3>Support</h3>

    <p>If you are having trouble using this plugin please post in the <a href="http://wordpress.org/support/plugin/wp-admin-icons" target="_blank">WordPress forums.</a></p>

    <h3>Credits</h3>

    <p><strong>Icon Design Credit</strong>:<br/> <a href="http://p.yusukekamiyamane.com/" target="_blank">Yusuke Kamiyamane</a></p>

    <p>A Plugin to easily set your WordPress Admin Icons by
        <strong><a href="http://imdev.in/" target="_blank" title="Visit Devin's Personal Site">Devin Walker</a></strong> from
        <a href="http://www.wordimpress.com" target="_blank" title="Visit WordImpress">WordImpress</a>.</p>

</div>
<table class="widefat wpAdminIconsTable">
    <thead>
    <tr>
        <th>Use an WP-Admin Icon</th>
    </tr>
    </thead>
    <tr valign="top">
        <th>
            <ul class="iconList"></ul>
            <a href="#" class="moreIcons" page="1">More Icons &raquo;</a>
        </th>
    </tr>
</table>
<table class="widefat myWpAdminIconsTable">
    <thead>
    <tr>
        <th>Your Uploaded Icon</th>
    </tr>
    </thead>
    <tr valign="top">
        <th>
            <ul class="myIconList"></ul>
        </th>
    </tr>
</table>
<table class="widefat iconsTable" align="left">
    <thead>
    <tr>
        <th>Choose an Icon</th>
        <th class="explain">Explanation</th>
    </tr>
    </thead>
    <tr valign="top">
        <th>
            <a href="#" class="loadIcons">Show Included Admin Icons</a></th>
        <th><p class="explanation">Check out some of our 1800+ WP admin icons you can use!</p>
        </th>
    <tr>
        <th><a href="#" class="loadMyIcons">Show My Uploaded Icons</a><br/>
        </th>
        <th><p class="explanation">If you have uploaded your own custom icons you can set them here.</p>
        </th>
    </tr>
    <tr>
        <th><a href="#" id="uploadShow">Upload a Custom Icon Sprite</a><br/>
        </th>
        <th>
            <p class="explanation">Have your own icon? Upload it to set as an admin icon. Please note: The icon should be a PNG sprite with same canvas size as included icons. Use the included icons as templates for your custom icons.</p>
        </th>
    </tr>


</table>

<table class="widefat uploadIconTable">
    <thead>
    <tr>
        <th>Upload Your Own</th>
    </tr>
    </thead>
    <tr valign="top">

        <th>

            <p>Uploaded icons will appear in the "My Admin Icons" section after upload. Please use .png files as icons.</p>

            <form name="newad" method="post" enctype="multipart/form-data" action="<?php bloginfo('url'); ?>/wp-content/plugins/wp-admin-icons/includes/uploader.php">
                <table class="uploader">
                    <tr>
                        <td><input type="file" name="icon"></td>
                    </tr>
                    <tr>
                        <td><input name="Submit" type="submit" value="Upload" class="button-primary"></td>
                    </tr>
                </table>
            </form>


        </th>


    </tr>


</table>
<!-- end icons table -->

<form method="post" action="options.php">
    <?php settings_fields('icons-settings-group'); ?>
    <?php $options = get_option('admin-icons-options'); ?>
    <table class="widefat setIconTable">
        <thead>
        <tr>
            <th>New Icon</th>
            <th>Icon to Replace</th>
            <th>Save Changes</th>
        </tr>
        </thead>
        <tr>
            <td class="iconChangerBox">
                <div class="noIcon">None</div>
            </td>
            <td>
                <div id="newIconHiddenField"></div>

                <!-- Admin icons drop down -->

                <select name="admin-icons-options[iconToReplace]" id="iconDropDown">
                    <option select="selected">Select...</option>
                    <option value="dashboard">Dashboard</option>
                    <option value="posts">Posts</option>
                    <option value="media">Media</option>
                    <option value="links">Links</option>
                    <option value="pages">Pages</option>
                    <option value="comments">Comments</option>
                    <option value="appearance">Appearance</option>
                    <option value="plugins">Plugins</option>
                    <option value="users">Users</option>
                    <option value="tools">Tools</option>
                    <option value="settings">Settings</option>
                    <?php
                    $args = array(
                        '_builtin' => false
                    );
                    $post_types = get_post_types($args, 'names');
                    foreach ($post_types as $post_type) {
                        echo ' <option value="' . $post_type . '">' . $post_type . '</option>';
                    }
                    ?>
                </select></td>
            <td><p class="submit">
                    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>"/>
                </p></td>
        </tr>
    </table>


    <table class="widefat setIconTable iconInPlaceTable">
        <thead>
        <tr>
            <th>Icon Type</th>
            <th>Current Icon</th>
            <th>Clear Icon</th>
        </tr>
        </thead>
        <tr valign="top">
            <td><p>Dashboard</p></td>
            <td>
                <div class="currentIcon"><img src="<?php echo $options['dashboardIconURL']; ?>"/></div>
                <input type="text" name="admin-icons-options[dashboardIconURL]" value="<?php echo $options['dashboardIconURL']; ?>" id="new-dashboard-icon" class="hiddenField"/>
            </td>
            <td>
                <div class="submit clearIconWrap">
                    <input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = ''; jQuery(this).css('display','none'); " name="admin-icons-options[dashboardIconURL]"/>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td><p>Posts</p></td>
            <td>
                <div class="currentIcon"><img src="<?php echo $options['postIconURL']; ?>"/></div>
                <input type="text" name="admin-icons-options[postIconURL]" value="<?php echo $options['postIconURL']; ?>" id="new-posts-icon" class="hiddenField"/>
            </td>
            <td>
                <div class="submit clearIconWrap">
                    <input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = ''; jQuery(this).css('display','none');" name="admin-icons-options[postIconURL]"/>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td><p>Media</p></td>
            <td>
                <div class="currentIcon"><img src="<?php echo $options['mediaIconURL']; ?>"/></div>
                <input type="text" name="admin-icons-options[mediaIconURL]" value="<?php echo $options['mediaIconURL']; ?>" id="new-media-icon" class="hiddenField"/>
            </td>
            <td>
                <div class="submit clearIconWrap">
                    <input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = ''; jQuery(this).css('display','none');" name="admin-icons-options[mediaIconURL]"/>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td><p>Links</p></td>
            <td>
                <div class="currentIcon"><img src="<?php echo $options['linksIconURL']; ?>"/></div>
                <input type="text" name="admin-icons-options[linksIconURL]" value="<?php echo $options['linksIconURL']; ?>" id="new-links-icon" class="hiddenField"/>
            </td>
            <td>
                <div class="submit clearIconWrap">
                    <input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = ''; jQuery(this).css('display','none');" name="admin-icons-options[linksIconURL]"/>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td><p>Pages</p></td>
            <td>
                <div class="currentIcon"><img src="<?php echo $options['pagesIconURL']; ?>"/></div>
                <input type="text" name="admin-icons-options[pagesIconURL]" value="<?php echo $options['pagesIconURL']; ?>" id="new-pages-icon" class="hiddenField"/>
            </td>
            <td>
                <div class="submit clearIconWrap">
                    <input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = ''; jQuery(this).css('display','none');" name="admin-icons-options[pagesIconURL]"/>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td><p>Comments</p></td>
            <td>
                <div class="currentIcon"><img src="<?php echo $options['commentsIconURL']; ?>"/></div>
                <input type="text" name="admin-icons-options[commentsIconURL]" value="<?php echo $options['commentsIconURL']; ?>" id="new-comments-icon" class="hiddenField"/>
            </td>
            <td>
                <div class="submit clearIconWrap">
                    <input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = ''; jQuery(this).css('display','none');" name="admin-icons-options[commentsIconURL]"/>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td><p>Appearance</p></td>
            <td>
                <div class="currentIcon"><img src="<?php echo $options['appearanceIconURL']; ?>"/></div>
                <input type="text" name="admin-icons-options[appearanceIconURL]" value="<?php echo $options['appearanceIconURL']; ?>" id="new-appearance-icon" class="hiddenField"/>
            </td>
            <td>
                <div class="submit clearIconWrap">
                    <input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = ''; jQuery(this).css('display','none');" name="admin-icons-options[appearanceIconURL]"/>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td><p>Plugins</p></td>
            <td>
                <div class="currentIcon"><img src="<?php echo $options['pluginsIconURL']; ?>"/></div>
                <input type="text" name="admin-icons-options[pluginsIconURL]" value="<?php echo $options['pluginsIconURL']; ?>" id="new-plugins-icon" class="hiddenField"/>
            </td>
            <td>
                <div class="submit clearIconWrap">
                    <input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = ''; jQuery(this).css('display','none');" name="admin-icons-options[pluginsIconURL]"/>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td><p>Users</p></td>
            <td>
                <div class="currentIcon"><img src="<?php echo $options['usersIconURL']; ?>"/></div>
                <input type="text" name="admin-icons-options[usersIconURL]" value="<?php echo $options['usersIconURL']; ?>" id="new-users-icon" class="hiddenField"/>
            </td>
            <td>
                <div class="submit clearIconWrap">
                    <input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = ''; jQuery(this).css('display','none');" name="admin-icons-options[usersIconURL]"/>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td><p>Tools</p></td>
            <td>
                <div class="currentIcon"><img src="<?php echo $options['toolsIconURL']; ?>"/></div>
                <input type="text" name="admin-icons-options[toolsIconURL]" value="<?php echo $options['toolsIconURL']; ?>" id="new-tools-icon" class="hiddenField"/>
            </td>
            <td>
                <div class="submit clearIconWrap">
                    <input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = ''; jQuery(this).css('display','none');" name="admin-icons-options[toolsIconURL]"/>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td><p>Settings</p></td>
            <td>
                <div class="currentIcon"><img src="<?php echo $options['settingsIconURL']; ?>"/></div>
                <input type="text" name="admin-icons-options[settingsIconURL]" value="<?php echo $options['settingsIconURL']; ?>" id="new-settings-icon" class="hiddenField"/>
            </td>
            <td>
                <div class="submit clearIconWrap">
                    <input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = ''; jQuery(this).css('display','none');" name="admin-icons-options[settingsIconURL]"/>
                </div>
            </td>
        </tr>
        <?php
        $args = array(
            '_builtin' => false
        );
        $post_types = get_post_types($args, 'names');
        foreach ($post_types as $post_type) {

            echo '<tr valign="top"><td><p>' . $post_type . '</p></td>';

            $thisPostTypeOption = $post_type . 'IconURL';

            echo '<td><div class="currentIcon"><img src="' . $options[$thisPostTypeOption] . '" />';

            echo '</div><input type="text" name="admin-icons-options[' . $thisPostTypeOption . ']" value="' . $options[$thisPostTypeOption];

            echo '" id="new-' . $post_type . '-icon"  class="hiddenField" /></td>';

            echo '<td> <div class="submit clearIconWrap"><input type="submit" class="button-primary clearIcon" value="Clear Icon" onclick="this.value = \'\';jQuery(this).css(\'display\',\'none\');" name="admin-icons-options[' . $thisPostTypeOption . ']" />
    </div></td>';

            echo '</tr>';
        } ?>
    </table>
    <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>"/>
    </p>
</form>
</div>