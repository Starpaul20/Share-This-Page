<?php
/**
 * Share This Page
 * Copyright 2014 Starpaul20
 */

// Disallow direct access to this file for security reasons
if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

// Tell MyBB when to run the hooks
$plugins->add_hook("global_start", "sharethispage_cache");
$plugins->add_hook("global_intermediate", "sharethispage_run");

// The information that shows up on the plugin manager
function sharethispage_info()
{
	global $lang;
	$lang->load("sharethispage", true);

	return array(
		"name"				=> $lang->sharethispage_info_name,
		"description"		=> $lang->sharethispage_info_desc,
		"website"			=> "http://galaxiesrealm.com/index.php",
		"author"			=> "Starpaul20",
		"authorsite"		=> "http://galaxiesrealm.com/index.php",
		"version"			=> "1.1",
		"codename"			=> "sharethispage",
		"compatibility"		=> "18*"
	);
}

// This function runs when the plugin is activated.
function sharethispage_activate()
{
	global $db;

	// Insert settings
	$insertarray = array(
		'name' => 'sharethispage',
		'title' => 'Share This Page Settings',
		'description' => 'Various option related to sharing pages on Facebook, Twitter and Google Plus can be managed and set here.',
		'disporder' => 45,
		'isdefault' => 0,
	);
	$gid = $db->insert_query("settinggroups", $insertarray);

	$insertarray = array(
		'name' => 'enabletwitter',
		'title' => 'Enable Twitter',
		'description' => 'Do you wish to show a tweet this button?',
		'optionscode' => 'yesno',
		'value' => 1,
		'disporder' => 1,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'twitter_text',
		'title' => 'Tweet Text',
		'description' => 'Specify any text to add when visitors when they use the Tweet button. If blank, page title will be used.',
		'optionscode' => 'text',
		'value' => '',
		'disporder' => 2,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'twitter_via',
		'title' => 'Via Username',
		'description' => 'Specify a Twitter account to recommend to visitors after they use the Tweet button. Do not include the at symbol (@).',
		'optionscode' => 'text',
		'value' => '',
		'disporder' => 3,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'twitter_related',
		'title' => 'Related Username',
		'description' => 'Specify another Twitter account to recommend to visitors after they use the Tweet button. Do not include the at symbol (@).',
		'optionscode' => 'text',
		'value' => '',
		'disporder' => 4,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'twitter_large',
		'title' => 'Large Twitter Button',
		'description' => 'Do you wish to use a large twitter button?',
		'optionscode' => 'yesno',
		'value' => 0,
		'disporder' => 5,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'twitter_count',
		'title' => 'Show Tweet Count',
		'description' => 'Do you wish to show a bubble showing how many times that page has been tweeted?',
		'optionscode' => 'yesno',
		'value' => 1,
		'disporder' => 6,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'twitter_hashtag',
		'title' => 'Tweet To Hashtag',
		'description' => 'Specify a hashtag you wish tweets to use. Do not include the hashtag symbol (#).',
		'optionscode' => 'text',
		'value' => '',
		'disporder' => 7,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'twitter_dnt',
		'title' => 'Opt-out Of Tailoring Twitter',
		'description' => 'Do you wish to opt-out of tailoring Twitter suggestions?',
		'optionscode' => 'yesno',
		'value' => 0,
		'disporder' => 8,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'enablefacebook',
		'title' => 'Enable Facebook',
		'description' => 'Do you wish to show a like/recommend this button for Facebook?',
		'optionscode' => 'yesno',
		'value' => 1,
		'disporder' => 9,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'facebook_type',
		'title' => 'Facebook Type',
		'description' => 'Which action do you wish to do for the Facebook button?',
		'optionscode' => 'radio
like=Like
recommend=Recommend',
		'value' => 'like',
		'disporder' => 10,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'facebook_layout',
		'title' => 'Facebook Layout',
		'description' => 'Which layout design do you wish to do for the Facebook button?',
		'optionscode' => 'radio
standard=Standard
box_count=Box Count
button_count=Button Count
button=Button',
		'value' => 'button_count',
		'disporder' => 11,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'facebook_share',
		'title' => 'Facebook Share',
		'description' => 'Do you wish to include a share button alongside of your Facebook like/recommend button?',
		'optionscode' => 'yesno',
		'value' => 1,
		'disporder' => 12,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'facebook_size',
		'title' => 'Facebook Size',
		'description' => 'Which size would you like your Facebook like/recommend button to be?',
		'optionscode' => 'radio
small=Small
large=Large',
		'value' => 'small',
		'disporder' => 13,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'facebook_faces',
		'title' => 'Show Facebook Friends Faces',
		'description' => 'Do you wish to show profile photos when 2 or more Facebook friends like this?',
		'optionscode' => 'yesno',
		'value' => 1,
		'disporder' => 14,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'facebook_colorscheme',
		'title' => 'Facebook Text Color Scheme',
		'description' => 'If using standard layout, what color scheme do you wish to use for the text shown?',
		'optionscode' => 'radio
light=Light
dark=Dark',
		'value' => 'light',
		'disporder' => 15,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'enablegoogle',
		'title' => 'Enable Google Plus',
		'description' => 'Do you wish to show a recommend button for Google Plus?',
		'optionscode' => 'yesno',
		'value' => 1,
		'disporder' => 16,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'google_layout',
		'title' => 'Google Plus Layout',
		'description' => 'Which layout design do you wish to do for the Google Plus button?',
		'optionscode' => 'radio
small=Small
medium=Medium
standard=Standard
tall=Tall',
		'value' => 'medium',
		'disporder' => 17,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'google_annotation',
		'title' => 'Google Plus Annotation',
		'description' => 'Which type of annotation do you wish to do for the Google Plus button?',
		'optionscode' => 'radio
inline=Inline
bubble=Bubble
none=None',
		'value' => 'bubble',
		'disporder' => 18,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	$insertarray = array(
		'name' => 'google_width',
		'title' => 'Google Plus Annotation Width',
		'description' => 'If using inline annotation, what should the maximum width be in pixels? Must be larger than 120.',
		'optionscode' => 'numeric',
		'value' => 300,
		'disporder' => 19,
		'gid' => (int)$gid
	);
	$db->insert_query("settings", $insertarray);

	rebuild_settings();

	// Insert Templates
	$insert_array = array(
		'title'		=> 'global_share',
		'template'	=> $db->escape_string('<br />
<div style="padding-top: 5px; padding-bottom: 5px;">
	{$twitter}
	{$facebook}
	{$google}
</div>'),
		'sid'		=> '-1',
		'version'	=> '',
		'dateline'	=> TIME_NOW
	);
	$db->insert_query("templates", $insert_array);

	$insert_array = array(
		'title'		=> 'global_share_twitter',
		'template'	=> $db->escape_string('<div style="padding:1px;">
<a href="https://twitter.com/share" class="twitter-share-button"{$data_text}{$data_via}{$data_size}{$data_related}{$data_count}{$data_hashtags}{$data_dnt}>{$lang->tweet}</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>
</div>'),
		'sid'		=> '-1',
		'version'	=> '',
		'dateline'	=> TIME_NOW
	);
	$db->insert_query("templates", $insert_array);

	$insert_array = array(
		'title'		=> 'global_share_facebook_header',
		'template'	=> $db->escape_string('<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>'),
		'sid'		=> '-1',
		'version'	=> '',
		'dateline'	=> TIME_NOW
	);
	$db->insert_query("templates", $insert_array);

	$insert_array = array(
		'title'		=> 'global_share_facebook',
		'template'	=> $db->escape_string('<div style="padding:1px;">
<div class="fb-like"{$data_layout}{$data_action}{$data_size_facebook}{$data_show_faces}{$data_share}{$data_colorscheme}></div>
</div>'),
		'sid'		=> '-1',
		'version'	=> '',
		'dateline'	=> TIME_NOW
	);
	$db->insert_query("templates", $insert_array);

	$insert_array = array(
		'title'		=> 'global_share_google_header',
		'template'	=> $db->escape_string('<script src="https://apis.google.com/js/platform.js" async defer></script>'),
		'sid'		=> '-1',
		'version'	=> '',
		'dateline'	=> TIME_NOW
	);
	$db->insert_query("templates", $insert_array);

	$insert_array = array(
		'title'		=> 'global_share_google',
		'template'	=> $db->escape_string('<div style="padding:1px;">
<div class="g-plusone"{$data_size_google}{$data_annotation}{$data_width}></div>
</div>'),
		'sid'		=> '-1',
		'version'	=> '',
		'dateline'	=> TIME_NOW
	);
	$db->insert_query("templates", $insert_array);

	include MYBB_ROOT."/inc/adminfunctions_templates.php";
	find_replace_templatesets("footer", "#".preg_quote('<debugstuff>')."#i", '{$share}<debugstuff>');
	find_replace_templatesets("header", "#".preg_quote('<div id="container">')."#i", '{$facebook_header}<div id="container">');
	find_replace_templatesets("headerinclude", "#".preg_quote('{$stylesheets}')."#i", '{$stylesheets}{$google_header}');
}

// This function runs when the plugin is deactivated.
function sharethispage_deactivate()
{
	global $db;
	$db->delete_query("settings", "name IN('enabletwitter','twitter_text','twitter_via','twitter_related','twitter_large','twitter_count','twitter_hashtag','twitter_dnt','enablefacebook','facebook_type','facebook_layout','facebook_share','facebook_size','facebook_faces','facebook_colorscheme','enablegoogle','google_layout','google_annotation','google_width')");
	$db->delete_query("settinggroups", "name IN('sharethispage')");
	$db->delete_query("templates", "title IN('global_share','global_share_twitter','global_share_facebook_header','global_share_facebook','global_share_google_header','global_share_google')");
	rebuild_settings();

	include MYBB_ROOT."/inc/adminfunctions_templates.php";
	find_replace_templatesets("footer", "#".preg_quote('{$share}')."#i", '', 0);
	find_replace_templatesets("header", "#".preg_quote('{$facebook_header}')."#i", '', 0);
	find_replace_templatesets("headerinclude", "#".preg_quote('{$google_header}')."#i", '', 0);
}

// Cache the header link template
function sharethispage_cache()
{
	global $templatelist;
	if(isset($templatelist))
	{
		$templatelist .= ',';
	}
	$templatelist .= 'global_share,global_share_twitter,global_share_facebook_header,global_share_facebook,global_share_google_header,global_share_google';
}

// Limit Registrations per day
function sharethispage_run()
{
	global $mybb, $lang, $templates, $twitter, $facebook, $facebook_header, $google, $google_header, $share;
	$lang->load("sharethispage");

	$twitter = '';
	if($mybb->settings['enabletwitter'] == 1)
	{
		if(!empty($mybb->settings['twitter_text']))
		{
			$twitter_text = htmlspecialchars_uni($mybb->settings['twitter_text']);
			$data_text = " data-text=\"{$twitter_text}\"";
		}

		if(!empty($mybb->settings['twitter_via']))
		{
			$twitter_via = htmlspecialchars_uni($mybb->settings['twitter_via']);
			$data_via = " data-via=\"{$twitter_via}\"";
		}

		if(!empty($mybb->settings['twitter_related']))
		{
			$twitter_related = htmlspecialchars_uni($mybb->settings['twitter_related']);
			$data_related = " data-related=\"{$twitter_related}\"";
		}

		if($mybb->settings['twitter_large'] == 1)
		{
			$data_size = " data-size=\"large\"";
		}

		if($mybb->settings['twitter_count'] == 0)
		{
			$data_count = " data-count=\"none\"";
		}

		if(!empty($mybb->settings['twitter_hashtag']))
		{
			$twitter_hashtag = htmlspecialchars_uni($mybb->settings['twitter_hashtag']);
			$data_hashtags = " data-hashtags=\"{$twitter_hashtag}\"";
		}

		if($mybb->settings['twitter_dnt'] == 1)
		{
			$data_dnt = " data-dnt=\"true\"";
		}

		eval('$twitter = "'.$templates->get('global_share_twitter').'";');
	}

	$facebook = $facebook_header = '';
	if($mybb->settings['enablefacebook'] == 1)
	{
		eval('$facebook_header = "'.$templates->get('global_share_facebook_header').'";');

		if($mybb->settings['facebook_type'] == 'recommend')
		{
			$data_action = " data-action=\"recommend\"";
		}
		else
		{
			$data_action = " data-action=\"like\"";
		}

		if($mybb->settings['facebook_layout'] == 'standard')
		{
			$data_layout = " data-layout=\"standard\"";
		}
		elseif($mybb->settings['facebook_layout'] == 'box_count')
		{
			$data_layout = " data-layout=\"box_count\"";
		}
		elseif($mybb->settings['facebook_layout'] == 'button_count')
		{
			$data_layout = " data-layout=\"button_count\"";
		}
		else
		{
			$data_layout = " data-layout=\"button\"";
		}

		if($mybb->settings['facebook_share'] == 1)
		{
			$data_share = " data-share=\"true\"";
		}
		else
		{
			$data_share = " data-share=\"false\"";
		}

		if($mybb->settings['facebook_size'] == 'large')
		{
			$data_size_facebook = " data-size=\"large\"";
		}
		else
		{
			$data_size_facebook = " data-size=\"small\"";
		}

		if($mybb->settings['facebook_faces'] == 1)
		{
			$data_show_faces = " data-show-faces=\"true\"";
		}
		else
		{
			$data_show_faces = " data-show-faces=\"false\"";
		}

		if($mybb->settings['facebook_colorscheme'] == 'dark')
		{
			$data_colorscheme = " data-colorscheme=\"dark\"";
		}
		else
		{
			$data_colorscheme = " data-colorscheme=\"light\"";
		}

		eval('$facebook = "'.$templates->get('global_share_facebook').'";');
	}

	$google = $google_header = '';
	if($mybb->settings['enablegoogle'] == 1)
	{
		eval('$google_header = "'.$templates->get('global_share_google_header').'";');

		$data_size_google = '';
		if($mybb->settings['google_layout'] == 'small')
		{
			$data_size_google = " data-size=\"small\"";
		}
		elseif($mybb->settings['google_layout'] == 'medium')
		{
			$data_size_google = " data-size=\"medium\"";
		}
		elseif($mybb->settings['google_layout'] == 'tall')
		{
			$data_size_google = " data-size=\"tall\"";
		}

		$data_annotation = '';
		if($mybb->settings['google_annotation'] == 'inline')
		{
			$data_annotation = " data-annotation=\"inline\" data-width=\"300\"";
		}
		elseif($mybb->settings['google_annotation'] == 'none')
		{
			$data_annotation = " data-annotation=\"none\"";
		}

		$data_width = '';
		if($mybb->settings['google_annotation'] == 'inline' && (int)$mybb->settings['google_width'] >= 120)
		{
			$google_width = (int)$mybb->settings['google_width'];
			$data_width = " data-width=\"{$google_width}\"";
		}

		eval('$google = "'.$templates->get('global_share_google').'";');
	}

	if(!empty($twitter) || !empty($facebook) || !empty($google))
	{
		eval('$share = "'.$templates->get('global_share').'";');
	}
}

?>