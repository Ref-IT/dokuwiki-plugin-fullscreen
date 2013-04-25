<?php
/**
 * Action Component for the Fullscreen Plugin
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Michael Braun <michael-dev@fami-braun.de>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');

class action_plugin_fullscreen extends DokuWiki_Action_Plugin {

    /**
     * register the eventhandlers
     *
     * @author Andreas Gohr <andi@splitbrain.org>
     */
    public function register(&$controller){
        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'handle_tpl_metaheader_output');
        $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'handle_toolbar', array ());
    }

    public function handle_toolbar(&$event, $param) {
        $event->data[] = array (
            'type' => 'Fullscreen',
            'title' => $this->getLang('button'),
            'icon' => '../../plugins/fullscreen/images/fullscreen.png',
        );

    }

    public function handle_tpl_metaheader_output(Doku_Event &$event, $param) {
        global $ACT, $INFO;
        $path = 'scripts/fullscreen.js';

        $json = new JSON();
        $this->link_script($event, DOKU_BASE.'lib/plugins/fullscreen/'.$path);

    }

    private function include_script($event, $code) {
        $event->data['script'][] = array(
            'type' => 'text/javascript',
            'charset' => 'utf-8',
            '_data' => $code,
        );
    }

    private function link_script($event, $url) {
        $event->data['script'][] = array(
            'type' => 'text/javascript',
            'charset' => 'utf-8',
            'src' => $url,
        );
    }
// vim:ts=4:sw=4:et:
}

