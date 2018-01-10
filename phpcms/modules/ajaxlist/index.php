public function homeajaxlist() {   
    if(isset($_GET['siteid'])) {   
        $siteid = intval($_GET['siteid']);   
    } else {   
        $siteid = 1;   
    }   
    $page = $_GET['page']?$_GET['page']:1;   
    $siteid = $GLOBALS['siteid'] = max($siteid,1);   
    define('SITEID', $siteid);   
    $_userid = $this->_userid;   
    $_username = $this->_username;   
    $_groupid = $this->_groupid;   
    //SEO   
    $SEO = seo($siteid);   
    $sitelist  = getcache('sitelist','commons');   
    $default_style = $sitelist[$siteid]['default_style'];   
    $CATEGORYS = getcache('category_content_'.$siteid,'commons');   
    include template('content','list_ajax',$default_style);   
} 