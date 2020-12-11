<?php
############################################################
# PODCAST GENERATOR
#
# Created by Alberto Betella and Emil Engler
# http://www.podcastgenerator.net
#
# This is Free Software released under the GNU/GPL License.
############################################################
function pingPodcastIndex()
{
    // Get the global config
    global $config, $version;
    // Exit early if Podcast Index isn't set up
    if (!$config['pi_api_key'] || !$config['pi_api_secret'] || !$config['pi_podcast_id']) { return; }
    // Set up our client
    require_once('../vendor/autoload.php');
    $client = new PodcastIndex\Client([
        'app' => 'PodcastIndex/' . $version,
        'key' => $config['pi_api_key'],
        'secret' => $config['pi_api_secret']
    ]);
    try { $client->get('hub/pubnotify', array('id' => $config['pi_podcast_id'])); }
    catch (Exception $e) { /* swallow any errors, this is fire-and-forget */ }
}

function pingServices()
{
    pingPodcastIndex();
}
