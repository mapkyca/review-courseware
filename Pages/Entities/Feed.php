<?php

    /**
     * Defines the site homepage
     */

namespace IdnoPlugins\Courseware\Pages\Entities {

    use Idno\Core\Webmention;
    use Idno\Entities\Notification;
    use Idno\Entities\User;

    /**
     * Default class to serve the homepage
     */
    class Feed extends \Idno\Common\Page
    {

        // Handle GET requests to the homepage

        function getContent()
        {
	    $types = [];
	    $search = [];
	    $feedtypes = $this->arguments[1]??'course';
	    $context_id = $this->arguments[0];
	    
	    switch ($feedtypes) {

		case 'course': $types[] = \IdnoPlugins\Courseware\Entities\Course::class; break;
		case 'module': $types[] = \IdnoPlugins\Courseware\Entities\Module::class; $search['course_id'] = $context_id; break;
		case 'schedule': $types[] = \IdnoPlugins\Event\Event::class; $search['course_id'] = $context_id; break;
	    }
	
            $search['publish_status'] = 'published';

            $count = \Idno\Common\Entity::countFromX($types, $search);
            $feed  = \Idno\Common\Entity::getFromX($types, $search, array(), \Idno\Core\Idno::site()->config()->items_per_page, $offset);
            
            // If we have a feed, set our last modified flag to the time of the latest returned entry
            if (!empty($feed)) {
                if (is_array($feed)) {
                    $feed = array_filter($feed);
                    $this->setLastModifiedHeader(reset($feed)->updated);
                }
            }

            $t = \Idno\Core\Idno::site()->template();
            $t->__(array(

                'title'       => $title,
                'description' => $description,
                'content'     => $friendly_types,
                'body'        => $t->__(array(
                    'items'        => $feed,
                    'contentTypes' => $create,
                    'offset'       => $offset,
                    'count'        => $count,
                    'subject'      => $query,
                    'content'      => $friendly_types
                ))->draw('pages/home'),

            ))->drawPage();
        }

       

    }

}
