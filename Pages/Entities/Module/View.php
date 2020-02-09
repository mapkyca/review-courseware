<?php

namespace IdnoPlugins\Courseware\Pages\Entities\Module;


    class View extends \Idno\Page\Entity\View
    {

        // Handle GET requests to the entity

        function getContent()
        {
            if (!empty($this->arguments[0])) {
                $object = \Idno\Common\Entity::getByID($this->arguments[0]);
                if (empty($object)) {
                    $object = \Idno\Common\Entity::getBySlug($this->arguments[0]);
                }
            }
            if (empty($object)) {
                $this->goneContent();
            }

            // From here, we know the object is set

            // Check that we can see it
            if (!$object->canRead()) {
                $this->deniedContent();
            }

            // Just forward to the user's page
            if ($object instanceof \Idno\Entities\User) {
                $this->forward($object->getDisplayURL());
            }

            $this->setOwner($object->getOwner());
            $this->setPermalink(true, $object); // This is a permalink

            $this->lastModifiedGatekeeper($object->updated); // 304 if we've not updated the object

            $this->setLastModifiedHeader($object->updated); // Say when this was last modified

            $t = \Idno\Core\Idno::site()->template();
            $t->__(array(

                'title'       => $object->getTitle(),
                'body'        => $t->__(['object' => $object])->draw('entity/Module/wrapper'),
                'description' => $object->getShortDescription()

            ))->drawPage();
        }
	
    }
